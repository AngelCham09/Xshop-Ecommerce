<script setup>
import ProfileLayout from "../../Layouts/ProfileLayout.vue";
import { onMounted, ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    addresses: {
        type: Array,
        default: () => [],
    },
});

const countries = ref([]);
const fetchCountries = async () => {
    try {
        const response = await fetch("https://restcountries.com/v3.1/all");
        const data = await response.json();
        countries.value = data
            .map((country) => ({
                name: country.name.common,
                code: country.cca2,
            }))
            .sort((a, b) => a.name.localeCompare(b.name));
    } catch (error) {
        console.error("Failed to fetch countries:", error);
    }
};

const showAddingAddressModal = ref(false);
const showEditingAddressModal = ref(false);
const addressForm = useForm({
    id: null,
    type: "",
    address1: "",
    address2: "",
    city: "",
    state: "",
    postcode: "",
    country: "",
    isMain: false,
});

const addingAddress = () => {
    showAddingAddressModal.value = true;
};

const editingAddress = (address) => {
    addressForm.id = address.id;
    addressForm.type = address.type;
    addressForm.address1 = address.address1;
    addressForm.address2 = address.address2;
    addressForm.city = address.city;
    addressForm.state = address.state;
    addressForm.postcode = address.postcode;
    const matchedCountry = countries.value.find(
        (country) => country.code === address.country_code
    );
    addressForm.country = matchedCountry ? matchedCountry : "";
    addressForm.isMain = address.isMain ? true : false;
    showEditingAddressModal.value = true;
};

const closeModal = () => {
    showAddingAddressModal.value = false;
    showEditingAddressModal.value = false;
    addressForm.clearErrors();
    addressForm.reset();
};

const addAddress = () => {
    addressForm.post(route("address.store"), {
        onSuccess: () => {
            Swal.fire({
                toast: true,
                icon: "success",
                position: "top-end",
                showConfirmButton: false,
                title: "Address added successfully",
            });
            closeModal();
        },
        onError: (errors) => {
            addressForm.errors = errors;
            Swal.fire({
                toast: true,
                icon: "error",
                position: "top-end",
                showConfirmButton: false,
                title: "Failed to add address",
            });
        },
    });
};

const deleteAddress = (id) => {
    router.delete(route("address.delete", id), {
        onSuccess: () => {
            Swal.fire({
                toast: true,
                icon: "success",
                position: "top-end",
                showConfirmButton: false,
                title: "Address deleted successfully",
            });
        },
        onError: (errors) => {
            Swal.fire({
                toast: true,
                icon: "error",
                position: "top-end",
                showConfirmButton: false,
                title: "Failed to delete address:".errors,
            });
        },
    });
};

const editAddress = (id) => {
    addressForm.patch(route("address.update", id), {
        onSuccess: () => {
            Swal.fire({
                toast: true,
                icon: "success",
                position: "top-end",
                showConfirmButton: false,
                title: "Address updated successfully",
            });
            closeModal();
        },
        onError: (errors) => {
            addressForm.errors = errors;
            Swal.fire({
                toast: true,
                icon: "error",
                position: "top-end",
                showConfirmButton: false,
                title: "Failed to update address",
            });
        },
    });
};

onMounted(() => {
    fetchCountries();
});
</script>

<template>
    <ProfileLayout>
        <section
            class="p-6 bg-white rounded-lg shadow-sm border border-gray-100"
        >
            <header class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900">
                    My Addresses
                </h2>
                <button @click="addingAddress()" class="btn-primary">
                    Add Address
                </button>
            </header>

            <div v-if="addresses.length" class="space-y-4">
                <div
                    v-for="address in addresses"
                    :key="address.id"
                    class="p-4 border rounded-lg shadow-sm flex justify-between items-center"
                >
                    <div>
                        <p class="text-sm text-gray-500 flex items-center">
                            {{ address.type }}
                            <span
                                v-if="address.isMain"
                                class="ml-2 text-xs font-semibold text-white bg-green-500 px-2 py-1 rounded-full"
                            >
                                Main
                            </span>
                        </p>
                        <p class="text-gray-900 font-medium">
                            {{ address.address1 }}
                        </p>
                        <p class="text-gray-900 font-medium">
                            {{ address.address2 }}
                        </p>
                        <p class="text-sm text-gray-500">{{ address.city }}</p>
                        <p class="text-sm text-gray-500">{{ address.state }}</p>
                        <p class="text-sm text-gray-500">
                            {{ address.postcode }}
                        </p>
                    </div>
                    <div class="flex space-x-2">
                        <button
                            @click="editingAddress(address)"
                            class="btn-secondary"
                        >
                            Edit
                        </button>
                        <button
                            @click="deleteAddress(address.id)"
                            class="btn-danger"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>

            <div v-else class="text-center text-gray-500">
                <p>No addresses found. Add a new address to get started.</p>
            </div>
        </section>
    </ProfileLayout>

    <Modal :show="showAddingAddressModal || showEditingAddressModal" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Add New Address
            </h2>

            <div class="mt-6">
                <label class="block text-sm text-gray-500 mb-1"
                    >Address Type</label
                >
                <input
                    v-model="addressForm.type"
                    type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                />
                <p class="text-sm text-red-500 mt-1">
                    <span v-if="addressForm.errors.type">
                        {{ addressForm.errors.type }}
                    </span>
                </p>

                <label class="block text-sm text-gray-500 mt-4 mb-1"
                    >Address 1</label
                >
                <input
                    v-model="addressForm.address1"
                    type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                />
                <p class="text-sm text-red-500 mt-1">
                    <span v-if="addressForm.errors.address1">
                        {{ addressForm.errors.address1 }}
                    </span>
                </p>

                <label class="block text-sm text-gray-500 mt-4 mb-1"
                    >Address 2</label
                >
                <input
                    v-model="addressForm.address2"
                    type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                />
                <p class="text-sm text-red-500 mt-1">
                    <span v-if="addressForm.errors.address2">
                        {{ addressForm.errors.address2 }}
                    </span>
                </p>

                <label class="block text-sm text-gray-500 mt-4 mb-1"
                    >City</label
                >
                <input
                    v-model="addressForm.city"
                    type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                />
                <p class="text-sm text-red-500 mt-1">
                    <span v-if="addressForm.errors.city">
                        {{ addressForm.errors.city }}
                    </span>
                </p>

                <label class="block text-sm text-gray-500 mt-4 mb-1"
                    >State</label
                >
                <input
                    v-model="addressForm.state"
                    type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                />
                <p class="text-sm text-red-500 mt-1">
                    <span v-if="addressForm.errors.state">
                        {{ addressForm.errors.state }}
                    </span>
                </p>

                <label class="block text-sm text-gray-500 mt-4 mb-1"
                    >Postcode</label
                >
                <input
                    v-model="addressForm.postcode"
                    type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                />
                <p class="text-sm text-red-500 mt-1">
                    <span v-if="addressForm.errors.postcode">
                        {{ addressForm.errors.postcode }}
                    </span>
                </p>

                <label class="block text-sm text-gray-500 mt-4 mb-1"
                    >Country</label
                >
                <select
                    v-model="addressForm.country"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                >
                    <option value="" disabled>Select a country</option>
                    <option
                        v-for="country in countries"
                        :key="country"
                        :value="country"
                    >
                        {{ country.name }} ({{ country.code }})
                    </option>
                </select>
                <p class="text-sm text-red-500 mt-1">
                    <span v-if="addressForm.errors.country_code">
                        {{ addressForm.errors.country_code }}
                    </span>
                </p>

                <div class="mt-4 flex items-center">
                    <input
                        v-model="addressForm.isMain"
                        type="checkbox"
                        id="isMain"
                        class="mr-2"
                    />
                    <label for="isMain" class="text-sm text-gray-500"
                        >Set as Main Address</label
                    >
                    <p class="text-sm text-red-500 mt-1">
                        <span v-if="addressForm.errors.isMain">
                            {{ addressForm.errors.isMain }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button @click="closeModal" class="btn-secondary">
                    Cancel
                </button>

                <button
                    @click="showAddingAddressModal ? addAddress() : editAddress(addressForm.id)"
                    :disabled="addressForm.processing"
                    class="btn-primary ms-3"
                    :class="{ 'opacity-25': addressForm.processing }"
                >
                    Save Address
                </button>
            </div>
        </div>
    </Modal>
</template>
