<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Icon } from "@iconify/vue";
import { ref } from 'vue';

const showPassword = ref(false);
const showPasswordConfirmation = ref(false);

const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};

const togglePasswordConfirmationVisibility = () => {
    showPasswordConfirmation.value = !showPasswordConfirmation.value;
};

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <h2 class="font-bold text-2xl text-blue-800 mt-2">Register</h2>
        <p class="text-sm mt-4 text-blue-800">
            Welcome to X Shop, enjoy your shopping experience !
        </p>

        <form class="flex flex-col gap-4 mb-2" @submit.prevent="submit">
            <input
                class="p-3 mt-8 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="text"
                name="name"
                v-model="form.name"
                required
                placeholder="Username"
            />
            <InputError :message="form.errors.name" />

            <input
                class="p-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="text"
                name="email"
                v-model="form.email"
                required
                placeholder="Email"
            />
            <InputError :message="form.errors.email" />

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
            <InputError :message="form.errors.password" />

             <div class="relative">
                <input
                    class="p-3 rounded-xl border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                    :type="showPasswordConfirmation ? 'text' : 'password'"
                    name="password_confirmation"
                    v-model="form.password_confirmation"
                    required
                    placeholder="Confirm Password"
                />
                <Icon
                    :icon="showPasswordConfirmation ? 'lucide:eye-off' : 'lucide:eye'"
                    width="24"
                    height="24"
                    class="absolute top-1/2 right-3 -translate-y-1/2 cursor-pointer"
                    @click="togglePasswordConfirmationVisibility"
                />
            </div>
            <InputError :message="form.errors.password_confirmation" />

            <button
                type="submit"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                class="hover:scale-105 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-3 text-center mb-2 transition-transform duration-300"
            >
                Register
            </button>

            <div class="text-xs flex justify-between items-center">
                <p>Already registered?</p>
                <Link
                    :href="route('login')"
                    class="hover:scale-105 py-2 px-5 bg-white border rounded-xl transition-transform duration-300"
                >
                    Login
                </Link>
            </div>
        </form>


        <!-- <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form> -->
    </GuestLayout>
</template>
