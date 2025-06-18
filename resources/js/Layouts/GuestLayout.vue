<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <section
        class="bg-gray-50 min-h-screen flex items-center justify-center px-4"
    >
        <div
            class="flex flex-col md:flex-row bg-white rounded-2xl shadow-lg w-full max-w-screen-lg overflow-hidden"
        >
            <!-- Left Side (Form) -->
            <div
                class="w-full md:w-1/2 px-6 sm:px-10 py-8 flex flex-col justify-center"
            >
                <slot />
            </div>

            <!-- Right Image -->
            <div class="hidden md:block w-1/2">
                <img
                    src="/images/login.jpg"
                    alt="Login Image"
                    class="w-full h-full object-cover"
                />
            </div>
        </div>
    </section>
</template>
