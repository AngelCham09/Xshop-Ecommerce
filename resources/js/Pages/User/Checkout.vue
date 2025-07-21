<script setup>
import UserLayouts from "./Layouts/UserLayout.vue";
import { useForm, usePage, router } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import { ref, onMounted, computed } from "vue";

const props = defineProps({
    addresses: {
        type: Object,
    },
    deliveryMethods: {
        type: Object,
    },
})

const carts = computed(() => usePage().props.cart.data.items);
const products = computed(() => usePage().props.cart.data.products);
const total = computed(() => usePage().props.cart.data.total);
const deliveryFees = computed(() => checkoutForm.deliveryMethod ? props.deliveryMethods.find(method => method.id === checkoutForm.deliveryMethod).price : 0);
const totalPrice = computed(() => {
    return parseFloat(total.value) + parseFloat(deliveryFees.value);
});

const countries = ref([]);
const fetchCountries = async () => {
    try {
        const response = await fetch("https://restcountries.com/v3.1/all?fields=name,cca2");
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

const checkoutForm = useForm({
    address: props.addresses.find((address) => address.isMain)?.id || "",
    deliveryMethod: props.deliveryMethods[0]?.id || "",
});

const showAddingAddressModal = ref(false);
const addressForm = useForm({
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

const closeModal = () => {
    showAddingAddressModal.value = false;
    addressForm.clearErrors();
    addressForm.reset();
};


const submit = () => {
    router.visit(route("checkout.store"), {
        method: "post",
        data: {
            carts: carts.value,
            products: products.value,
            total: total.value,
            address: checkoutForm.address,
            deliveryMethod: checkoutForm.deliveryMethod,
        },
    });
};

onMounted(() => {
    fetchCountries();
});
</script>

<template>
    <UserLayouts>
        <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
            <form action="#" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Checkout
                </h2>
                <div
                    class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16"
                >
                    <div class="min-w-0 flex-1 space-y-8 mb-16">
                        <div class="space-y-4">
                            <h2
                                class="text-xl font-semibold text-gray-900 dark:text-white"
                            >
                                Delivery Details
                            </h2>
                            <!-- Add this section -->
                            <div class="space-y-4">
                                <label
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                >
                                    Addresses
                                </label>
                                <select
                                    v-model="checkoutForm.address"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                >
                                    <option value="" disabled>
                                        Select a saved address
                                    </option>
                                    <option v-for="address in addresses" :key="address.id" :value="address.id">
                                        {{ address.address1 }} {{ address.address2 }} {{ address.city }} {{ address.state }} {{ address.zip_code }}
                                    </option>

                                </select>
                            </div>
                            <!-- End of new section -->

                            <div>
                                <button
                                        @click="addingAddress()"
                                        class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                                    >
                                        <svg
                                            class="h-5 w-5"
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke="currentColor"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 12h14m-7 7V5"
                                            />
                                        </svg>
                                        Add new address
                                    </button>
                            </div>
                        </div>

                        <!-- <div class="space-y-4">
                        <h3
                            class="text-xl font-semibold text-gray-900 dark:text-white"
                        >
                            Payment
                        </h3>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div
                                class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800"
                            >
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input
                                            id="credit-card"
                                            aria-describedby="credit-card-text"
                                            type="radio"
                                            name="payment-method"
                                            value=""
                                            class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                            checked
                                        />
                                    </div>

                                    <div class="ms-4 text-sm">
                                        <label
                                            for="credit-card"
                                            class="font-medium leading-none text-gray-900 dark:text-white"
                                        >
                                            Credit Card
                                        </label>
                                        <p
                                            id="credit-card-text"
                                            class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400"
                                        >
                                            Pay with your credit card
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center gap-2">
                                    <button
                                        type="button"
                                        class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                                    >
                                        Delete
                                    </button>

                                    <div
                                        class="h-3 w-px shrink-0 bg-gray-200 dark:bg-gray-700"
                                    ></div>

                                    <button
                                        type="button"
                                        class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                                    >
                                        Edit
                                    </button>
                                </div>
                            </div>

                            <div
                                class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800"
                            >
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input
                                            id="pay-on-delivery"
                                            aria-describedby="pay-on-delivery-text"
                                            type="radio"
                                            name="payment-method"
                                            value=""
                                            class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                        />
                                    </div>

                                    <div class="ms-4 text-sm">
                                        <label
                                            for="pay-on-delivery"
                                            class="font-medium leading-none text-gray-900 dark:text-white"
                                        >
                                            Payment on delivery
                                        </label>
                                        <p
                                            id="pay-on-delivery-text"
                                            class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400"
                                        >
                                            +$15 payment processing fee
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center gap-2">
                                    <button
                                        type="button"
                                        class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                                    >
                                        Delete
                                    </button>

                                    <div
                                        class="h-3 w-px shrink-0 bg-gray-200 dark:bg-gray-700"
                                    ></div>

                                    <button
                                        type="button"
                                        class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                                    >
                                        Edit
                                    </button>
                                </div>
                            </div>

                            <div
                                class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800"
                            >
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input
                                            id="paypal-2"
                                            aria-describedby="paypal-text"
                                            type="radio"
                                            name="payment-method"
                                            value=""
                                            class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                        />
                                    </div>

                                    <div class="ms-4 text-sm">
                                        <label
                                            for="paypal-2"
                                            class="font-medium leading-none text-gray-900 dark:text-white"
                                        >
                                            Paypal account
                                        </label>
                                        <p
                                            id="paypal-text"
                                            class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400"
                                        >
                                            Connect to your account
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center gap-2">
                                    <button
                                        type="button"
                                        class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                                    >
                                        Delete
                                    </button>

                                    <div
                                        class="h-3 w-px shrink-0 bg-gray-200 dark:bg-gray-700"
                                    ></div>

                                    <button
                                        type="button"
                                        class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                                    >
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div> -->

                        <div class="space-y-4">
                            <h3
                                class="text-xl font-semibold text-gray-900 dark:text-white"
                            >
                                Delivery Methods
                            </h3>

                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                <div
                                    v-for="method in deliveryMethods" :key="method.id"
                                    class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800"
                                >
                                    <div class="flex items-start" >
                                        <div class="flex h-5 items-center">
                                            <input
                                                v-model="checkoutForm.deliveryMethod"
                                                id="dhl"
                                                aria-describedby="dhl-text"
                                                type="radio"
                                                name="delivery-method"
                                                :value="method.id"
                                                class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                :checked="method.id === checkoutForm.deliveryMethod"
                                            />
                                        </div>

                                        <div class="ms-4 text-sm">
                                            <label
                                                for="dhl"
                                                class="font-medium leading-none text-gray-900 dark:text-white"
                                            >
                                                ${{ method.price }} - {{ method.name }}
                                            </label>
                                            <p
                                                id="dhl-text"
                                                class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400"
                                            >
                                                {{ method.estimate_days_text }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div>
                            <label
                                for="voucher"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                            >
                                Enter a gift card, voucher or promotional code
                            </label>
                            <div class="flex max-w-md items-center gap-4">
                                <input
                                    type="text"
                                    id="voucher"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                    placeholder=""
                                    required
                                />
                                <button
                                    type="button"
                                    class="flex items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium btn-primary"
                                >
                                    Apply
                                </button>
                            </div>
                        </div> -->
                    </div>

                    <div
                        class="rounded-lg border border-gray-200 p-4 sm:p-6 mt-6 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md"
                    >
                        <p
                            class="text-xl font-semibold text-gray-900 dark:text-white"
                        >
                            Order summary
                        </p>

                        <div class="space-y-4">
                            <div class="space-y-2">
                                <dl
                                    class="flex items-center justify-between gap-4"
                                >
                                    <dt
                                        class="text-base font-normal text-gray-500 dark:text-gray-400"
                                    >
                                        Original price
                                    </dt>
                                    <dd
                                        class="text-base font-medium text-gray-900 dark:text-white"
                                    >
                                        ${{ total }}
                                    </dd>
                                </dl>

                                <dl
                                    class="flex items-center justify-between gap-4"
                                >
                                    <dt
                                        class="text-base font-normal text-gray-500 dark:text-gray-400"
                                    >
                                        Delivery Fees
                                    </dt>
                                    <dd
                                        class="text-base font-medium text-green-600"
                                    >
                                        ${{ deliveryFees }}
                                    </dd>
                                </dl>

                            </div>

                            <dl
                                class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700"
                            >
                                <dt
                                    class="text-base font-bold text-gray-900 dark:text-white"
                                >
                                    Total
                                </dt>
                                <dd
                                    class="text-base font-bold text-gray-900 dark:text-white"
                                >
                                    ${{ totalPrice }}
                                </dd>
                            </dl>
                        </div>

                        <button
                            @click="submit"
                            type="button"
                            class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium btn-primary"
                            >Proceed to Payment</button
                        >
                    </div>
                </div>
            </form>
        </section>
    </UserLayouts>



    <Modal :show="showAddingAddressModal" @close="closeModal">
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
                    @click="addAddress()"
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
