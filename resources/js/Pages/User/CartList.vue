<template>
    <UserLayouts>
        <section class="text-gray-600 body-font relative">
            <div
                class="container px-5 py-24 mx-auto flex sm:flex-nowrap flex-wrap"
            >
                <div class="lg:w-2/3 md:w-1/2rounded-lg sm:mr-10">
                    <!--cart list-->

                    <table
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                        >
                            <tr>
                                <th scope="col" class="px-16 py-3">
                                    <span class="sr-only">Image</span>
                                </th>
                                <th scope="col" class="px-6 py-3">Product</th>
                                <th scope="col" class="px-6 py-3">Qty</th>
                                <th scope="col" class="px-6 py-3">Price</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="product in products"
                                :key="product.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                            >
                                <td class="p-4">
                                    <img
                                        v-if="product.product_images.length > 0"
                                        :src="`/storage/${product.product_images[0].image}`"
                                        class="w-16 md:w-32 max-w-full max-h-full"
                                        alt="Apple Watch"
                                    />
                                    <img
                                        v-else
                                        src="https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ="
                                        class="w-16 md:w-32 max-w-full max-h-full"
                                        alt="Apple Watch"
                                    />
                                </td>
                                <td
                                    class="px-6 py-4 font-semibold text-gray-900 dark:text-white"
                                >
                                    {{ product.title }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <button
                                            @click.prevent="
                                                update(
                                                    product,
                                                    carts[itemId(product.id)]
                                                        .quantity - 1
                                                )
                                            "
                                            :class="[
                                                carts[itemId(product.id)]
                                                    .quantity > 1
                                                    ? 'cursor-pointer text-purple-600'
                                                    : 'cursor-not-allowed text-gray-300 dark:text-gray-500',
                                                'inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700',
                                            ]"
                                            :disabled="
                                                carts[itemId(product.id)]
                                                    .quantity <= 1
                                            "
                                            type="button"
                                        >
                                            <span class="sr-only"
                                                >Quantity button</span
                                            >
                                            <svg
                                                class="w-3 h-3"
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 18 2"
                                            >
                                                <path
                                                    stroke="currentColor"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M1 1h16"
                                                />
                                            </svg>
                                        </button>
                                        <div>
                                            <input
                                                v-model="
                                                    carts[itemId(product.id)]
                                                        .quantity
                                                "
                                                type="number"
                                                id="first_product"
                                                class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="1"
                                                required
                                            />
                                        </div>
                                        <button
                                            @click.prevent="
                                                update(
                                                    product,
                                                    carts[itemId(product.id)]
                                                        .quantity + 1
                                                )
                                            "
                                            class="inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                            type="button"
                                        >
                                            <span class="sr-only"
                                                >Quantity button</span
                                            >
                                            <svg
                                                class="w-3 h-3"
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 18 18"
                                            >
                                                <path
                                                    stroke="currentColor"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 1v16M1 9h16"
                                                />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                                <td
                                    class="px-6 py-4 font-semibold text-gray-900 dark:text-white"
                                >
                                    ${{ product.price }}
                                </td>
                                <td class="px-6 py-4">
                                    <a
                                        @click="remove(product)"
                                        class="cursor-pointer font-medium text-red-600 dark:text-red-500"
                                        >Remove</a
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full"
                >
                    <div
                        class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6"
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
                                        $7,592.00
                                    </dd>
                                </dl>

                                <dl
                                    class="flex items-center justify-between gap-4"
                                >
                                    <dt
                                        class="text-base font-normal text-gray-500 dark:text-gray-400"
                                    >
                                        Savings
                                    </dt>
                                    <dd
                                        class="text-base font-medium text-green-600"
                                    >
                                        -$299.00
                                    </dd>
                                </dl>

                                <dl
                                    class="flex items-center justify-between gap-4"
                                >
                                    <dt
                                        class="text-base font-normal text-gray-500 dark:text-gray-400"
                                    >
                                        Store Pickup
                                    </dt>
                                    <dd
                                        class="text-base font-medium text-gray-900 dark:text-white"
                                    >
                                        $99
                                    </dd>
                                </dl>

                                <dl
                                    class="flex items-center justify-between gap-4"
                                >
                                    <dt
                                        class="text-base font-normal text-gray-500 dark:text-gray-400"
                                    >
                                        Tax
                                    </dt>
                                    <dd
                                        class="text-base font-medium text-gray-900 dark:text-white"
                                    >
                                        $799
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
                                    $8,191.00
                                </dd>
                            </dl>
                        </div>

                        <Link
                            :href="route('checkout.view')"
                            class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium btn-primary"
                            >Proceed to Checkout</Link
                        >

                        <div class="flex items-center justify-center gap-2">
                            <span
                                class="text-sm font-normal text-gray-500 dark:text-gray-400"
                            >
                                or
                            </span>
                            <Link
                                :href="route('products.index')"
                                title=""
                                class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500"
                            >
                                Continue Shopping
                                <svg
                                    class="h-5 w-5"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 12H5m14 0-4 4m4-4-4-4"
                                    />
                                </svg>
                            </Link>
                        </div>
                    </div>

                    <!-- <div
                        class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6"
                    >
                        <form class="space-y-4">
                            <div>
                                <label
                                    for="voucher"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                >
                                    Do you have a voucher or gift card?
                                </label>
                                <input
                                    type="text"
                                    id="voucher"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                    placeholder=""
                                    required
                                />
                            </div>
                            <button
                                type="submit"
                                class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium btn-primary"
                            >
                                Apply Code
                            </button>
                        </form>
                    </div> -->
                </div>

                <!-- <div
                    class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0"
                >
                    <h2
                        class="text-gray-900 text-lg mb-1 font-medium title-font"
                    >
                        Summary
                    </h2>
                    <p class="leading-relaxed mb-5 text-gray-600">
                        Total : $ {{ total }}
                    </p>
                    <div v-if="userAddress">
                        <h2
                            class="text-gray-900 text-lg mb-1 font-medium title-font"
                        >
                            Shipping Address
                        </h2>
                        <p class="leading-relaxed mb-5 text-gray-600">
                            {{ userAddress.address1 }}
                        </p>
                        <p class="leading-relaxed mb-5 text-gray-600">
                            or you can add new below
                        </p>
                    </div>
                    <div v-else>
                        <p class="leading-relaxed mb-5 text-gray-600">
                            Add shipping address to continue
                        </p>
                    </div>

                    <form @submit.prevent="submit">
                        <div class="relative mb-4">
                            <label
                                for="address"
                                class="leading-7 text-sm text-gray-600"
                                >Address</label
                            >
                            <input
                                v-model="form.address"
                                type="text"
                                id="address"
                                name="address"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                        <div class="relative mb-4">
                            <label
                                for="city"
                                class="leading-7 text-sm text-gray-600"
                                >City</label
                            >
                            <input
                                v-model="form.city"
                                type="text"
                                id="city"
                                name="city"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>

                        <div class="relative mb-4">
                            <label
                                for="state"
                                class="leading-7 text-sm text-gray-600"
                                >State</label
                            >
                            <input
                                v-model="form.state"
                                type="text"
                                id="state"
                                name="state"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                        <div class="relative mb-4">
                            <label
                                for="postcode"
                                class="leading-7 text-sm text-gray-600"
                                >Postcode</label
                            >
                            <input
                                v-model="form.postcode"
                                type="text"
                                id="postcode"
                                name="postcode"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                        <div class="relative mb-4">
                            <label
                                for="country"
                                class="leading-7 text-sm text-gray-600"
                                >Country Code</label
                            >
                            <input
                                v-model="form.country"
                                type="text"
                                id="country"
                                name="country"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                        <div class="relative mb-4">
                            <label
                                for="type"
                                class="leading-7 text-sm text-gray-600"
                                >Address Type</label
                            >
                            <input
                                v-model="form.type"
                                type="text"
                                id="type"
                                name="type"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>

                        <button
                            v-if="formfilled || userAddress"
                            type="submit"
                            class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                        >
                            Checkout
                        </button>
                        <button
                            v-else
                            type="submit"
                            class="text-white bg-gray-500 border-0 py-2 px-6 focus:outline-none hover:bg-gray-600 rounded text-lg"
                        >
                            Add address to continue
                        </button>
                    </form>
                    <p class="text-xs text-gray-500 mt-3">Continue Shopping</p>
                </div> -->
            </div>
        </section>
    </UserLayouts>
</template>
<script setup>
import { computed, reactive } from "vue";
import UserLayouts from "./Layouts/UserLayouts.vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import OrderSummary from "./Components/OrderSummary.vue";

defineProps({
    userAddress: Object,
});

const carts = computed(() => usePage().props.cart.data.items);
const products = computed(() => usePage().props.cart.data.products);
const total = computed(() => usePage().props.cart.data.total);
const itemId = (id) => carts.value.findIndex((item) => item.product_id === id);

const form = reactive({
    address: "",
    city: "",
    state: "",
    postcode: "",
    country: "",
    type: "",
});

const formfilled = computed(() => {
    return (
        form.address.length > 0 &&
        form.city.length > 0 &&
        form.state.length > 0 &&
        form.country.length > 0 &&
        form.postcode.length > 0 &&
        form.type.length > 0
    );
});

const update = (product, quantity) => {
    router.patch(route("cart.update", product), {
        quantity,
    });
};

const remove = (product) => {
    router.delete(route("cart.delete", product));
};

const submit = () => {
    router.visit(route("checkout.store"), {
        method: "post",
        data: {
            carts: carts.value,
            products: products.value,
            total: total.value,
            address: form,
        },
    });
};
</script>
