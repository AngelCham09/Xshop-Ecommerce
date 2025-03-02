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
                    Privacy Policy
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
                <!-- Quick Navigation -->
                <div class="mb-12 p-6 bg-purple-50 dark:bg-gray-800 rounded-xl">
                    <h2
                        class="text-xl font-bold mb-4 text-gray-900 dark:text-white"
                    >
                        Table of Contents
                    </h2>
                    <ul class="space-y-2">
                        <li v-for="(section, index) in sections" :key="index">
                            <a
                                :href="`#${section.id}`"
                                class="text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300"
                            >
                                {{ section.title }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Privacy Content -->
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
                                class="text-2xl font-bold mb-4 text-gray-900 dark:text-white flex items-center"
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
                                <p
                                    class="text-gray-600 dark:text-gray-300"
                                    v-html="section.content"
                                ></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                <div
                    class="mt-12 p-6 bg-gradient-to-r from-purple-600 to-violet-500 rounded-xl text-white"
                >
                    <h2 class="text-xl font-bold mb-4">
                        Questions About Our Privacy Policy?
                    </h2>
                    <p class="mb-4">
                        If you have any questions about our privacy policy,
                        please don't hesitate to contact us.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a
                            href="/contact"
                            class="inline-flex items-center px-4 py-2 bg-white text-purple-600 rounded-lg hover:bg-gray-100 transition-colors"
                        >
                            Contact Us
                            <svg
                                class="w-4 h-4 ml-2"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"
                                />
                            </svg>
                        </a>
                        <a
                            href="mailto:privacy@xshop.com"
                            class="inline-flex items-center px-4 py-2 bg-white text-purple-600 rounded-lg hover:bg-gray-100 transition-colors"
                        >
                            Email Privacy Team
                            <svg
                                class="w-4 h-4 ml-2"
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
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </UserLayouts>
</template>

<script setup>
import { ref } from "vue";
import UserLayouts from "./Layouts/UserLayouts.vue";

const currentDate = new Date().toLocaleDateString("en-US", {
    year: "numeric",
    month: "long",
    day: "numeric",
});

const sections = [
    {
        id: "information-collection",
        title: "Information Collection and Use",
        content: `
            At X Shop, we collect several different types of information for various purposes:
            <ul class="list-disc pl-6 mt-4 space-y-2">
                <li>Personal identification information (Name, email address, phone number, etc.)</li>
                <li>Shopping preferences and history</li>
                <li>Device and browser information</li>
                <li>Location data (with your consent)</li>
            </ul>
        `,
    },
    {
        id: "data-usage",
        title: "How We Use Your Data",
        content: `
            We use the collected data for various purposes:
            <ul class="list-disc pl-6 mt-4 space-y-2">
                <li>To process and fulfill your orders</li>
                <li>To provide customer support</li>
                <li>To send you marketing communications (with your consent)</li>
                <li>To improve our services and website</li>
                <li>To protect against fraud and unauthorized transactions</li>
            </ul>
        `,
    },
    {
        id: "data-protection",
        title: "Data Protection",
        content: `
            We implement a variety of security measures to maintain the safety of your personal information:
            <ul class="list-disc pl-6 mt-4 space-y-2">
                <li>SSL encryption for all data transmission</li>
                <li>Regular security assessments</li>
                <li>Secure data storage with limited access</li>
                <li>Employee training on data protection</li>
            </ul>
        `,
    },
    {
        id: "cookies",
        title: "Cookies and Tracking",
        content: `
            We use cookies and similar tracking technologies to track activity on our website and hold certain information. Cookies are files with small amount of data which may include an anonymous unique identifier. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.
        `,
    },
    {
        id: "third-party",
        title: "Third-Party Services",
        content: `
            We may employ third-party companies and individuals for the following reasons:
            <ul class="list-disc pl-6 mt-4 space-y-2">
                <li>To facilitate our Service</li>
                <li>To provide payment processing</li>
                <li>To assist us in analyzing how our Service is used</li>
                <li>To send marketing communications</li>
            </ul>
        `,
    },
    {
        id: "your-rights",
        title: "Your Rights",
        content: `
            You have the following rights regarding your personal data:
            <ul class="list-disc pl-6 mt-4 space-y-2">
                <li>Right to access your personal data</li>
                <li>Right to correct inaccurate data</li>
                <li>Right to request deletion of your data</li>
                <li>Right to restrict processing of your data</li>
                <li>Right to data portability</li>
                <li>Right to object to processing of your data</li>
            </ul>
        `,
    },
    {
        id: "updates",
        title: "Policy Updates",
        content: `
            We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last updated" date at the top of this page. You are advised to review this Privacy Policy periodically for any changes.
        `,
    },
];
</script>

<style scoped>
/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}

/* Add any additional custom styles here */
</style>
