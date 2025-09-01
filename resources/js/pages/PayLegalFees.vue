<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'

const name = ref('')
const email = ref('')
const successMessage = ref('')
const amount = ref('')

const submitForm = () => {
    router.post('/create-customer', { name: name.value, email: email.value, amount: amount.value }, {
        onSuccess: (page) => {
            if (page?.props?.flash?.success) {
                successMessage.value = page?.props?.flash?.success
            }
        }
    })
}
</script>

<template>
    <AppLayout>
        <div class="flex items-center justify-center py-24 px-4">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-8 w-full max-w-md">
                <h1 class="text-2xl font-bold mb-4 text-indigo-600">Pay Legal Fees</h1>

                <form @submit.prevent="submitForm" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 dark:text-gray-200">Name</label>
                        <input v-model="name" type="text"  class="w-full p-2 rounded bg-transparent border border-white text-white placeholder-gray-400 focus:outline-none focus:border-purple-400" required />
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-200">Email</label>
                        <input v-model="email" type="email"  class="w-full p-2 rounded bg-transparent border border-white text-white placeholder-gray-400 focus:outline-none focus:border-purple-400" required />
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-200">Amount</label>
                        <input v-model="amount" type="number"  class="w-full p-2 rounded bg-transparent border border-white text-white placeholder-gray-400 focus:outline-none focus:border-purple-400" required />
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700">
                       Pay Legal Fees Now
                    </button>
                </form>

                <p v-if="successMessage" class="mt-4 text-green-600">{{ successMessage }}</p>
            </div>
        </div>
    </AppLayout>
</template>
