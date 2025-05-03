<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <section class="bg-gray-50 min-h-screen flex items-center justify-center">
        <div
            class="bg-gray-50 flex rounded-2xl shadow-lg max-w-4xl p-5 items-center h-[80vh]"
        >
            <div class="md:w-1/2 px-16">
                <slot />
            </div>

            <div class="md:block hidden w-1/2 h-full">
                <img
                    class="rounded-2xl h-full object-cover"
                    src="/images/login.jpg"
                    alt="Login Image"
                />
            </div>
        </div>
    </section>
    <!-- <div
        class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0 dark:bg-gray-900"
    >
        <div>
            <Link href="/">
                <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
            </Link>
        </div>

        <div
            class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg dark:bg-gray-800"
        >
            <slot />
        </div>
    </div> -->
</template>
