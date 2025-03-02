<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <footer
        class="fixed bottom-0 left-0 z-20 w-full p-4 bg-white border-t border-gray-200 shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800 dark:border-gray-600"
    >
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400"
            >© 2023
            <a href="https://flowbite.com/" class="hover:underline">X Shop™</a
            >. All Rights Reserved.
        </span>
        <ul
            class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0"
        >
            <li>
                <Link :href="route('about')" class="hover:underline me-4 md:me-6">About</Link>
            </li>
            <li>
                <Link :href="route('privacy')" class="hover:underline me-4 md:me-6"
                    >Privacy Policy</Link
                >
            </li>
            <li>
                <Link :href="route('terms')" class="hover:underline me-4 md:me-6">Terms & Conditions</Link>
            </li>
            <li>
                <Link :href="route('contact')" class="hover:underline">Contact</Link>
            </li>
        </ul>
    </footer>
</template>
