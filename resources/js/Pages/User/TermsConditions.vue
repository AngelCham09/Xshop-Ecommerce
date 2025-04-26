<template>
    <UserLayouts>
        <!-- Hero Section -->
        <section
            class="bg-gradient-to-br from-purple-50 to-pink-50 dark:from-gray-900 dark:to-gray-800"
        >
            <div
                class="py-12 px-4 mx-auto max-w-screen-xl text-center lg:py-16"
            >
                <h1
                    class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white"
                >
                    Terms & Conditions
                </h1>
                <p
                    class="mb-8 text-lg font-normal text-gray-600 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-300"
                >
                    Last updated: {{ currentDate }}
                </p>
            </div>
        </section>

        <!-- Main Content -->
        <section class="py-16 bg-white dark:bg-gray-900 mb-16">
            <div class="container mx-auto px-4 max-w-4xl">
                <!-- Quick Links -->
                <div class="mb-12 p-6 bg-purple-50 dark:bg-gray-800 rounded-xl">
                    <h2
                        class="text-xl font-bold mb-4 text-gray-900 dark:text-white"
                    >
                        Quick Navigation
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div
                            v-for="(section, index) in sections.slice(
                                0,
                                Math.ceil(sections.length / 2)
                            )"
                            :key="index"
                            class="flex items-center space-x-2"
                        >
                            <div
                                class="w-2 h-2 bg-purple-600 rounded-full"
                            ></div>
                            <a
                                :href="`#${section.id}`"
                                class="text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300"
                            >
                                {{ section.title }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Agreement Alert -->
                <div class="mb-12 p-6 bg-purple-600 text-white rounded-xl">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold mb-2">Important Notice</h3>
                            <p class="text-sm">
                                By accessing and using X Shop's services, you
                                acknowledge that you have read, understood, and
                                agree to be bound by these Terms and Conditions.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Terms Content -->
                <div class="space-y-12">
                    <div
                        v-for="(section, index) in sections"
                        :key="index"
                        :id="section.id"
                        class="scroll-mt-16"
                    >
                        <div
                            class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6"
                        >
                            <h2
                                class="text-2xl font-bold mb-6 text-gray-900 dark:text-white flex items-center"
                            >
                                <span
                                    class="w-8 h-8 bg-gradient-to-r from-purple-600 to-violet-500 rounded-full flex items-center justify-center text-white text-sm mr-3"
                                >
                                    {{ index + 1 }}
                                </span>
                                {{ section.title }}
                            </h2>
                            <div
                                class="prose prose-purple dark:prose-invert max-w-none"
                            >
                                <div
                                    class="text-gray-600 dark:text-gray-300"
                                    v-html="section.content"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Box -->
                <div
                    class="mt-12 p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg"
                >
                    <h2
                        class="text-xl font-bold mb-4 text-gray-900 dark:text-white"
                    >
                        Need Clarification?
                    </h2>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        If you have any questions about these Terms and
                        Conditions, please contact us:
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a
                            href="mailto:legal@xshop.com"
                            class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors"
                        >
                            <svg
                                class="w-4 h-4 mr-2"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                />
                            </svg>
                            Email Legal Team
                        </a>
                        <a
                            href="/contact"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600"
                        >
                            <svg
                                class="w-4 h-4 mr-2"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                                />
                            </svg>
                            Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </UserLayouts>
</template>

<script setup>
import { ref } from "vue";
import UserLayouts from "./Layouts/UserLayout.vue";

const currentDate = new Date().toLocaleDateString("en-US", {
    year: "numeric",
    month: "long",
    day: "numeric",
});

const sections = [
    {
        id: "acceptance",
        title: "Acceptance of Terms",
        content: `
            By accessing and using X Shop's website and services, you accept and agree to be bound by these Terms and Conditions. If you do not agree to these terms, please do not use our services.
            <p class="mt-4">These terms apply to all users, including without limitation:</p>
            <ul class="list-disc pl-6 mt-4 space-y-2">
                <li>Browsers of the site</li>
                <li>Registered customers</li>
                <li>Vendors</li>
                <li>Merchants</li>
                <li>Contributors of content</li>
            </ul>
        `,
    },
    {
        id: "account",
        title: "Account Registration & Security",
        content: `
            <p class="mb-4">When you create an account with us, you must provide accurate, complete, and current information. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account.</p>
            <p class="mb-4">You are responsible for:</p>
            <ul class="list-disc pl-6 space-y-2">
                <li>Maintaining the confidentiality of your account and password</li>
                <li>Restricting access to your computer and/or account</li>
                <li>Accepting responsibility for any and all activities that occur under your account</li>
            </ul>
        `,
    },
    {
        id: "purchases",
        title: "Purchases & Payment",
        content: `
            <p class="mb-4">All purchases through our site are subject to our product availability. We reserve the right to refuse service to anyone for any reason at any time.</p>
            <p class="mb-4">Payment Terms:</p>
            <ul class="list-disc pl-6 space-y-2">
                <li>Prices for products are subject to change without notice</li>
                <li>All prices are in the displayed currency</li>
                <li>Payments are processed securely through our payment providers</li>
                <li>We reserve the right to refuse or cancel orders at our discretion</li>
            </ul>
        `,
    },
    {
        id: "shipping",
        title: "Shipping & Delivery",
        content: `
            <p class="mb-4">We strive to deliver products in the quickest possible time. By making a purchase, you agree to:</p>
            <ul class="list-disc pl-6 space-y-2">
                <li>Provide accurate shipping information</li>
                <li>Accept responsibility for import duties and taxes</li>
                <li>Acknowledge that shipping times are estimates</li>
                <li>Accept our shipping policies and terms</li>
            </ul>
        `,
    },
    {
        id: "returns",
        title: "Returns & Refunds",
        content: `
            <p class="mb-4">Our return policy lasts 30 days. If 30 days have passed since your purchase, we cannot offer you a refund or exchange.</p>
            <p class="mb-4">To be eligible for a return:</p>
            <ul class="list-disc pl-6 space-y-2">
                <li>Item must be unused and in its original condition</li>
                <li>Item must be in the original packaging</li>
                <li>Proof of purchase is required</li>
            </ul>
        `,
    },
    {
        id: "intellectual-property",
        title: "Intellectual Property",
        content: `
            <p class="mb-4">The content on X Shop, including without limitation:</p>
            <ul class="list-disc pl-6 space-y-2">
                <li>Text</li>
                <li>Graphics</li>
                <li>Logos</li>
                <li>Images</li>
                <li>Software</li>
            </ul>
            <p class="mt-4">is owned by X Shop and is protected by copyright, trademark, and other intellectual property laws.</p>
        `,
    },
    {
        id: "limitation-liability",
        title: "Limitation of Liability",
        content: `
            X Shop shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use of or inability to use our services.
            <p class="mt-4">This includes but is not limited to:</p>
            <ul class="list-disc pl-6 space-y-2">
                <li>Loss of profits</li>
                <li>Loss of data</li>
                <li>Cost of replacement goods</li>
                <li>Any other losses</li>
            </ul>
        `,
    },
    {
        id: "modifications",
        title: "Modifications to Terms",
        content: `
            <p class="mb-4">We reserve the right to modify these terms at any time. Changes will be effective immediately upon posting to the website. Your continued use of X Shop following any changes indicates your acceptance of such changes.</p>
            <p>We will notify users of any material changes via:</p>
            <ul class="list-disc pl-6 space-y-2">
                <li>Email notification</li>
                <li>Site announcement</li>
                <li>Account dashboard notice</li>
            </ul>
        `,
    },
];
</script>

<style scoped>
html {
    scroll-behavior: smooth;
}
</style>
