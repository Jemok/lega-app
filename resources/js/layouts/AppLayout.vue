<script setup>
import {
    ScaleIcon,
} from '@heroicons/vue/24/outline'

const navigation = [
    { name: 'Home', href: '/' },
    { name: 'About Us', href: '/#about' },
    { name: 'Practice Areas', href: '/#services' },
    { name: 'Attorneys', href: '/#attorneys' },
    { name: 'Resources', href: '/#resources' },
    { name: 'Contact Us', href: '/#contact' },
]
</script>

<template>
    <div class="bg-white dark:bg-gray-900 flex flex-col min-h-screen">
        <!-- NAVBAR -->
        <header class="inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="/" class="-m-1.5 p-1.5 flex items-center">
                        <ScaleIcon class="h-8 w-8 text-indigo-600" />
                        <span class="ml-2 text-lg font-bold text-gray-900 dark:text-white">
              Justice Law Firm
            </span>
                    </a>
                </div>
                <div class="hidden lg:flex lg:gap-x-12">
                    <a v-for="item in navigation" :key="item.name" :href="item.href"
                       class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-100 hover:text-indigo-600">
                        {{ item.name }}
                    </a>
                    <!-- ✅ Pay Legal Fees -->
                    <a href="/pay-legal-fees"
                       class="rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500">
                        Pay Legal Fees
                    </a>
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <a href="/#contact" class="text-sm font-semibold leading-6 text-indigo-600">
                        Book Consultation →
                    </a>
                </div>
            </nav>
        </header>

        <!-- PAGE CONTENT -->
        <main class="flex-grow">
            <slot />
        </main>

        <!-- FOOTER -->
        <footer class="bg-gray-900 py-12">
            <div class="mx-auto max-w-7xl px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-3 gap-12 text-gray-400">
                <div>
                    <h3 class="text-white font-semibold">Practice Areas</h3>
                    <ul class="mt-4 space-y-2">
                        <li>Corporate Law</li>
                        <li>Family Law</li>
                        <li>Litigation</li>
                        <li>Real Estate</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold">Resources</h3>
                    <ul class="mt-4 space-y-2">
                        <li>Blog</li>
                        <li>FAQs</li>
                        <li>Case Studies</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold">Contact Us</h3>
                    <p class="mt-4">123 Main Street, Suite 400</p>
                    <p>New York, NY 10001</p>
                    <p>(123) 456-7890</p>
                    <p>info@justicefirm.com</p>
                </div>
            </div>
            <div class="mt-8 text-center text-sm text-gray-500">
                © 2025 Justice Law Firm. All rights reserved.
            </div>
        </footer>
    </div>
</template>
