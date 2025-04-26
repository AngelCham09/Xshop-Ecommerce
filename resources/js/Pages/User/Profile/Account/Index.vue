<script setup>
import ProfileLayout from "../../Layouts/ProfileLayout.vue";
import ProfileSection from "./ProfileSection.vue";
import PasswordSection from "./PasswordSection.vue";
import DeleteProfileSection from "./DeleteProfileSection.vue";
</script>

<template>
    <ProfileLayout>
        <ProfileSection/>
        <PasswordSection/>
        <DeleteProfileSection/>
    </ProfileLayout>
</template>
