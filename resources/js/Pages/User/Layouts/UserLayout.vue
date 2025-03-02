<template>
    <!--header-->
    <Header />


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
import Toast from 'primevue/toast';


// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});
</script>
