<template>
    <UserLayouts>
        <!--section-->
        <Hero />
        <div class="bg-white">
            <div
                class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8"
            >
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Latest products
                </h2>

                <!--Product List Component-->
                <ProductList :products="products" :columns="4"/>

                <div class="flex justify-center mt-10">

                    <Link :href="route('products.index')" type="button" class="bg-gray-200 hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Show More</Link>
                </div>
            </div>
        </div>
    </UserLayouts>
</template>

<script setup>
import UserLayouts from "./Layouts/UserLayout.vue";
import { Link, router } from "@inertiajs/vue3";
import Hero from "./Layouts/Hero.vue";
import ProductList from "./Components/ProductList.vue";
defineProps({
    products: Array,
});


</script>
