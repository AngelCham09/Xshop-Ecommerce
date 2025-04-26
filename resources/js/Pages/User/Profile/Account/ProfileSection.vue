<script setup>
import { ref } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { required, email } from "@vuelidate/validators";
import { useForm, usePage } from "@inertiajs/vue3";

const auth = usePage().props.auth;
const user = {
    name: auth.user.name,
    email: auth.user.email,
};

const isEditing = ref(false);
const saving = ref(false);

// Initialize form with user data
const form = useForm({
    name: user.name,
    email: user.email,
});

// Validation rules
const rules = {
    name: { required },
    email: { required, email },
};

const v$ = useVuelidate(rules, form);

const startEdit = () => {
    isEditing.value = true;
};

const cancelEdit = () => {
    // Reset form to original values
    form.name = user.name;
    form.email = user.email;

    isEditing.value = false;
    v$.value.$reset();
};

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
        await form.patch(route("profile.update"), {
            preserveScroll: true,
            onSuccess: () => {
                // Show success toast
                Swal.fire({
                    toast: true,
                    icon: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    title: "Profile updated successfully",
                });

                isEditing.value = false;
                // Update local user data with new values
                user.name = form.name;
                user.email = form.email;
            },
            onError: (errors) => {
                let errorMessage = "Failed to update account.";
                if (errors.message) {
                    errorMessage = errors.message;
                } else if (errors.email) {
                    errorMessage = errors.email;
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
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900">
                    Account data
                </h2>
                <div class="space-x-2">
                    <button
                        v-if="isEditing"
                        @click="cancelEdit"
                        class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg"
                    >
                        Cancel
                    </button>
                    <button
                        v-if="isEditing"
                        @click="saveChanges"
                        :disabled="saving || form.processing"
                        class="btn-primary"
                    >
                        <span v-if="saving">Saving...</span>
                        <span v-else>Save Changes</span>
                    </button>
                    <button v-else @click="startEdit" class="btn-primary">
                        Edit
                    </button>
                </div>
            </div>

            <div class="grid gap-6">
                <!-- Account Name -->
                <div>
                    <label class="block text-sm text-gray-500 mb-1"
                        >Username</label
                    >
                    <div v-if="isEditing">
                        <input
                            v-model="form.name"
                            type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                            :class="{ 'border-red-500': v$.name.$error }"
                        />
                        <p
                            v-if="v$.name.$error"
                            class="mt-1 text-sm text-red-500"
                        >
                            Username is required
                        </p>
                    </div>
                    <p v-else class="text-gray-900">{{ user.name }}</p>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm text-gray-500 mb-1"
                        >Email Address</label
                    >
                    <div v-if="isEditing">
                        <input
                            v-model="form.email"
                            type="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                            :class="{ 'border-red-500': v$.email.$error }"
                        />
                        <p
                            v-if="v$.email.$error"
                            class="mt-1 text-sm text-red-500"
                        >
                            Please enter a valid email address
                        </p>
                    </div>
                    <p v-else class="text-gray-900">{{ user.email }}</p>
                </div>

            </div>
        </div>
</template>
