<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Stripe\PaymentIntent;
use Stripe\SetupIntent;
use Stripe\Stripe;
use Stripe\Customer;

class PaymentController extends Controller
{
    // Show the "Create Customer" form
    public function showCreateCustomerForm()
    {
        return Inertia::render('PayLegalFees');
    }

    public function payLegalFees(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ]);

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        \Stripe\Stripe::setClientId(env($request->account));

        // 1. FirstOrCreate in our DB
        $customer = \App\Models\Customer::updateOrCreate(
            [
                'email' => $request->email,
                'stripe_account_id' => $request->account, // unique per email+account combo
            ],
            [
                'name' => $request->name,
            ]
        );

        // 2. Create customer on Stripe if missing stripe_customer_id
        if (is_null($customer->stripe_customer_id)) {

            if ($customer->stripe_account_id == 'main') {
                $stripeCustomer = Customer::create([
                    'name' => $customer->name,
                    'email' => $customer->email,
                ]);
            } else {
                $stripeCustomer = Customer::create([
                    'name' => $customer->name,
                    'email' => $customer->email,
                ],
                    ['stripe_account' => $customer->stripe_account_id]
                );
            }


            $customer->update([
                'stripe_customer_id' => $stripeCustomer->id,
            ]);
        }

        if (is_null($customer->stripe_setup_intent_id)) {
            if ($customer->stripe_account_id == 'main') {

                $setup_intent = SetupIntent::create([
                        'payment_method_types' => ['us_bank_account'],
                        'customer' => $customer->stripe_customer_id,
                        'usage' => 'off_session'
                    ]
                );


                $customer->update([
                    'stripe_setup_intent_id' => $setup_intent->id
                ]);
            } else {

                $setup_intent = SetupIntent::create([
                    'payment_method_types' => ['us_bank_account'],
                    'customer' => $customer->stripe_customer_id,
                    'usage' => 'off_session',
                ],
                    ['stripe_account' => $customer->stripe_account_id]
                );


                $customer->update([
                        'stripe_setup_intent_id' => $setup_intent->id
                    ]
                );
            }


        } else {

            if ($customer->stripe_account_id == 'main') {
                $setup_intent = \Stripe\SetupIntent::retrieve($customer->stripe_setup_intent_id);
            } else {
                $setup_intent = \Stripe\SetupIntent::retrieve($customer->stripe_setup_intent_id,
                    ['stripe_account' => $customer->stripe_account_id]);
            }

        }


        if ($setup_intent->status === 'succeeded') {
            // SetupIntent is successful, payment method is saved

            $paymentRequest = new \Illuminate\Http\Request([
                'amount' => $request->amount,
                'customer' => $customer->id,
                'stripe_account_id' => $customer->stripe_account_id
            ]);

            return $this->createPaymentIntent($paymentRequest);

        } else {

            return redirect('/payment-form/' . $customer->id . '?amount=' . $request->amount);

        }


    }


    public function showPaymentForm(Request $request)
    {

        $customer = \App\Models\Customer::where('id', $request->customer_id)->first();

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        if ($customer->stripe_account_id == 'main') {

            $intent = SetupIntent::retrieve($customer->stripe_setup_intent_id);
        } else {

            $intent = SetupIntent::retrieve($customer->stripe_setup_intent_id, ['stripe_account' => $customer->stripe_account_id]);

        }


        return Inertia::render('PaymentForm', [
            'message' => 'PaymentIntent created',
            'clientSecret' => $intent->client_secret,
            'setupIntentId' => $intent->id,
            'customer' => $customer,
            'publishableKey' => env('STRIPE_PUBLISHABLE_KE')
        ]);
    }

    public function createPaymentIntent(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = \App\Models\Customer::where('id', $request->customer)->first();
        $setup_intent = \Stripe\SetupIntent::retrieve($customer->stripe_setup_intent_id);
        $intent = \Stripe\PaymentIntent::create([
            'payment_method_types' => ['us_bank_account'],
            'payment_method' => $setup_intent->payment_method,
            'customer' => $setup_intent->customer,
            'confirm' => true,
            'amount' => ($request->amount) * 100,
            'currency' => 'usd',
        ]);

        return redirect()->route('payments.success');
    }
}
