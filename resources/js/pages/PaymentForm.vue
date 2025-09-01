<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '../Layouts/AppLayout.vue'
import { onMounted, ref } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps([
    'customer',
    'message',
    'clientSecret',
    'setupIntentId',
    'publishableKey',
]);

const form = useForm({
    payment_name: '',
    account_holder_name: '',
    email: '',
    amount: ''
})

const submit = () => {
    form.post('/payments')
}

let stripe
const accountHolderName = ref(props.customer.name)
const email = ref(props.customer.email)
const amount = ref('')
const account_number = ref('')
const acceptedMandate = ref(false) // 👈 track mandate acceptance


onMounted(() => {
    stripe = Stripe(props.publishableKey)

    // Get amount from query param
    const urlParams = new URLSearchParams(window.location.search)
    amount.value = urlParams.get('amount')
})

const handleSubmit = async () => {
    try {
        const { setupIntent, error } = await stripe.collectBankAccountForSetup({
            clientSecret: props.clientSecret,
            params: {
                payment_method_type: 'us_bank_account',
                payment_method_data: {
                    billing_details: {
                        name: accountHolderName.value,
                        email: email.value,
                    },
                },
            },
            expand: ['payment_method'],
        })

        if (error) {
            console.error(error.message)
            return
        }

        if (setupIntent?.status === 'requires_confirmation') {
            const { setupIntent: confirmed, error: confirmError } =
                await stripe.confirmUsBankAccountSetup(props.clientSecret)

            if (confirmError) {
                console.error(confirmError.message)
            } else if (confirmed?.status === 'succeeded') {
                console.log("✅ Bank account setup succeeded")
                console.log(confirmed)

                // 👉 Call your Laravel backend to create a PaymentIntent with `amount.value`
                // 👉 Use Inertia instead of axios
                router.post(`/payments/${props.customer.id}`, {
                    amount: amount.value,
                    payment_method: confirmed.payment_method,
                })
            }
        }
    } catch (err) {
        console.error(err)
    }
}
</script>


<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Submit Payment
            </h2>
        </template>

        <div class="bg-gray-900 p-6 rounded-lg w-full max-w-md mx-auto">
            <h2 class="text-2xl font-bold text-white mb-4">Pay Legal Fees</h2>

            <form id="payment-method-form" @submit.prevent="handleSubmit">
                <!-- Payment Name -->
                <div>
                    <label class="block text-white mb-1">Payment Name</label>
                    <input
                        type="text"
                        placeholder="Enter Payment Name"
                        class="w-full p-3 rounded bg-transparent border border-white text-white placeholder-gray-400 focus:outline-none focus:border-purple-400"
                    />
                </div>

                <!-- Customer Name -->
                <div>
                    <label class="block text-white mb-1">Customer Name</label>
                    <input
                        type="text"
                        v-model="accountHolderName"
                        placeholder="Enter Customer Name"
                        class="w-full p-3 rounded bg-transparent border border-white text-white placeholder-gray-400 focus:outline-none focus:border-purple-400"
                    />
                </div>

                <!-- Customer Email -->
                <div>
                    <label class="block text-white mb-1">Customer Email</label>
                    <input
                        v-model="email"
                        type="email"
                        placeholder="Enter Customer Email"
                        class="w-full p-3 rounded bg-transparent border border-white text-white placeholder-gray-400 focus:outline-none focus:border-purple-400"
                    />
                </div>

                <!-- Amount -->
                <div>
                    <label class="block text-white mb-1">Amount</label>
                    <input
                        type="number"
                        v-model="amount"
                        placeholder="Enter Amount"
                        class="w-full p-3 rounded bg-transparent border border-white text-white placeholder-gray-400 focus:outline-none focus:border-purple-400"
                    />
                </div>

                <!-- Account Number -->
                <div>
                    <label class="block text-white mb-1">Account Number</label>
                    <input
                        type="number"
                        v-model="account_number"
                        placeholder="Enter Account Number"
                        class="w-full p-3 rounded bg-transparent border border-white text-white placeholder-gray-400 focus:outline-none focus:border-purple-400"
                    />
                </div>

                <!-- Mandate Acceptance -->
                <div class="mt-4">
                    <label class="flex items-start space-x-2 text-white">
                        <input
                            type="checkbox"
                            v-model="acceptedMandate"
                            class="mt-1"
                            required
                        />
                        <span class="text-sm">
                            By clicking <strong>[accept mandate]</strong>, you authorise Justice Law Firm
                            to debit the bank account specified above for any amount owed for charges
                            arising from your use of Justice Law Firm’s services and/or purchase of
                            products from Justice Law Firm, pursuant to Justice Law Firm’s website and
                            terms, until this authorisation is revoked. You may amend or cancel this
                            authorisation at any time by providing notice to Justice Law Firm with
                            30 (thirty) days notice. If you use Justice Law Firm’s services or purchase
                            additional products periodically pursuant to Justice Law Firm’s terms,
                            you authorise Justice Law Firm to debit your bank account periodically.
                            Payments that fall outside the regular debits authorised above will only
                            be debited after your authorisation is obtained.
                        </span>
                    </label>
                </div>

                <!-- Submit -->
                <!-- Submit -->
                <div class="mt-6 flex justify-center">
                    <button
                        id="payment-button"
                        type="submit"
                        :data-secret="clientSecret"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700"
                    >
                        Submit Payment
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
