<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: "",
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route("profile.destroy"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.clearErrors();
    form.reset();
};
</script>

<template>
    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-gray-900">Delete Account</h2>
        </div>

        <div class="grid gap-6">
            <!-- Current Password -->
            <div>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Once your account is deleted, all of its resources and data
                    will be permanently deleted. Before deleting your account,
                    please download any data or information that you wish to
                    retain.
                </p>

                <div class="mt-8">
                    <button @click="confirmUserDeletion" class="btn-danger">
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>

    <Modal :show="confirmingUserDeletion" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Are you sure you want to delete your account?
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Once your account is deleted, all of its resources and data will
                be permanently deleted. Please enter your password to confirm
                you would like to permanently delete your account.
            </p>

            <div class="mt-6">
                <label class="block text-sm text-gray-500 mb-1">Password</label>
                <div>
                    <input
                        v-model="form.password"
                        type="password"
                        @keyup.enter="deleteUser"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                        :class="{ 'border-red-500': form.errors.password }"
                    />
                    <p
                        v-if="form.errors.password"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.password }}
                    </p>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button @click="closeModal" class="btn-secondary">
                    Cancel
                </button>

                <button
                    @click="deleteUser"
                    :disabled="form.processing"
                    class="btn-primary ms-3"
                    :class="{ 'opacity-25': form.processing }"
                >
                    Delete Account
                </button>
            </div>
        </div>
    </Modal>
</template>
