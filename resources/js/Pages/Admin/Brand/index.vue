<template>
    <AdminLayout>
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
                                @click="openBrandModal(true)"
                                class="flex items-center gap-2 justify-center btn-primary"
                            >
                                <Icon
                                    icon="lucide:plus"
                                    width="16"
                                    height="16"
                                />
                                <span class="font-semibold">Add Brand</span>
                            </button>
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
                                        Brand ID
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Brand Name
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="brand in brands.data"
                                    :key="brand.id"
                                    class="border-b dark:border-gray-700"
                                >
                                    <th
                                        scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ brand.id }}
                                    </th>
                                    <td class="px-4 py-3">
                                        {{ brand.name }}
                                    </td>

                                    <td class="px-4 py-3">
                                        <button
                                            :id="'dropdown-button-' + brand.id"
                                            :data-dropdown-toggle="
                                                'dropdown-' + brand.id
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
                                            :id="'dropdown-' + brand.id"
                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                                        >
                                            <ul
                                                class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                :aria-labelledby="
                                                    'dropdown-button-' +
                                                    brand.id
                                                "
                                            >
                                                <li>
                                                    <a
                                                        href="#"
                                                        @click="
                                                            openBrandModal(
                                                                false,
                                                                brand
                                                            )
                                                        "
                                                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                        >Edit</a
                                                    >
                                                </li>
                                            </ul>
                                            <!-- <div class="py-1">
                                                <a
                                                    href="#"
                                                    @click="
                                                        deleteBrand(
                                                            brand,
                                                            index
                                                        )
                                                    "
                                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                    >Delete</a
                                                >
                                            </div> -->
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="m-4">
                        <Pagination :elements="brands"></Pagination>
                    </div>
                </div>
            </div>
        </section>

        <!--Add product modal-->
        <div
            v-show="brandModal"
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
                            {{ isEdit ? "Edit Brand" : "Create New Brand" }}
                        </h3>
                        <button
                            @click="
                                () => {
                                    brandModal = false;
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
                        <form @submit.prevent="submitBrand()">
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label
                                        for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Brand Name</label
                                    >
                                    <input
                                        v-model="brandData.name"
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type product name"
                                        required=""
                                    />
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
    </AdminLayout>
</template>

<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import AdminLayout from "../Components/AdminLayout.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import Pagination from "../Components/Pagination.vue";

defineProps({
    brands: Array,
});
// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});

const isEdit = ref(false);
const brandModal = ref(false);

const brandData = ref({
    name: "",
});

const resetData = () => {
    brandData.value = {
        name: "",
    };
};

const openBrandModal = (create = false, brand = null) => {
    brandModal.value = true;
    isEdit.value = false;
    resetData();
    if (!create) {
        isEdit.value = true;
        brandData.value = { ...brand };
    }
};

//Submit brand
const submitBrand = async () => {
    const formData = new FormData();

    for (const [key, value] of Object.entries(brandData.value)) {
        if (value !== null && value !== "") {
            formData.append(key, value);
        }
    }

    try {
        const url = brandData.value.id
            ? `/admin/brands/update/${brandData.value.id}`
            : "/admin/brands/store";

        await router.post(url, formData, {
            onSuccess: (page) => {
                Swal.fire({
                    toast: true,
                    icon: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    title: page.props.flash.success,
                });
                brandModal.value = false;
            },
            onError: (errors) => {
                Swal.fire({
                    toast: true,
                    icon: "error",
                    position: "top-end",
                    showConfirmButton: false,
                    title: errors.name,
                });
            },
        });
    } catch (error) {
        console.error("Error submitting the form:", error);
    }
};

//Filter
const filters = ref({
    search: "",
});

const applyFilters = () => {
    router.get(
        route("admin.brands.index"),
        { search: filters.value.search },
        { preserveState: true }
    );
};
</script>
