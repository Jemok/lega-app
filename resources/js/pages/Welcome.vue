<script setup>
import {
    ScaleIcon,
    BriefcaseIcon,
    UserGroupIcon,
    HomeIcon,
    HeartIcon,
    GlobeAltIcon,
} from '@heroicons/vue/24/outline'

// ✅ Navbar items
const navigation = [
    { name: 'Home', href: '#' },
    { name: 'About Us', href: '#about' },
    { name: 'Practice Areas', href: '#services' },
    { name: 'Attorneys', href: '#attorneys' },
    { name: 'Resources', href: '#resources' },
    { name: 'Contact Us', href: '#contact' },
]

// ✅ Practice Areas
const features = [
    {
        name: 'Corporate Law',
        description: 'Business formation, contracts, mergers, and compliance.',
        icon: BriefcaseIcon,
    },
    {
        name: 'Family Law',
        description: 'Divorce, custody, adoption, and child support representation.',
        icon: HeartIcon,
    },
    {
        name: 'Litigation',
        description: 'Civil and commercial disputes handled professionally.',
        icon: ScaleIcon,
    },
    {
        name: 'Real Estate Law',
        description: 'Property transactions, disputes, and due diligence.',
        icon: HomeIcon,
    },
    {
        name: 'Employment Law',
        description: 'Protecting both employers and employees.',
        icon: UserGroupIcon,
    },
    {
        name: 'Immigration Law',
        description: 'Visas, residency, and naturalization assistance.',
        icon: GlobeAltIcon,
    },
]

// ✅ Pricing / Consultation
const tiers = [
    {
        id: 'consult',
        name: 'Initial Consultation',
        href: '#contact',
        priceMonthly: 'Free',
        description: 'Meet with an attorney to discuss your legal needs.',
        features: [
            '30-minute consultation',
            'Case assessment',
            'No obligation to retain',
        ],
        featured: false,
    },
    {
        id: 'retainer',
        name: 'Hourly / Retainer',
        href: '#contact',
        priceMonthly: '$200/hr',
        description: 'Pay per hour or establish a monthly retainer plan.',
        features: [
            'Corporate, family, and litigation services',
            'Dedicated legal team',
            'Flexible payment options',
        ],
        featured: true,
    },
]

// ✅ FAQ
const faqs = [
    {
        question: 'Do you offer free consultations?',
        answer: 'Yes. We provide a complimentary 30-minute initial consultation.',
    },
    {
        question: 'How do retainer agreements work?',
        answer:
            'You deposit an upfront amount, and we bill against it as services are rendered. Unused amounts may be refunded depending on the agreement.',
    },
    {
        question: 'What areas of law do you specialize in?',
        answer:
            'We specialize in corporate law, family law, litigation, real estate, immigration, and employment law.',
    },
    {
        question: 'How do I get started?',
        answer:
            'Simply book a consultation through our website or call us directly at (123) 456-7890.',
    },
]
</script>

<template>
    <div class="bg-white dark:bg-gray-900">
        <!-- NAVBAR -->
        <!-- NAVBAR -->
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="#" class="-m-1.5 p-1.5 flex items-center">
                        <ScaleIcon class="h-8 w-8 text-indigo-600" />
                        <span class="ml-2 text-lg font-bold text-gray-900 dark:text-white">
          Rossman Law
        </span>
                    </a>
                </div>
                <div class="hidden lg:flex lg:gap-x-12">
                    <a v-for="item in navigation" :key="item.name" :href="item.href"
                       class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-100 hover:text-indigo-600">
                        {{ item.name }}
                    </a>
                    <!-- ✅ New Pay button in navbar -->
                    <!-- ✅ Pay Legal Fees button in navbar -->
                    <a href="/pay-legal-fees"
                       class="rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500">
                        Pay Legal Fees
                    </a>
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <a href="#contact" class="text-sm font-semibold leading-6 text-indigo-600">
                        Book Consultation →
                    </a>
                </div>
            </nav>
        </header>

        <!-- HERO -->
        <div class="relative isolate px-6 pt-24 lg:px-8">
            <div class="mx-auto max-w-3xl py-24 sm:py-32 lg:py-40 text-center">
                <h1 class="text-5xl font-semibold tracking-tight text-gray-900 dark:text-white sm:text-7xl">
                    Trusted Legal Solutions for Individuals & Businesses
                </h1>
                <p class="mt-8 text-lg font-medium text-gray-600 dark:text-gray-400">
                    Our experienced attorneys provide dedicated representation in
                    corporate law, family matters, litigation, and more.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="#contact" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                        Book a Consultation
                    </a>
                    <a href="#about" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">
                        Learn More →
                    </a>
                </div>
            </div>
        </div>

        <!-- ABOUT US -->
        <section id="about" class="py-24 sm:py-32 bg-gray-50 dark:bg-gray-800">
            <div class="mx-auto max-w-4xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">About Us</h2>
                <p class="mt-6 text-lg text-gray-600 dark:text-gray-400">
                    Rossman Law has been serving clients for over 20 years, delivering trusted legal services with integrity and excellence. Our mission is to provide personalized representation that protects our clients’ rights and achieves their goals.
                </p>
            </div>
        </section>

        <!-- PRACTICE AREAS -->
        <section id="services" class="py-24 sm:py-32 bg-gray-50 dark:bg-gray-800">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="sm:text-center">
                    <h2 class="text-lg font-semibold text-indigo-600">Practice Areas</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                        Legal Expertise You Can Rely On
                    </p>
                </div>
                <div class="mt-16 grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-3">
                    <div v-for="feature in features" :key="feature.name" class="flex">
                        <feature.icon class="h-10 w-10 flex-shrink-0 text-indigo-600" aria-hidden="true" />
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ feature.name }}</h3>
                            <p class="mt-2 text-base text-gray-600 dark:text-gray-400">{{ feature.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ATTORNEYS -->
        <section id="attorneys" class="py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Meet Our Attorneys</h2>
                <p class="mt-6 text-lg text-gray-600 dark:text-gray-400">
                    Our experienced team is dedicated to protecting your interests and guiding you through every legal challenge.
                </p>
                <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="rounded-xl bg-gray-50 dark:bg-gray-800 p-6 shadow">
                        <img src="images/travis.png" alt="Travis" class="mx-auto rounded-full h-32 w-32 object-cover">
                        <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Travis Alan Rossman</h3>
                        <p class="text-gray-600 dark:text-gray-400">Senior Partner – Corporate Law</p>
                    </div>
                    <div class="rounded-xl bg-gray-50 dark:bg-gray-800 p-6 shadow">
                        <img src="images/john_smith.png" alt="John Smith" class="mx-auto rounded-full h-32 w-32 object-cover">
                        <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">John Smith</h3>
                        <p class="text-gray-600 dark:text-gray-400">Partner – Litigation & Disputes</p>
                    </div>
                    <div class="rounded-xl bg-gray-50 dark:bg-gray-800 p-6 shadow">
                        <img src="images/emily_johnson.png" alt="Attorney 3" class="mx-auto rounded-full h-32 w-32 object-cover">
                        <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Emily Johnson</h3>
                        <p class="text-gray-600 dark:text-gray-400">Associate – Family & Immigration Law</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- RESOURCES -->
        <section id="resources" class="py-24 sm:py-32 bg-gray-50 dark:bg-gray-800">
            <div class="mx-auto max-w-5xl px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Resources</h2>
                <p class="mt-6 text-lg text-gray-600 dark:text-gray-400">
                    Stay informed with our legal insights, case studies, and FAQs.
                </p>
                <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="p-6 bg-white dark:bg-gray-900 shadow rounded-xl">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Blog</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Latest updates on legal trends and advice from our attorneys.</p>
                    </div>
                    <div class="p-6 bg-white dark:bg-gray-900 shadow rounded-xl">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Case Studies</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Read about real-world cases and how we achieved success.</p>
                    </div>
                    <div class="p-6 bg-white dark:bg-gray-900 shadow rounded-xl">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">FAQs</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Quick answers to the most common legal questions.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CONTACT -->
        <section id="contact" class="py-24 sm:py-32">
            <div class="mx-auto max-w-3xl px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Contact Us</h2>
                <p class="mt-6 text-lg text-gray-600 dark:text-gray-400">
                    Reach out to our team today for legal advice or to schedule a consultation.
                </p>
                <form class="mt-12 space-y-6">
                    <input type="text" placeholder="Your Name" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 px-4 py-2" />
                    <input type="email" placeholder="Your Email" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 px-4 py-2" />
                    <textarea placeholder="Your Message" rows="4" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 px-4 py-2"></textarea>
                    <button type="submit" class="w-full rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500">
                        Send Message
                    </button>
                </form>
            </div>
        </section>

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
                    <p class="mt-4">220 COURT SQUARE</p>
                    <p>BARBOURVILLE, KY 40906</p>
                    <p>606-277-0525</p>
<!--                    <p>travisrsm@gmail.com</p>-->
                </div>
            </div>
            <div class="mt-8 text-center text-sm text-gray-500">
                © 2025 Rossman Law. All rights reserved.
            </div>
        </footer>
    </div>
</template>
