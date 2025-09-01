<script setup>
import AppLayout from '@/layouts/AppLayout.vue'

</script>

<template>
    <AppLayout title="Payment Success">
        <div class="p-8 text-center">
            <h1 class="text-2xl font-bold text-green-600">✅ Payment Successful</h1>
            <p class="mt-4 text-lg">Your payment has been processed successfully.</p>

<!--            <div class="mt-6 bg-white shadow rounded-lg p-6 max-w-md mx-auto">-->
<!--                <p class="text-gray-700">-->
<!--                    <span class="font-semibold">Amount:</span>-->
<!--                    {{ amount }} {{ currency }}-->
<!--                </p>-->
<!--            </div>-->

            <div class="mt-8">
                <a href="/" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Go Home
                </a>
            </div>
        </div>
    </AppLayout>
</template>
