<script setup>
import { router } from "@inertiajs/vue3";
defineProps({
    products: Array,
    columns: {
        type: Number,
        default: 4
    }
});

const addToCart = (product) => {
    router.post(route("cart.store", product), {
        onSuccess: (page) => {
            Swal.fire({
                toast: true,
                icon: "success",
                position: "top-end",
                showConfirmButton: false,
                title: page.props.flash.success,
            });
            productModal.value = false;
        },
    });
};
</script>

<template>
    <div
        :class="`mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-${columns} xl:gap-x-8`"
    >
        <div
            v-for="product in products"
            :key="product.id"
            class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800"
        >
            <div class="h-56 w-full">
                <a href="#">
                    <img
                        v-if="product.product_images.length > 0"
                        :src="'/storage/' + product.product_images[0].image"
                        :alt="product.imageAlt"
                        class="h-full w-full object-cover object-center lg:h-full lg:w-full"
                    />
                    <img
                        v-else
                        src="https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ="
                        :alt="product.imageAlt"
                        class="h-full w-full object-cover object-center lg:h-full lg:w-full"
                    />
                </a>
            </div>
            <div class="pt-6">
                <div class="mb-4 flex items-center justify-between gap-4">
                    <span
                        class="me-2 rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300"
                    >

                    </span>

                    <div class="flex items-center justify-end gap-1">
                        <button
                            type="button"
                            data-tooltip-target="tooltip-quick-look"
                            class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >
                            <span class="sr-only"> Quick look </span>
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
                                    stroke-width="2"
                                    d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"
                                />
                                <path
                                    stroke="currentColor"
                                    stroke-width="2"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                />
                            </svg>
                        </button>
                        <div
                            id="tooltip-quick-look"
                            role="tooltip"
                            class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                            data-popper-placement="top"
                        >
                            Quick look
                            <div
                                class="tooltip-arrow"
                                data-popper-arrow=""
                            ></div>
                        </div>

                        <button
                            type="button"
                            data-tooltip-target="tooltip-add-to-favorites"
                            class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >
                            <span class="sr-only"> Add to Favorites </span>
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
                                    d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"
                                />
                            </svg>
                        </button>
                        <div
                            id="tooltip-add-to-favorites"
                            role="tooltip"
                            class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                            data-popper-placement="top"
                        >
                            Add to favorites
                            <div
                                class="tooltip-arrow"
                                data-popper-arrow=""
                            ></div>
                        </div>
                    </div>
                </div>

                <a
                    href="#"
                    class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white"
                    >{{ product.title }}</a
                >

                <!-- <div class="mt-2 flex items-center gap-2">
                    <div class="flex items-center">
                        <svg
                            class="h-4 w-4 text-yellow-400"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"
                            />
                        </svg>

                        <svg
                            class="h-4 w-4 text-yellow-400"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"
                            />
                        </svg>

                        <svg
                            class="h-4 w-4 text-yellow-400"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"
                            />
                        </svg>

                        <svg
                            class="h-4 w-4 text-yellow-400"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"
                            />
                        </svg>

                        <svg
                            class="h-4 w-4 text-yellow-400"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"
                            />
                        </svg>
                    </div>

                    <p
                        class="text-sm font-medium text-gray-900 dark:text-white"
                    >
                        5.0
                    </p>
                    <p
                        class="text-sm font-medium text-gray-500 dark:text-gray-400"
                    >
                        (455)
                    </p>
                </div> -->

                <!-- <ul class="mt-2 flex items-center gap-4">
                    <li class="flex items-center gap-2">
                        <svg
                            class="h-4 w-4 text-gray-500 dark:text-gray-400"
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
                                d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"
                            />
                        </svg>
                        <p
                            class="text-sm font-medium text-gray-500 dark:text-gray-400"
                        >
                            Fast Delivery
                        </p>
                    </li>

                    <li class="flex items-center gap-2">
                        <svg
                            class="h-4 w-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-width="2"
                                d="M8 7V6c0-.6.4-1 1-1h11c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1h-1M3 18v-7c0-.6.4-1 1-1h11c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"
                            />
                        </svg>
                        <p
                            class="text-sm font-medium text-gray-500 dark:text-gray-400"
                        >
                            Best Price
                        </p>
                    </li>
                </ul> -->

                <div class="mt-4 flex flex-col items-start justify-between gap-4">
                    <p
                        class="text-2xl font-extrabold leading-tight text-gray-900 dark:text-white"
                    >
                        ${{ product.price }}
                    </p>

                    <button
                        @click="addToCart(product)"
                        type="button"
                        class="inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium btn-primary"
                    >
                        <svg
                            class="-ms-2 me-2 h-5 w-5"
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
                                d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"
                            />
                        </svg>
                        Add to cart
                    </button>
                </div>
            </div>
        </div>
        <!-- <div
            v-for="product in products"
            :key="product.id"
            class="group relative"
        >
            <div
                class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80"
            >
                <img
                    v-if="product.product_images.length > 0"
                    :src="'/storage/' + product.product_images[0].image"
                    :alt="product.imageAlt"
                    class="h-full w-full object-cover object-center lg:h-full lg:w-full"
                />
                <img
                    v-else
                    src="https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ="
                    :alt="product.imageAlt"
                    class="h-full w-full object-cover object-center lg:h-full lg:w-full"
                />

                <div
                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 cursor-pointer"
                >
                    <div
                        class="bg-blue-700 p-2 rounded-full flex items-center justify-center"
                    >
                        <a href="#" @click="addToCart(product)">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
                                />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-4 flex justify-between">
                <div>
                    <h3 class="text-sm text-gray-700">
                        <span aria-hidden="true" class="inset-0" />
                        {{ product.title }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ product.brand.name }}
                    </p>
                </div>
                <p class="text-sm font-medium text-gray-900">
                    {{ product.price }}
                </p>
            </div>
        </div> -->
    </div>
</template>
