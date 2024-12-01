<template>
    <!--header-->
    <Header />

    <!--section-->
    <Hero />
    <!--product-->
    <slot />
    <!--footer-->
    <Footer />
</template>

<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import Header from "./Header.vue";
import Footer from "./Footer.vue";
import Hero from "./Hero.vue";
// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});
</script>
