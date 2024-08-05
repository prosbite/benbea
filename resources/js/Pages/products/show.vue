<script setup>
import { Head, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import NavLink from '@/Components/NavLink.vue'
import axios, { Axios } from 'axios';

const props = defineProps(['user', 'product'])
const productId = null

const removePrice = (productId, priceId) => {
    console.log(priceId, productId)
    router.delete(route('priceProduct.destroy', {product: productId, price: priceId}))
}
</script>

<template>
    <Head title="Dashboard" />
    <AdminLayout>
       <div class="flex flex-col border rounded-lg bg-white px-8 py-10">
        <div class="flex gap-2 items-center mb-8 text-gray-400 hover:text-blue-600">
            <i class="fa fa-chevron-left text-lg"></i>
            <a :href="route('products.index')" class=" text-lg">BACK</a>
        </div>
			<div class="flex items-center mb-6 border-b py-4 gap-4">
                <img :src="product.icon" alt="" class="w-20 h-20">
                <div class="flex flex-col gap-1">
                    <h1 class="text-2xl font-bold text-blue-500">{{ product.product_name }}</h1>
                    <button class="bg-yellow-500 text-white px-4 py-1 text-xs rounded-lg hover:bg-yellow-600 active:bg-yellow-500">Change Icon</button>
                </div>
			</div>
            <div class="flex flex-col gap-2">
                <h2 class="text-md font-bold text-gray-600">Product Prices</h2>
                <div class="flex flex-col gap-3">
                    <div v-for="p in product.prices" :key="p.id" class="flex gap-4 items-center">
                        <input :value="p.price" type="text" class="flex-1 border border-gray-200 rounded-lg px-3 py-2 bg-gray-200" disabled>
                        <i @click="removePrice(product.id, p.id)" class="fa fa-trash text-lg text-gray-400 cursor-pointer hover:text-red-500"></i>
                    </div>
                </div>
            </div>
	   </div>
    </AdminLayout>
</template>
