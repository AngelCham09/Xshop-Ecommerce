<script setup>
import ProfileLayout from "../Layouts/ProfileLayout.vue";

const user = {
    name: "Joseph McFall",
    email: "yourname@example.com",
    avatar: "/placeholder-user.jpg",
    address:
        "Miles Drive, Newark, NJ 07103, California, United States of America",
    phone: "+1234 567 890 / +12 345 678",
    country: "United States of America",
};

import { ref, reactive } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { required, email } from "@vuelidate/validators";
import { useToast } from "primevue/usetoast";

// ... previous imports remain the same

const toast = useToast();
const isEditing = ref(false);
const saving = ref(false);

const editedUser = reactive({
    name: "",
    email: "",
    phone: "",
    address: "",
    country: "",
});

// Validation rules
const rules = {
    name: { required },
    email: { required, email },
    phone: { required },
    address: { required },
    country: { required },
};

const v$ = useVuelidate(rules, editedUser);

// Sample countries data
const countries = [
    { name: "United States" },
    { name: "United Kingdom" },
    { name: "Canada" },
    // Add more countries...
];

const startEdit = () => {
    // Populate form with current user data
    editedUser.name = user.name;
    editedUser.email = user.email;
    editedUser.phone = user.phone;
    editedUser.address = user.address;
    editedUser.country = user.country;
    isEditing.value = true;
};

const cancelEdit = () => {
    isEditing.value = false;
    v$.value.$reset();
};

const saveChanges = async () => {
    const isValid = await v$.value.$validate();

    if (!isValid) {
        toast.add({
            severity: "error",
            summary: "Validation Error",
            detail: "Please check the form for errors",
            life: 3000,
        });
        return;
    }

    try {
        saving.value = true;
        // Make API call to update user data
        await axios.put("/api/user/update", editedUser);

        // Update local user data
        user.email = editedUser.email;
        user.phone = editedUser.phone;
        user.address = editedUser.address;
        user.country = editedUser.country;

        toast.add({
            severity: "success",
            summary: "Success",
            detail: "Account information updated successfully",
            life: 3000,
        });

        isEditing.value = false;
    } catch (error) {
        toast.add({
            severity: "error",
            summary: "Error",
            detail: "Failed to update account information",
            life: 3000,
        });
    } finally {
        saving.value = false;
    }
};
</script>

<template>
    <ProfileLayout>
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
                        :disabled="saving"
                        class="btn-primary"
                    >
                        <span v-if="saving">Saving...</span>
                        <span v-else>Save Changes</span>
                    </button>
                    <button v-else @click="startEdit" class="btn-primary">
                        Edit your data
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
                            v-model="editedUser.name"
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
                            v-model="editedUser.email"
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

                <!-- Phone -->
                <!-- <div>
                    <label class="block text-sm text-gray-500 mb-1"
                        >Phone Number</label
                    >
                    <div v-if="isEditing">
                        <input
                            v-model="editedUser.phone"
                            type="tel"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                            :class="{ 'border-red-500': v$.phone.$error }"
                        />
                        <p
                            v-if="v$.phone.$error"
                            class="mt-1 text-sm text-red-500"
                        >
                            Phone number is required
                        </p>
                    </div>
                    <p v-else class="text-gray-900">{{ user.phone }}</p>
                </div> -->

                <!-- Address -->
                <!-- <div>
                    <label class="block text-sm text-gray-500 mb-1"
                        >Delivery Address</label
                    >
                    <div v-if="isEditing">
                        <textarea
                            v-model="editedUser.address"
                            rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                            :class="{ 'border-red-500': v$.address.$error }"
                        ></textarea>
                        <p
                            v-if="v$.address.$error"
                            class="mt-1 text-sm text-red-500"
                        >
                            Address is required
                        </p>
                    </div>
                    <p v-else class="text-gray-900">{{ user.address }}</p>
                </div> -->

                <!-- Country -->
                <!-- <div>
                    <label class="block text-sm text-gray-500 mb-1"
                        >Country</label
                    >
                    <div v-if="isEditing">
                        <select
                            v-model="editedUser.country"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                            :class="{ 'border-red-500': v$.country.$error }"
                        >
                            <option value="">Select a country</option>
                            <option
                                v-for="country in countries"
                                :key="country.name"
                                :value="country.name"
                            >
                                {{ country.name }}
                            </option>
                        </select>
                        <p
                            v-if="v$.country.$error"
                            class="mt-1 text-sm text-red-500"
                        >
                            Country is required
                        </p>
                    </div>
                    <p v-else class="text-gray-900">{{ user.country }}</p>
                </div> -->
            </div>
        </div>
    </ProfileLayout>
</template>
