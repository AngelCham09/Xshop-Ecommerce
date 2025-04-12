<script setup>
import { ref } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { required } from "@vuelidate/validators";
import { useForm } from "@inertiajs/vue3";

const saving = ref(false);

// Initialize form with user data
const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

// Validation rules
const rules = {
    current_password: { required },
    password: { required },
    password_confirmation: { required },
};


const v$ = useVuelidate(rules, form);

const saveChanges = async () => {
    const isValid = await v$.value.$validate();

    if (!isValid) {
        Swal.fire({
                toast: true,
                icon: "error",
                position: "top-end",
                showConfirmButton: false,
                title: "Please check the form and try again.",
            });

        return;
    }

    saving.value = true;

    try {
        await form.put(route("password.update"), {
            preserveScroll: true,
            onSuccess: () => {
                // Show success toast
                Swal.fire({
                    toast: true,
                    icon: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    title: "Password updated successfully",
                });

                v$.value.$reset();
                form.reset();
            },
            onError: (errors) => {
                let errorMessage = "Failed to update password.";
                if (errors.message) {
                    errorMessage = errors.message;
                }
                else if (errors.current_password) {
                    errorMessage = errors.current_password;
                } else if (errors.password) {
                    errorMessage = errors.password;
                }

                Swal.fire({
                    toast: true,
                    icon: "error",
                    position: "top-end",
                    showConfirmButton: false,
                    title: errorMessage,
                });

            },
        });
    } finally {
        saving.value = false;
    }
};
</script>

<template>
    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
            <div class="flex ictems-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900">
                    Update Password
                </h2>
                <div class="space-x-2">
                    <button @click="saveChanges" class="btn-primary">
                        Save
                    </button>
                </div>
            </div>

            <div class="grid gap-6">
                <!-- Current Password -->
                <div>
                    <label class="block text-sm text-gray-500 mb-1"
                        >Current Password</label
                    >
                    <div>
                        <input
                            v-model="form.current_password"
                            type="password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                            :class="{ 'border-red-500': v$.current_password.$error }"
                        />
                        <p
                            v-if="v$.current_password.$error"
                            class="mt-1 text-sm text-red-500"
                        >
                            Current Password is required
                        </p>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm text-gray-500 mb-1"
                        >Password</label
                    >
                    <div>
                        <input
                            v-model="form.password"
                            type="password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                            :class="{ 'border-red-500': v$.password.$error }"
                        />
                        <p
                            v-if="v$.password.$error"
                            class="mt-1 text-sm text-red-500"
                        >
                            Password is required
                        </p>
                    </div>
                </div>

                <!-- Password Confirmation -->
                <div>
                    <label class="block text-sm text-gray-500 mb-1"
                        >Password Confirmation</label
                    >
                    <div>
                        <input
                            v-model="form.password_confirmation"
                            type="password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                            :class="{ 'border-red-500': v$.password_confirmation.$error }"
                        />
                        <p
                            v-if="v$.password_confirmation.$error"
                            class="mt-1 text-sm text-red-500"
                        >
                            Password Confirmation is required
                        </p>
                    </div>
                </div>

            </div>
        </div>
</template>
