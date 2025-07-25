<script setup>
import UserLayouts from "./Layouts/UserLayout.vue";

import { ref, watch } from "vue";
import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import {
    ChevronDownIcon,
    FunnelIcon,
    MinusIcon,
    PlusIcon,
    Squares2X2Icon,
} from "@heroicons/vue/20/solid";
import ProductList from "./Components/ProductList.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { router, useForm } from "@inertiajs/vue3";

const sortOptions = [
    { name: "Most Popular", href: "#", current: true },
    { name: "Best Rating", href: "#", current: false },
    { name: "Newest", href: "#", current: false },
    { name: "Price: Low to High", href: "#", current: false },
    { name: "Price: High to Low", href: "#", current: false },
];
const subCategories = [
    { name: "Totes", href: "#" },
    { name: "Backpacks", href: "#" },
    { name: "Travel Bags", href: "#" },
    { name: "Hip Bags", href: "#" },
    { name: "Laptop Sleeves", href: "#" },
];
const filters = [
    {
        id: "color",
        name: "Color",
        options: [
            { value: "white", label: "White", checked: false },
            { value: "beige", label: "Beige", checked: false },
            { value: "blue", label: "Blue", checked: true },
            { value: "brown", label: "Brown", checked: false },
            { value: "green", label: "Green", checked: false },
            { value: "purple", label: "Purple", checked: false },
        ],
    },
    {
        id: "category",
        name: "Category",
        options: [
            { value: "new-arrivals", label: "New Arrivals", checked: false },
            { value: "sale", label: "Sale", checked: false },
            { value: "travel", label: "Travel", checked: true },
            { value: "organization", label: "Organization", checked: false },
            { value: "accessories", label: "Accessories", checked: false },
        ],
    },
    {
        id: "size",
        name: "Size",
        options: [
            { value: "2l", label: "2L", checked: false },
            { value: "6l", label: "6L", checked: false },
            { value: "12l", label: "12L", checked: false },
            { value: "18l", label: "18L", checked: false },
            { value: "20l", label: "20L", checked: false },
            { value: "40l", label: "40L", checked: true },
        ],
    },
];

const filterPrices = useForm({
    prices: [0, 100000],
});

const priceFilter = () => {
    filterPrices
        .transform((data) => ({
            ...data,
            prices: {
                from: data.prices[0],
                to: data.prices[1],
            },
        }))
        .get("products", {
            preserveState: true,
            replace: true,
        });
};

const mobileFiltersOpen = ref(false);

const props = defineProps({
    products: Array,
    brands: Array,
    categories: Array,
});

const selectedBrands = ref([]);
const selectedCategories = ref([]);

watch(selectedBrands, () => {
    updateFilterProducts();
});

watch(selectedCategories, () => {
    updateFilterProducts();
});

function updateFilterProducts() {
    router.get('products', {
        brands: selectedBrands.value,
        categories: selectedCategories.value,
    }, {
        preserveState: true,
        replace: true,
    });
}

</script>
<template>
    <UserLayouts>
        <div class="bg-white">
            <div>
                <!-- Mobile filter dialog -->
                <TransitionRoot as="template" :show="mobileFiltersOpen">
                    <Dialog
                        class="relative z-40 lg:hidden"
                        @close="mobileFiltersOpen = false"
                    >
                        <TransitionChild
                            as="template"
                            enter="transition-opacity ease-linear duration-300"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="transition-opacity ease-linear duration-300"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div class="fixed inset-0 bg-black/25" />
                        </TransitionChild>

                        <div class="fixed inset-0 z-40 flex">
                            <TransitionChild
                                as="template"
                                enter="transition ease-in-out duration-300 transform"
                                enter-from="translate-x-full"
                                enter-to="translate-x-0"
                                leave="transition ease-in-out duration-300 transform"
                                leave-from="translate-x-0"
                                leave-to="translate-x-full"
                            >
                                <DialogPanel
                                    class="relative ml-auto flex size-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl"
                                >
                                    <div
                                        class="flex items-center justify-between px-4"
                                    >
                                        <h2
                                            class="text-lg font-medium text-gray-900"
                                        >
                                            Filters
                                        </h2>
                                        <button
                                            type="button"
                                            class="-mr-2 flex size-10 items-center justify-center rounded-md bg-white p-2 text-gray-400"
                                            @click="mobileFiltersOpen = false"
                                        >
                                            <span class="sr-only"
                                                >Close menu</span
                                            >
                                            <XMarkIcon
                                                class="size-6"
                                                aria-hidden="true"
                                            />
                                        </button>
                                    </div>

                                    <!-- Filters -->
                                    <form class="mt-4 border-t border-gray-200">
                                        <h3 class="sr-only">Prices</h3>
                                        <!--price filter-->
                                        <div
                                            class="flex items-center justify-between space-x-3"
                                        >
                                            <div class="basis-1/3">
                                                <label
                                                    for="filters-price-from"
                                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                                    >Price from</label
                                                >

                                                <input
                                                    id="filters-price-from"
                                                    type="number"
                                                    placeholder="Min price"
                                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900"
                                                />
                                            </div>
                                            <div class="basis-1/3">
                                                <label
                                                    for="filters-price-from"
                                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                                    >To</label
                                                >

                                                <input
                                                    id="filters-price-from"
                                                    type="number"
                                                    placeholder="Max price"
                                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900"
                                                />
                                            </div>
                                            <secondary-button
                                                class="self-end"
                                                :disabled="filters.processing"
                                                @click="priceFilter()"
                                            >
                                                Apply
                                            </secondary-button>
                                        </div>
                                        <!--end-->
                                        <Disclosure
                                            as="div"
                                            v-for="section in filters"
                                            :key="section.id"
                                            class="border-t border-gray-200 px-4 py-6"
                                            v-slot="{ open }"
                                        >
                                            <h3 class="-mx-2 -my-3 flow-root">
                                                <DisclosureButton
                                                    class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"
                                                >
                                                    <span
                                                        class="font-medium text-gray-900"
                                                        >{{
                                                            section.name
                                                        }}</span
                                                    >
                                                    <span
                                                        class="ml-6 flex items-center"
                                                    >
                                                        <PlusIcon
                                                            v-if="!open"
                                                            class="size-5"
                                                            aria-hidden="true"
                                                        />
                                                        <MinusIcon
                                                            v-else
                                                            class="size-5"
                                                            aria-hidden="true"
                                                        />
                                                    </span>
                                                </DisclosureButton>
                                            </h3>
                                            <DisclosurePanel class="pt-6">
                                                <div class="space-y-6">
                                                    <div
                                                        v-for="(
                                                            option, optionIdx
                                                        ) in section.options"
                                                        :key="option.value"
                                                        class="flex gap-3"
                                                    >
                                                        <div
                                                            class="flex h-5 shrink-0 items-center"
                                                        >
                                                            <div
                                                                class="group grid size-4 grid-cols-1"
                                                            >
                                                                <input
                                                                    :id="`filter-mobile-${section.id}-${optionIdx}`"
                                                                    :name="`${section.id}[]`"
                                                                    :value="
                                                                        option.value
                                                                    "
                                                                    type="checkbox"
                                                                    class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                                                                />
                                                                <svg
                                                                    class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
                                                                    viewBox="0 0 14 14"
                                                                    fill="none"
                                                                >
                                                                    <path
                                                                        class="opacity-0 group-has-checked:opacity-100"
                                                                        d="M3 8L6 11L11 3.5"
                                                                        stroke-width="2"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                    />
                                                                    <path
                                                                        class="opacity-0 group-has-indeterminate:opacity-100"
                                                                        d="M3 7H11"
                                                                        stroke-width="2"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                    />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <label
                                                            :for="`filter-mobile-${section.id}-${optionIdx}`"
                                                            class="min-w-0 flex-1 text-gray-500"
                                                            >{{
                                                                option.label
                                                            }}</label
                                                        >
                                                    </div>
                                                </div>
                                            </DisclosurePanel>
                                        </Disclosure>
                                    </form>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </Dialog>
                </TransitionRoot>

                <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div
                        class="flex items-baseline justify-between border-b border-gray-200 pt-24 pb-6"
                    >
                        <h1
                            class="text-4xl font-bold tracking-tight text-gray-900"
                        >
                            New Arrivals
                        </h1>

                        <div class="flex items-center">
                            <Menu
                                as="div"
                                class="relative inline-block text-left"
                            >
                                <div>
                                    <MenuButton
                                        class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"
                                    >
                                        Sort
                                        <ChevronDownIcon
                                            class="-mr-1 ml-1 size-5 shrink-0 text-gray-400 group-hover:text-gray-500"
                                            aria-hidden="true"
                                        />
                                    </MenuButton>
                                </div>

                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95"
                                >
                                    <MenuItems
                                        class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white ring-1 shadow-2xl ring-black/5 focus:outline-hidden"
                                    >
                                        <div class="py-1">
                                            <MenuItem
                                                v-for="option in sortOptions"
                                                :key="option.name"
                                                v-slot="{ active }"
                                            >
                                                <a
                                                    :href="option.href"
                                                    :class="[
                                                        option.current
                                                            ? 'font-medium text-gray-900'
                                                            : 'text-gray-500',
                                                        active
                                                            ? 'bg-gray-100 outline-hidden'
                                                            : '',
                                                        'block px-4 py-2 text-sm',
                                                    ]"
                                                    >{{ option.name }}</a
                                                >
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>

                            <button
                                type="button"
                                class="-m-2 ml-5 p-2 text-gray-400 hover:text-gray-500 sm:ml-7"
                            >
                                <span class="sr-only">View grid</span>
                                <Squares2X2Icon
                                    class="size-5"
                                    aria-hidden="true"
                                />
                            </button>
                            <button
                                type="button"
                                class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden"
                                @click="mobileFiltersOpen = true"
                            >
                                <span class="sr-only">Filters</span>
                                <FunnelIcon class="size-5" aria-hidden="true" />
                            </button>
                        </div>
                    </div>

                    <section
                        aria-labelledby="products-heading"
                        class="pt-6 pb-24"
                    >
                        <h2 id="products-heading" class="sr-only">Products</h2>

                        <div
                            class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4"
                        >
                            <!-- Filters -->
                            <form class="hidden lg:block">
                                <h3 class="sr-only">Price</h3>
                                <div
                                    class="flex items-center justify-between space-x-3"
                                >
                                    <div class="basis-1/3">
                                        <label
                                            for="filters-price-from"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                            >Price from</label
                                        >

                                        <input
                                            id="filters-price-from"
                                            type="number"
                                            placeholder="Min price"
                                            v-model="filterPrices.prices[0]"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900"
                                        />
                                    </div>
                                    <div class="basis-1/3">
                                        <label
                                            for="filters-price-from"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                            >To</label
                                        >

                                        <input
                                            id="filters-price-from"
                                            type="number"
                                            placeholder="Max price"
                                            v-model="filterPrices.prices[1]"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900"
                                        />
                                    </div>
                                    <secondary-button
                                        class="self-end"
                                        :disabled="filters.processing"
                                        @click="priceFilter()"
                                    >
                                        Apply
                                    </secondary-button>
                                </div>

                                <!--Brands-->
                                <Disclosure
                                    as="div"
                                    class="border-b border-gray-200 py-6"
                                    v-slot="{ open }"
                                >
                                    <h3 class="-my-3 flow-root">
                                        <DisclosureButton
                                            class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                        >
                                            <span
                                                class="font-medium text-gray-900"
                                                >Brands</span
                                            >
                                            <span
                                                class="ml-6 flex items-center"
                                            >
                                                <PlusIcon
                                                    v-if="!open"
                                                    class="size-5"
                                                    aria-hidden="true"
                                                />
                                                <MinusIcon
                                                    v-else
                                                    class="size-5"
                                                    aria-hidden="true"
                                                />
                                            </span>
                                        </DisclosureButton>
                                    </h3>
                                    <DisclosurePanel class="pt-6">
                                        <div class="space-y-4">
                                            <div
                                                v-for="brand in brands"
                                                :key="`brand-${brand.value}`"
                                                class="flex gap-3"
                                            >
                                                <div
                                                    class="flex h-5 shrink-0 items-center"
                                                >
                                                    <div
                                                        class="group grid size-4 grid-cols-1"
                                                    >
                                                        <input
                                                            :id="`brand-filter-${brand.id}`"
                                                            :value="brand.id"
                                                            v-model="selectedBrands"
                                                            type="checkbox"
                                                            class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                                                        />
                                                        <svg
                                                            class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                class="opacity-1 group-has-checked:opacity-100"
                                                                d="M3 8L6 11L11 3.5"
                                                                stroke-width="2"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
                                                            <path
                                                                class="opacity-0 group-has-indeterminate:opacity-100"
                                                                d="M3 7H11"
                                                                stroke-width="2"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <label
                                                    :for="`brand-filter-${brand.id}`"
                                                    class="text-sm text-gray-600"
                                                    >{{ brand.name }}</label
                                                >
                                            </div>
                                        </div>
                                    </DisclosurePanel>
                                </Disclosure>

                                <!--Category-->
                                <Disclosure
                                    as="div"
                                    class="border-b border-gray-200 py-6"
                                    v-slot="{ open }"
                                >
                                    <h3 class="-my-3 flow-root">
                                        <DisclosureButton
                                            class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                        >
                                            <span
                                                class="font-medium text-gray-900"
                                                >Categories</span
                                            >
                                            <span
                                                class="ml-6 flex items-center"
                                            >
                                                <PlusIcon
                                                    v-if="!open"
                                                    class="size-5"
                                                    aria-hidden="true"
                                                />
                                                <MinusIcon
                                                    v-else
                                                    class="size-5"
                                                    aria-hidden="true"
                                                />
                                            </span>
                                        </DisclosureButton>
                                    </h3>
                                    <DisclosurePanel class="pt-6">
                                        <div class="space-y-4">
                                            <div
                                                v-for="category in categories"
                                                :key="`category-${category.value}`"
                                                class="flex gap-3"
                                            >
                                                <div
                                                    class="flex h-5 shrink-0 items-center"
                                                >
                                                    <div
                                                        class="group grid size-4 grid-cols-1"
                                                    >
                                                        <input
                                                            :id="`category-filter-${category.id}`"
                                                            :value="category.id"
                                                            v-model="selectedCategories"
                                                            type="checkbox"
                                                            class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                                                        />
                                                        <svg
                                                            class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                class="opacity-1 group-has-checked:opacity-100"
                                                                d="M3 8L6 11L11 3.5"
                                                                stroke-width="2"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
                                                            <path
                                                                class="opacity-0 group-has-indeterminate:opacity-100"
                                                                d="M3 7H11"
                                                                stroke-width="2"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <label
                                                    :for="`category-filter-${category.id}`"
                                                    class="text-sm text-gray-600"
                                                    >{{ category.name }}</label
                                                >
                                            </div>
                                        </div>
                                    </DisclosurePanel>
                                </Disclosure>
                            </form>

                            <!-- Product grid -->
                            <div class="lg:col-span-3">
                                <ProductList
                                    :products="products.data"
                                    :columns="3"
                                ></ProductList>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </UserLayouts>
</template>
