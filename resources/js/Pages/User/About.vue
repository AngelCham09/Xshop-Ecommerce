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
                class="py-16 px-4 mx-auto max-w-screen-xl text-center lg:py-24"
            >
                <div class="mb-8">
                    <span
                        class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-violet-500"
                        >X Shop</span
                    >
                </div>
                <h1
                    class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white"
                >
                    Redefining Online Shopping
                </h1>
                <p
                    class="mb-8 text-lg font-normal text-gray-600 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-300"
                >
                    Where Style Meets Innovation
                </p>
            </div>
        </section>

        <!-- Story Section -->
        <section class="py-16 bg-white dark:bg-gray-900">
            <div class="container mx-auto px-4">
                <!-- Brand Story -->
                <div class="max-w-3xl mx-auto mb-16 text-center">
                    <h2
                        class="text-3xl font-bold mb-6 text-gray-900 dark:text-white"
                    >
                        Our Story
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300 mb-6">
                        Founded in 2020, X Shop emerged with a vision to
                        revolutionize the online shopping experience. We believe
                        in making premium products accessible to everyone,
                        combining cutting-edge technology with exceptional
                        customer service.
                    </p>
                    <div class="flex justify-center gap-4 mt-8">
                        <div
                            class="px-6 py-3 bg-purple-100 dark:bg-gray-800 rounded-full"
                        >
                            <span
                                class="text-purple-600 dark:text-purple-400 font-medium"
                                >Fast Delivery</span
                            >
                        </div>
                        <div
                            class="px-6 py-3 bg-purple-100 dark:bg-gray-800 rounded-full"
                        >
                            <span
                                class="text-purple-600 dark:text-purple-400 font-medium"
                                >Premium Quality</span
                            >
                        </div>
                        <div
                            class="px-6 py-3 bg-purple-100 dark:bg-gray-800 rounded-full"
                        >
                            <span
                                class="text-purple-600 dark:text-purple-400 font-medium"
                                >24/7 Support</span
                            >
                        </div>
                    </div>
                </div>

                <!-- Why Choose Us -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                    <div
                        class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg text-center transform transition-all duration-300 hover:scale-105"
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
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>
                        <h3
                            class="text-xl font-bold mb-2 text-gray-900 dark:text-white"
                        >
                            Lightning Fast Delivery
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Same-day delivery in selected areas. Your
                            satisfaction is our priority.
                        </p>
                    </div>

                    <div
                        class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg text-center transform transition-all duration-300 hover:scale-105"
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
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                                />
                            </svg>
                        </div>
                        <h3
                            class="text-xl font-bold mb-2 text-gray-900 dark:text-white"
                        >
                            Quality Guarantee
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            All products are carefully curated and
                            quality-checked.
                        </p>
                    </div>

                    <div
                        class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg text-center transform transition-all duration-300 hover:scale-105"
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
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                                />
                            </svg>
                        </div>
                        <h3
                            class="text-xl font-bold mb-2 text-gray-900 dark:text-white"
                        >
                            Easy Shopping
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Intuitive interface and secure checkout process.
                        </p>
                    </div>
                </div>

                <!-- Stats Section -->
                <div
                    class="bg-gradient-to-r from-purple-600 to-violet-500 rounded-2xl p-8 text-white mb-16"
                >
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div class="text-center">
                            <h4 class="text-4xl font-bold mb-2">100k+</h4>
                            <p class="text-purple-100">Happy Customers</p>
                        </div>
                        <div class="text-center">
                            <h4 class="text-4xl font-bold mb-2">50k+</h4>
                            <p class="text-purple-100">Products</p>
                        </div>
                        <div class="text-center">
                            <h4 class="text-4xl font-bold mb-2">99%</h4>
                            <p class="text-purple-100">Satisfaction Rate</p>
                        </div>
                        <div class="text-center">
                            <h4 class="text-4xl font-bold mb-2">24/7</h4>
                            <p class="text-purple-100">Support</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </UserLayouts>
</template>
