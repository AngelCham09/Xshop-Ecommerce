<script setup>
import ProfileLayout from "../../Layouts/ProfileLayout.vue";
import { onMounted, ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    orders: {
        type: Object,
    },
});
</script>

<template>
    <ProfileLayout>
        <section
            class="p-6 bg-white rounded-lg shadow-sm border border-gray-100"
        >
            <header class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900">My Orders</h2>
            </header>

            <div
                class="flex sm:flex-col lg:flex-row sm:items-center justify-between"
            >
                <ul
                    class="flex max-sm:flex-col sm:items-center gap-x-14 gap-y-3"
                >
                    <li
                        class="font-medium text-lg leading-8 cursor-pointer text-indigo-600 transition-all duration-500 hover:text-indigo-600"
                    >
                        All Order
                    </li>
                    <li
                        class="font-medium text-lg leading-8 cursor-pointer text-black transition-all duration-500 hover:text-indigo-600"
                    >
                        Summary
                    </li>
                    <li
                        class="font-medium text-lg leading-8 cursor-pointer text-black transition-all duration-500 hover:text-indigo-600"
                    >
                        Completed
                    </li>
                    <li
                        class="font-medium text-lg leading-8 cursor-pointer text-black transition-all duration-500 hover:text-indigo-600"
                    >
                        Cancelled
                    </li>
                </ul>
                <div
                    class="flex max-sm:flex-col items-center justify-end gap-2 max-lg:mt-5"
                >
                    <div
                        class="flex rounded-full py-3 px-4 border border-gray-300 relative"
                    >
                        <svg
                            class="relative"
                            width="18"
                            height="20"
                            viewBox="0 0 18 20"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M1.5 7.75H16.5M11.9213 11.875H11.928M11.9212 14.125H11.9279M9.14676 11.875H9.1535M9.14676 14.125H9.1535M6.37088 11.875H6.37762M6.37088 14.125H6.37762M5.25 4.75V1.75M12.75 4.75V1.75M7.5 18.25H10.5C13.3284 18.25 14.7426 18.25 15.6213 17.3713C16.5 16.4926 16.5 15.0784 16.5 12.25V9.25C16.5 6.42157 16.5 5.00736 15.6213 4.12868C14.7426 3.25 13.3284 3.25 10.5 3.25H7.5C4.67157 3.25 3.25736 3.25 2.37868 4.12868C1.5 5.00736 1.5 6.42157 1.5 9.25V12.25C1.5 15.0784 1.5 16.4926 2.37868 17.3713C3.25736 18.25 4.67157 18.25 7.5 18.25Z"
                                stroke="#111827"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        <input
                            type="text"
                            name="from-dt"
                            id="from-dt"
                            class="font-semibold px-2 text-sm text-gray-900 outline-0 appearance-none flex flex-row-reverse cursor-pointer w-28 placeholder-gray-900"
                            placeholder="11-01-2023"
                        />
                    </div>
                    <p class="font-medium text-lg leading-8 text-black">To</p>
                    <div
                        class="flex rounded-full py-3 px-4 border border-gray-300 relative"
                    >
                        <svg
                            class="relative"
                            width="18"
                            height="20"
                            viewBox="0 0 18 20"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M1.5 7.75H16.5M11.9213 11.875H11.928M11.9212 14.125H11.9279M9.14676 11.875H9.1535M9.14676 14.125H9.1535M6.37088 11.875H6.37762M6.37088 14.125H6.37762M5.25 4.75V1.75M12.75 4.75V1.75M7.5 18.25H10.5C13.3284 18.25 14.7426 18.25 15.6213 17.3713C16.5 16.4926 16.5 15.0784 16.5 12.25V9.25C16.5 6.42157 16.5 5.00736 15.6213 4.12868C14.7426 3.25 13.3284 3.25 10.5 3.25H7.5C4.67157 3.25 3.25736 3.25 2.37868 4.12868C1.5 5.00736 1.5 6.42157 1.5 9.25V12.25C1.5 15.0784 1.5 16.4926 2.37868 17.3713C3.25736 18.25 4.67157 18.25 7.5 18.25Z"
                                stroke="#111827"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        <input
                            type="text"
                            name="to-dt"
                            id="to-dt"
                            class="font-semibold px-2 text-sm text-gray-900 outline-0 appearance-none flex flex-row-reverse cursor-pointer w-28 placeholder-gray-900"
                            placeholder="11-01-2023"
                        />
                    </div>
                </div>
            </div>
            <div
                v-for="order in orders.data"
                :key="order.id"
                class="mt-7 border border-gray-300 pt-9"
            >
                <div
                    class="flex max-md:flex-col items-center justify-between px-3 md:px-11"
                >
                    <div class="data">
                        <p
                            class="font-medium text-lg leading-8 text-black whitespace-nowrap"
                        >
                            Order : #{{ order.id }}
                        </p>
                        <p
                            class="font-medium text-lg leading-8 text-black mt-3 whitespace-nowrap"
                        >
                            Order Payment : {{ order.created_at }}
                        </p>
                    </div>
                    <div class="flex items-center gap-3 max-md:mt-5">
                        <button
                            v-if="order.status === 'PAID'"
                            class="btn-secondary"
                        >
                            Show Invoice
                        </button>
                        <button class="btn-primary">Buy Now</button>
                    </div>
                </div>
                <svg
                    class="my-9 w-full"
                    xmlns="http://www.w3.org/2000/svg"
                    width="1216"
                    height="2"
                    viewBox="0 0 1216 2"
                    fill="none"
                >
                    <path d="M0 1H1216" stroke="#D1D5DB" />
                </svg>

                <div
                    v-for="item in order.order_items"
                    :key="item.id"
                    class="flex max-lg:flex-col items-center gap-8 lg:gap-24 px-3 md:px-11"
                >
                    <div class="grid grid-cols-4 w-full">
                        <div class="col-span-4 sm:col-span-1">
                            <img
                                v-if="item.product.product_images.length > 0"
                                :src="`/storage/${item.product.product_images[0].image}`"
                                alt=""
                                class="max-sm:mx-auto object-cover"
                            />
                            <img
                                v-else
                                src="https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ="
                                alt=""
                                class="max-sm:mx-auto object-cover"
                            />
                        </div>
                        <div
                            class="col-span-4 sm:col-span-3 max-sm:mt-4 sm:pl-8 flex flex-col justify-center max-sm:items-center"
                        >
                            <h6
                                class="font-manrope font-semibold text-2xl leading-9 text-black mb-3 whitespace-nowrap"
                            >
                                {{ item.product.title }}
                            </h6>
                            <!-- <p
                                class="font-normal text-lg leading-8 text-gray-500 mb-8 whitespace-nowrap"
                            >
                                {{ item.product.description }}
                            </p> -->
                            <div
                                class="flex items-center max-sm:flex-col gap-x-10 gap-y-3"
                            >
                                <!-- <span
                                    class="font-normal text-lg leading-8 text-gray-500 whitespace-nowrap"
                                    >Size: s</span
                                > -->
                                <span
                                    class="font-normal text-lg leading-8 text-gray-500 whitespace-nowrap"
                                    >Qty: {{ item.quantity }}</span
                                >
                                <p
                                    class="font-semibold text-xl leading-8 text-black whitespace-nowrap"
                                >
                                    Price ${{ item.unit_price }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-around w-full sm:pl-28 lg:pl-0"
                    >
                        <div
                            class="flex flex-col justify-center items-start max-sm:items-center"
                        >
                            <p
                                class="font-normal text-lg text-gray-500 leading-8 mb-2 text-left whitespace-nowrap"
                            >
                                Status
                            </p>
                            <p
                                class="font-semibold text-lg leading-8 text-left whitespace-nowrap"
                                :class="
                                    order.status === 'PAID'
                                        ? 'text-green-500'
                                        : 'text-red-500'
                                "
                            >
                                {{ order.status }}
                            </p>
                        </div>
                        <div
                            class="flex flex-col justify-center items-start max-sm:items-center"
                        >
                            <p
                                class="font-normal text-lg text-gray-500 leading-8 mb-2 text-left whitespace-nowrap"
                            >
                                Delivery Expected by
                            </p>
                            <p
                                class="font-semibold text-lg leading-8 text-black text-left whitespace-nowrap"
                            >
                                -
                            </p>
                        </div>
                    </div>
                </div>

                <svg
                    class="my-9 w-full"
                    xmlns="http://www.w3.org/2000/svg"
                    width="1216"
                    height="2"
                    viewBox="0 0 1216 2"
                    fill="none"
                >
                    <path d="M0 1H1216" stroke="#D1D5DB" />
                </svg>
                <div
                    class="px-3 md:px-11 flex items-center justify-between max-sm:flex-col-reverse"
                >
                    <div
                        v-if="order.status == 'PAID'"
                        class="flex max-sm:flex-col-reverse items-center"
                    >
                        <button
                            class="flex items-center gap-3 py-10 pr-8 sm:border-r border-gray-300 font-normal text-xl leading-8 text-gray-500 group transition-all duration-500 hover:text-indigo-600"
                        >
                            <svg
                                width="40"
                                height="41"
                                viewBox="0 0 40 41"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    class="stroke-gray-600 transition-all duration-500 group-hover:stroke-indigo-600"
                                    d="M14.0261 14.7259L25.5755 26.2753M14.0261 26.2753L25.5755 14.7259"
                                    stroke=""
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            cancel order
                        </button>
                        <p
                            class="font-normal text-xl leading-8 text-gray-500 sm:pl-8"
                        >
                            Payment Is Succesfull
                        </p>
                    </div>
                    <div
                        v-else
                        class="flex max-sm:flex-col-reverse items-center"
                    >
                        <!-- <button
                            class="flex items-center gap-3 py-10 pr-8 sm:border-r border-gray-300 font-normal text-xl leading-8 text-gray-500 group transition-all duration-500 hover:text-indigo-600"
                        >
                            <svg
                                width="40"
                                height="41"
                                viewBox="0 0 40 41"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    class="stroke-gray-600 transition-all duration-500 group-hover:stroke-indigo-600"
                                    d="M14.0261 14.7259L25.5755 26.2753M14.0261 26.2753L25.5755 14.7259"
                                    stroke=""
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            cancel order
                        </button> -->
                        <p
                            class="flex items-center gap-3 py-10 pr-8 font-normal text-xl leading-8 text-gray-500"
                        >
                            Payment Is Not Succesfull
                        </p>
                    </div>
                    <p
                        class="font-medium text-xl leading-8 text-black max-sm:py-4"
                    >
                        <span class="text-gray-500">Total Price: </span>
                        &nbsp;${{ order.total_price }}
                    </p>
                </div>
            </div>
        </section>
    </ProfileLayout>
</template>
