<template>
    <!--header-->
    <Header />

    <!-- Main content -->
    <main>
        <slot />
    </main>

    <!--footer-->
    <Footer />
</template>

<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import Header from "./Header.vue";
import Footer from "./Footer.vue";

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});
</script>
