<template>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div
                class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden"
            >
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4"
                >
                    <div class="w-full md:w-1/2">
                        <form
                            @submit.prevent="applyFilters"
                            class="flex items-center"
                        >
                            <label for="simple-search" class="sr-only"
                                >Search</label
                            >
                            <div class="relative w-full">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                                >
                                    <svg
                                        aria-hidden="true"
                                        class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor"
                                        viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    v-model="filters.search"
                                    id="simple-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Search product name"
                                />
                            </div>
                        </form>
                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0"
                    >
                        <button
                            type="button"
                            @click="openProductModal(true)"
                            class="flex items-center gap-2 justify-center btn-primary"
                        >
                            <Icon icon="lucide:plus" width="16" height="16" />
                            <span class="font-semibold">Add Product</span>
                        </button>
                        <div
                            class="flex items-center space-x-3 w-full md:w-auto"
                        >
                            <button
                                id="actionsDropdownButton"
                                data-dropdown-toggle="actionsDropdown"
                                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                type="button"
                            >
                                <svg
                                    class="-ml-1 mr-1.5 w-5 h-5"
                                    fill="currentColor"
                                    viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                    aria-hidden="true"
                                >
                                    <path
                                        clip-rule="evenodd"
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    />
                                </svg>
                                Actions
                            </button>
                            <div
                                id="actionsDropdown"
                                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                            >
                                <ul
                                    class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="actionsDropdownButton"
                                >
                                    <li>
                                        <a
                                            href="#"
                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            >Mass Edit</a
                                        >
                                    </li>
                                </ul>
                                <div class="py-1">
                                    <a
                                        href="#"
                                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                        >Delete all</a
                                    >
                                </div>
                            </div>
                            <button
                                id="filterDropdownButton"
                                data-dropdown-toggle="filterDropdown"
                                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                type="button"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    aria-hidden="true"
                                    class="h-4 w-4 mr-2 text-gray-400"
                                    viewbox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                Filter
                                <svg
                                    class="-mr-1 ml-1.5 w-5 h-5"
                                    fill="currentColor"
                                    viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                    aria-hidden="true"
                                >
                                    <path
                                        clip-rule="evenodd"
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    />
                                </svg>
                            </button>
                            <div
                                id="filterDropdown"
                                class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700"
                            >
                                <div
                                    class="flex flex-col gap-2 items-center w-full md:w-auto"
                                >
                                    <!-- Filter In Stock -->
                                    <select
                                        v-model="filters.inStock"
                                        @change="applyFilters"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    >
                                        <option value="">All Stock</option>
                                        <option value="1">In Stock</option>
                                        <option value="0">Out of Stock</option>
                                    </select>

                                    <!-- Filter Published -->
                                    <select
                                        v-model="filters.published"
                                        @change="applyFilters"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    >
                                        <option value="">All Published</option>
                                        <option value="1">Published</option>
                                        <option value="0">Unpublished</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table
                        class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                        >
                            <tr>
                                <th scope="col" class="px-4 py-3">
                                    Product name
                                </th>
                                <th scope="col" class="px-4 py-3">Category</th>
                                <th scope="col" class="px-4 py-3">Brand</th>
                                <th scope="col" class="px-4 py-3">Price</th>
                                <th scope="col" class="px-4 py-3">In Stock</th>
                                <th scope="col" class="px-4 py-3">Publish</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="product in products.data"
                                :key="product.id"
                                class="border-b dark:border-gray-700"
                            >
                                <th
                                    scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                >
                                    {{ product.title }}
                                </th>
                                <td class="px-4 py-3">
                                    {{ product.category.name }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ product.brand.name }}
                                </td>
                                <td class="px-4 py-3">{{ product.price }}</td>
                                <td class="px-4 py-3">
                                    <label
                                        class="inline-flex relative items-center cursor-pointer"
                                    >
                                        <input
                                            type="checkbox"
                                            class="sr-only peer"
                                            :checked="product.inStock == 1"
                                            @change="toggleStockStatus(product)"
                                        />
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"
                                        ></div>
                                        <span
                                            class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >
                                            {{
                                                product.inStock == 1
                                                    ? "In Stock"
                                                    : "Out of Stock"
                                            }}
                                        </span>
                                    </label>
                                </td>
                                <td class="px-4 py-3">
                                    <label
                                        class="inline-flex relative items-center cursor-pointer"
                                    >
                                        <input
                                            type="checkbox"
                                            class="sr-only peer"
                                            :checked="product.published == 1"
                                            @change="
                                                togglePublishedStatus(product)
                                            "
                                        />
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"
                                        ></div>
                                        <span
                                            class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >
                                            {{
                                                product.published == 1
                                                    ? "Published"
                                                    : "Unpublished"
                                            }}
                                        </span>
                                    </label>
                                </td>
                                <td class="px-4 py-3">
                                    <button
                                        :id="'dropdown-button-' + product.id"
                                        :data-dropdown-toggle="
                                            'dropdown-' + product.id
                                        "
                                        class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                        type="button"
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            aria-hidden="true"
                                            fill="currentColor"
                                            viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"
                                            />
                                        </svg>
                                    </button>
                                    <div
                                        :id="'dropdown-' + product.id"
                                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                                    >
                                        <ul
                                            class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            :aria-labelledby="
                                                'dropdown-button-' + product.id
                                            "
                                        >
                                            <li>
                                                <a
                                                    href="#"
                                                    @click="
                                                        openProductModal(
                                                            false,
                                                            product
                                                        )
                                                    "
                                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                    >Edit</a
                                                >
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a
                                                href="#"
                                                @click="
                                                    deleteProduct(
                                                        product,
                                                        index
                                                    )
                                                "
                                                class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                >Delete</a
                                            >
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="m-4">
                    <Pagination :elements="products"></Pagination>
                </div>
            </div>
        </div>
    </section>

    <!--Add product modal-->
    <div
        v-show="productModal"
        tabindex="-1"
        aria-hidden="true"
        class="fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50"
    >
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50"></div>

        <!-- Modal container -->
        <div class="relative p-4 w-full max-w-4xl z-10">
            <!-- Modal content -->
            <div
                class="relative bg-white rounded-lg shadow dark:bg-gray-700 flex flex-col max-h-[90vh] w-full"
            >
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
                >
                    <h3
                        class="text-lg font-semibold text-gray-900 dark:text-white"
                    >
                        {{ isEdit ? "Edit Product" : "Create New Product" }}
                    </h3>
                    <button
                        @click="
                            () => {
                                productModal = false;
                            }
                        "
                        type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    >
                        <svg
                            class="w-3 h-3"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 14 14"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                            />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-4 md:p-5 overflow-y-auto flex-grow">
                    <form @submit.prevent="submitProduct()">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label
                                    for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Name</label
                                >
                                <input
                                    v-model="productData.title"
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Type product name"
                                    required=""
                                />
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label
                                    for="price"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Price</label
                                >
                                <input
                                    v-model="productData.price"
                                    type="number"
                                    name="price"
                                    step="0.01"
                                    min="0.00"
                                    id="price"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="$2999"
                                    required=""
                                />
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label
                                    for="qty"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Quantity</label
                                >
                                <input
                                    v-model="productData.quantity"
                                    type="number"
                                    name="qty"
                                    id="qty"
                                    min="1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="$2999"
                                    required=""
                                />
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label
                                    for="brand"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Brand</label
                                >
                                <select
                                    v-model="productData.brand_id"
                                    id="brand"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option
                                        v-for="brand in brands"
                                        :key="brand.id"
                                        :value="brand.id"
                                    >
                                        {{ brand.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label
                                    for="category"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Category</label
                                >
                                <select
                                    v-model="productData.category_id"
                                    id="category"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                >
                                    <option
                                        v-for="category in categories"
                                        :key="category.id"
                                        :value="category.id"
                                    >
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label
                                    for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Product Description</label
                                >
                                <textarea
                                    v-model="productData.description"
                                    id="description"
                                    rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Write product description here"
                                ></textarea>
                            </div>

                            <div class="col-span-2">
                                <label
                                    for="photo"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >
                                    Product Image
                                </label>
                                <input
                                    type="file"
                                    id="photo"
                                    multiple
                                    accept="image/*"
                                    @change="handleFileChange"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                />

                                <!-- Preview Existing Images -->
                                <div class="flex flex-wrap mt-4 gap-4">
                                    <div
                                        v-for="(
                                            image, index
                                        ) in productData.product_images"
                                        :key="`existing-${index}`"
                                        class="relative w-32 h-32"
                                    >
                                        <img
                                            :src="`/storage/${image.image}`"
                                            alt="Existing Product Image"
                                            class="w-full h-full object-cover rounded-lg"
                                        />
                                        <button
                                            @click="deleteImage(image, index)"
                                            type="button"
                                            class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                        >
                                            x
                                        </button>
                                    </div>
                                </div>

                                <!-- Preview New Images -->
                                <div class="flex flex-wrap mt-4 gap-4">
                                    <div
                                        v-for="(image, index) in productImages"
                                        :key="`new-${index}`"
                                        class="relative w-32 h-32"
                                    >
                                        <img
                                            :src="image.preview"
                                            alt="New Product Image"
                                            class="w-full h-full object-cover rounded-lg"
                                        />
                                        <button
                                            @click="removeImage(index)"
                                            type="button"
                                            class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                        >
                                            x
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button
                            type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { usePage, useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import { router } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import Pagination from "./Pagination.vue";

const props = defineProps({
    products: Object,
});
const brands = usePage().props.brands;
const categories = usePage().props.categories;
const isEdit = ref(false);
const productModal = ref(false);

const productData = ref({
    id: "",
    title: "",
    price: 0,
    quantity: 1,
    description: "",
    product_images: [],
    published: "",
    inStock: "",
    brand_id: "",
    category_id: "",
});

//Image
const productImages = ref([]);
const dialogImageUrl = ref("");

const handleFileChange = (event) => {
    const files = event.target.files;
    for (const file of files) {
        const reader = new FileReader();
        reader.onload = (e) => {
            productImages.value.push({
                file: file,
                preview: e.target.result,
            });
        };
        reader.readAsDataURL(file);
    }
};

const removeImage = (index) => {
    productImages.value.splice(index, 1);
};

//Submit product
const submitProduct = async () => {
    const formData = new FormData();

    // Append the non-array properties from productData
    for (const [key, value] of Object.entries(productData.value)) {
        // Skip the product_images array (we'll handle it separately)
        if (key !== "product_images") {
            formData.append(key, value);
        }
    }

    // Append product_images separately as an array of raw image files
    for (const image of productImages.value) {
        formData.append("product_images[]", image.file);
    }

    try {
        const url = productData.value.id
            ? `/admin/products/update/${productData.value.id}`
            : "/admin/products/store";

        await router.post(url, formData, {
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
            onError: (errors) => {
                Swal.fire({
                    toast: true,
                    icon: "error",
                    position: "top-end",
                    showConfirmButton: false,
                    title: errors,
                });
            },
        });
    } catch (error) {
        console.error("Error submitting the form:", error);
    }
};

const openProductModal = (create = false, product = null) => {
    productModal.value = true;
    isEdit.value = false;
    resetData();
    if (!create) {
        isEdit.value = true;
        productData.value = { ...product };
    }
};

const resetData = () => {
    productData.value = {
        id: "",
        title: "",
        price: 0,
        quantity: 1,
        description: "",
        product_images: [],
        published: "",
        inStock: "",
        brand_id: "",
        category_id: "",
    };
    dialogImageUrl.value = "";
    productImages.value = [];
};

const deleteImage = async (pimage, index) => {
    try {
        await router.delete("/admin/products/image/" + pimage.id, {
            onSuccess: (page) => {
                productData.value.product_images.splice(index, 1);
                Swal.fire({
                    toast: true,
                    icon: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    title: page.props.flash.success,
                });
            },
        });
    } catch (err) {
        console.log(err);
    }
};

const deleteProduct = (product, index) => {
    Swal.fire({
        title: "Are you sure ?",
        text: "This action cannot be undo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirm",
    }).then((result) => {
        if (result.isConfirmed) {
            try {
                router.delete("products/destroy/" + product.id, {
                    onSuccess: (page) => {
                        Swal.fire({
                            toast: true,
                            icon: "success",
                            position: "top-end",
                            showConfirmButton: false,
                            title: page.props.flash.success,
                        });
                    },
                });
            } catch (err) {
                console.log(err);
            }
        }
    });
};

//Update inStock
const toggleStockStatus = async (product) => {
    try {
        const newStatus = product.inStock == 1 ? 0 : 1; // Toggle the stock status
        await router.put(`/admin/products/update/in-stock/${product.id}`, {
            inStock: newStatus,
        });

        // Update the product's stock status locally
        product.inStock = newStatus;

        Swal.fire({
            toast: true,
            icon: "success",
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            title: `Product is now ${
                newStatus == 1 ? "In Stock" : "Out of Stock"
            }`,
        });
    } catch (error) {
        console.error("Error toggling stock status:", error);
        Swal.fire({
            toast: true,
            icon: "error",
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            title: "Failed to update stock status",
        });
    }
};

//Update published status
const togglePublishedStatus = async (product) => {
    try {
        const newStatus = product.published == 1 ? 0 : 1;
        await router.put(`/admin/products/update/published/${product.id}`, {
            published: newStatus,
        });

        product.published = newStatus;

        Swal.fire({
            toast: true,
            icon: "success",
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            title: `Product is now ${
                newStatus == 1 ? "Published" : "Unpublished"
            }`,
        });
    } catch (error) {
        console.error("Error toggling published status:", error);
        Swal.fire({
            toast: true,
            icon: "error",
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            title: "Failed to update published status",
        });
    }
};

const filters = ref({
    inStock: "", // Filter for in stock (1 or 0)
    published: "", // Filter for published (1 or 0)
    search: "",
});

const applyFilters = () => {
    const query = {
        inStock: filters.value.inStock,
        published: filters.value.published,
        search: filters.value.search,
    };

    // Remove empty filters from the query
    Object.keys(query).forEach((key) => {
        if (query[key] === "") {
            delete query[key];
        }
    });

    // Use Inertia.js to update the product list with filters
    router.get("/admin/products", query, {
        preserveState: true, // Preserve the current state
        preserveScroll: true, // Preserve the scroll position
    });
};
</script>
