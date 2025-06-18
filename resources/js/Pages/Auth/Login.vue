<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { ref } from "vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const showPassword = ref(false);

const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Login" />

        <h2 class="font-bold text-2xl text-blue-800">Login</h2>
        <p class="text-sm mt-4 text-blue-800">
            If you already a member, easily log in
        </p>
        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form class="flex flex-col gap-4" @submit.prevent="submit">
            <input
                class="p-3 mt-8 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="text"
                name="email"
                v-model="form.email"
                required
                placeholder="Email"
            />

            <div class="relative">
                <input
                    class="p-3 rounded-xl border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                    :type="showPassword ? 'text' : 'password'"
                    name="password"
                    v-model="form.password"
                    required
                    placeholder="Password"
                />
                <Icon
                    :icon="showPassword ? 'lucide:eye-off' : 'lucide:eye'"
                    width="24"
                    height="24"
                    class="absolute top-1/2 right-3 -translate-y-1/2 cursor-pointer"
                    @click="togglePasswordVisibility"
                />
            </div>

             <InputError :message="form.errors.email" />

            <div class="mt-2 block">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400"
                        >Remember me</span
                    >
                </label>
            </div>

            <button
                type="submit"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                class="hover:scale-105 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-3 text-center mb-2 transition-transform duration-300"
            >
                Login
            </button>

            <Link
                v-if="canResetPassword"
                :href="route('password.request')"
                class="border-b py-4 rounded-md text-xs text-gray-600 hover:text-gray-900"
            >
                Forgot your password?
            </Link>

            <div class="text-xs flex justify-between items-center">
                <p>Don't have an account?</p>
                <Link
                    :href="route('register')"
                    class="hover:scale-105 py-2 px-5 bg-white border rounded-xl transition-transform duration-300"
                >
                    Register
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
