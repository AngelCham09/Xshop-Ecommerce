<template>
    <UserLayout>

    <div class="bg-gray-50 pb-24 pt-10">


        <div class="container mx-auto px-4">
            <!-- <h1 class="text-2xl font-bold mb-6 text-gray-900">General overview</h1> -->

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Left Sidebar -->
                <div class="lg:col-span-3">
                    <!-- User Profile Card -->
                    <div class="bg-white rounded-lg shadow-sm p-4 mb-4 border border-gray-100">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-3">
                                <img :src="user.avatar" alt="Profile" class="w-10 h-10 rounded-full">
                                <div>
                                    <h2 class="font-semibold text-gray-900">{{ user.name }}</h2>
                                    <p class="text-sm text-gray-500">{{ user.email }}</p>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-purple-600">
                                <EllipsisVerticalIcon class="w-5 h-5" />
                            </button>
                        </div>

                        <!-- Quick Actions -->
                        <div class="grid grid-cols-3 gap-2 mt-4">
                            <Link href="/profile"
                                  class="flex flex-col items-center p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                                <UserIcon class="w-5 h-5 mb-1 text-purple-600" />
                                <span class="text-xs text-purple-600">Profile</span>
                            </Link>
                            <Link href="/gifts"
                                  class="flex flex-col items-center p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                                <GiftIcon class="w-5 h-5 mb-1 text-purple-600" />
                                <span class="text-xs text-purple-600">Gifts</span>
                            </Link>
                            <Link href="/wallet"
                                  class="flex flex-col items-center p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                                <WalletIcon class="w-5 h-5 mb-1 text-purple-600" />
                                <span class="text-xs text-purple-600">Wallet</span>
                            </Link>
                        </div>
                    </div>

                    <!-- Navigation Menu -->
                    <nav class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                        <Link v-for="item in navigationItems"
                              :key="item.name"
                              :href="item.href"
                              class="flex items-center space-x-3 px-4 py-3 hover:bg-purple-50 text-gray-700 hover:text-purple-600 transition-colors">
                            <component :is="item.icon" class="w-5 h-5" />
                            <span>{{ item.name }}</span>
                        </Link>
                    </nav>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-9 space-y-6">
                    <!-- Stats Cards -->
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="space-y-2">
                                <div class="flex items-center text-gray-600">
                                    <HeartIcon class="w-5 h-5 mr-2 text-purple-600" />
                                    <span class="text-sm">Favorite products</span>
                                </div>
                                <p class="text-2xl font-bold text-gray-900">{{ stats.favorites }}</p>
                            </div>
                            <div class="space-y-2">
                                <div class="flex items-center text-gray-600">
                                    <ShoppingCartIcon class="w-5 h-5 mr-2 text-purple-600" />
                                    <span class="text-sm">Total Orders</span>
                                </div>
                                <p class="text-2xl font-bold text-gray-900">{{ stats.orders }}</p>
                            </div>
                            <div class="space-y-2">
                                <div class="flex items-center text-gray-600">
                                    <StarIcon class="w-5 h-5 mr-2 text-purple-600" />
                                    <span class="text-sm">Reviews added</span>
                                </div>
                                <p class="text-2xl font-bold text-gray-900">{{ stats.reviews }}</p>
                            </div>
                            <div class="space-y-2">
                                <div class="flex items-center text-gray-600">
                                    <ArrowPathIcon class="w-5 h-5 mr-2 text-purple-600" />
                                    <span class="text-sm">Product returns</span>
                                </div>
                                <p class="text-2xl font-bold text-gray-900">{{ stats.returns }}</p>
                            </div>
                        </div>
                    </div>

                    <slot/>

                </div>
            </div>
        </div>
    </div>
        </UserLayout>
</template>

<script setup>
import UserLayout from './UserLayout.vue'
import { Link, usePage } from '@inertiajs/vue3'
import {
    HomeIcon, UserIcon, GiftIcon, WalletIcon, ShoppingCartIcon,
    HeartIcon, StarIcon, ArrowPathIcon, CheckIcon, EllipsisVerticalIcon,
    EyeIcon, Cog6ToothIcon
} from '@heroicons/vue/24/outline'

const auth = usePage().props.auth;
const navigationItems = [
    { name: 'My orders', href: '/order', icon: ShoppingCartIcon },
    { name: 'Reviews', href: '/reviews', icon: StarIcon },
    { name: 'Delivery addresses', href: '/address', icon: HomeIcon },
    { name: 'Recently viewed', href: '/recently-viewed', icon: EyeIcon },
    { name: 'Favourite items', href: '/favourites', icon: HeartIcon },
    { name: 'Settings', href: '/settings', icon: Cog6ToothIcon },
]

const user = {
    name: auth.user.name,
    email: auth.user.email,
    avatar: '/placeholder-user.jpg',
    address: 'Miles Drive, Newark, NJ 07103, California, United States of America',
    phone: '+1234 567 890 / +12 345 678',
    country: 'United States of America'
}

const stats = {
    favorites: 455,
    orders: 124,
    reviews: 1285,
    returns: 2
}

</script>
