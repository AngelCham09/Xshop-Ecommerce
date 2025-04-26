<script setup>
import UserLayouts from "./Layouts/UserLayout.vue";
</script>
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
                    Contact Us
                </h1>
                <p
                    class="mb-8 text-lg font-normal text-gray-600 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-300"
                >
                    We're here to help! Reach out to us through any of the
                    channels below.
                </p>
            </div>
        </section>

        <!-- Main Content -->
        <section class="py-16 bg-white dark:bg-gray-900 mb-16">
            <div class="container mx-auto px-4">
                <!-- Contact Methods Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                    <!-- Quick Contact Cards -->
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center transform transition-all duration-300 hover:scale-105"
                    >
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-purple-600 to-violet-500 rounded-full flex items-center justify-center mx-auto mb-4"
                        >
                            <svg
                                class="w-8 h-8 text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                />
                            </svg>
                        </div>
                        <h3
                            class="text-xl font-bold mb-2 text-gray-900 dark:text-white"
                        >
                            Phone Support
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            Available Mon-Fri, 9AM-6PM
                        </p>
                        <a
                            href="tel:1-800-X-SHOP"
                            class="text-purple-600 dark:text-purple-400 font-medium hover:text-purple-700"
                            >1-800-X-SHOP</a
                        >
                    </div>

                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center transform transition-all duration-300 hover:scale-105"
                    >
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-purple-600 to-violet-500 rounded-full flex items-center justify-center mx-auto mb-4"
                        >
                            <svg
                                class="w-8 h-8 text-white"
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
                        </div>
                        <h3
                            class="text-xl font-bold mb-2 text-gray-900 dark:text-white"
                        >
                            Email Support
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            We'll respond within 24 hours
                        </p>
                        <a
                            href="mailto:support@xshop.com"
                            class="text-purple-600 dark:text-purple-400 font-medium hover:text-purple-700"
                            >support@xshop.com</a
                        >
                    </div>

                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center transform transition-all duration-300 hover:scale-105"
                    >
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-purple-600 to-violet-500 rounded-full flex items-center justify-center mx-auto mb-4"
                        >
                            <svg
                                class="w-8 h-8 text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"
                                />
                            </svg>
                        </div>
                        <h3
                            class="text-xl font-bold mb-2 text-gray-900 dark:text-white"
                        >
                            Live Chat
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            Available 24/7
                        </p>
                        <button
                            class="text-purple-600 dark:text-purple-400 font-medium hover:text-purple-700"
                        >
                            Start Chat
                        </button>
                    </div>
                </div>

                <!-- Contact Form -->
                <div
                    class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8"
                >
                    <h2
                        class="text-2xl font-bold mb-6 text-gray-900 dark:text-white text-center"
                    >
                        Send us a Message
                    </h2>
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                    >First Name</label
                                >
                                <input
                                    type="text"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required
                                />
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                    >Last Name</label
                                >
                                <input
                                    type="text"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required
                                />
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                >Email</label
                            >
                            <input
                                type="email"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required
                            />
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                >Subject</label
                            >
                            <select
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required
                            >
                                <option value="">Select a subject</option>
                                <option value="order">Order Inquiry</option>
                                <option value="product">
                                    Product Information
                                </option>
                                <option value="shipping">
                                    Shipping & Delivery
                                </option>
                                <option value="returns">
                                    Returns & Refunds
                                </option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                >Message</label
                            >
                            <textarea
                                rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required
                            ></textarea>
                        </div>

                        <div class="flex justify-center">
                            <button
                                type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-purple-600 to-violet-500 text-white font-medium rounded-lg hover:from-purple-700 hover:to-violet-600 focus:ring-4 focus:ring-purple-500/50 transition-all duration-300"
                            >
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>

                <!-- FAQ Section -->
                <div class="max-w-3xl mx-auto mt-16">
                    <h2
                        class="text-2xl font-bold mb-8 text-gray-900 dark:text-white text-center"
                    >
                        Frequently Asked Questions
                    </h2>
                    <div class="space-y-4">
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg shadow p-6"
                        >
                            <h3
                                class="text-lg font-semibold text-gray-900 dark:text-white mb-2"
                            >
                                What are your shipping times?
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300">
                                We offer standard shipping (3-5 business days)
                                and express shipping (1-2 business days)
                                options.
                            </p>
                        </div>
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg shadow p-6"
                        >
                            <h3
                                class="text-lg font-semibold text-gray-900 dark:text-white mb-2"
                            >
                                What is your return policy?
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300">
                                We offer a 30-day return policy for all unused
                                items in their original packaging.
                            </p>
                        </div>
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg shadow p-6"
                        >
                            <h3
                                class="text-lg font-semibold text-gray-900 dark:text-white mb-2"
                            >
                                Do you ship internationally?
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300">
                                Yes, we ship to most countries worldwide.
                                Shipping times and costs vary by location.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </UserLayouts>
</template>
