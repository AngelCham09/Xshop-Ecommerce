<template>
    <AdminLayout>
        <ProductList/>
    </AdminLayout>
</template>

<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import AdminLayout from "../Components/AdminLayout.vue";
import ProductList from "../Components/ProductList.vue";

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});
</script>
