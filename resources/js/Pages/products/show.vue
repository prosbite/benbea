<script setup>
import { Head, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import NavLink from '@/Components/NavLink.vue'
import { computed, ref, watch } from 'vue'
import Modal from '@/Components/Modal.vue';
import PriceList from '@/Components/app/PriceList.vue';

const props = defineProps(['user', 'product', 'prices'])
const productId = null
const selectedPrice = ref(null)
const newPrice = ref(null)
const modalShow = ref(false)

const removePrice = (productId, priceId) => {
    router.delete(route('priceProduct.destroy', {product: productId, price: priceId}, {preserveScroll: false}))
}

const addProductPrice = () => {
    router.post(route('priceProduct.store', {product: props.product.id, price: selectedPrice.value}, {preserveScroll: false}))
}

const addPrice = () => {
    router.post(route('price.store', { price: newPrice.value }))
}

const priceList = computed(() => {
    return props.prices.filter(price => {
        return !props.product.prices.some(price2 => price.id === price2.id);
    });
})

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
                <div class="flex justify-between items-center py-4">
                    <h2 class="text-2xl font-bold text-slate-600">Product Prices</h2>
                    <!-- <form v-if="selectedPrice==='new'" action="" @submit.prevent="addPrice">
                    <div class="flex gap-2">
                        <input v-model="newPrice" type="number" class="rounded-lg w-72 border border-gray-300 px-3 py-2" placeholder="0.00" required>
                        <button class="rounded-lg px-3 py-2 border border-gray-300 hover:bg-gray-200">Add</button>
                        <button @click.prevent="selectedPrice=null"><i class="fa fa-times text-2xl text-red-500 font-bold"></i></button>
                    </div>
                    </form> -->
                    <form action="" @submit.prevent="addProductPrice">
                    <div class="flex gap-2 items-start">
                        <div class="flex flex-col gap-1">
                            <select v-model="selectedPrice" name="" id="" class="rounded-lg w-72 border border-gray-300 px-3 py-2" placeholder="Select price" required>
                                <option v-for="p in priceList" :key="p.id" :value="p.id">{{ p.price }}</option>
                            </select>
                            <span @click="modalShow=true" class="text-xs text-gray-400 hover:text-blue-500 hover:underline cursor-pointer active:text-blue-700">+ Add new price</span>
                        </div>
                        <button class="rounded-lg px-3 py-2 border border-gray-300 hover:bg-gray-200">Insert</button>
                    </div>
                    </form>
                </div>
                <div class="flex flex-col gap-3">
                    <div v-for="p in product.prices" :key="p.id" class="flex gap-4 items-center">
                        <input :value="p.price" type="text" class="flex-1 border border-gray-200 rounded-lg px-3 py-2 bg-gray-200" disabled>
                        <i @click="removePrice(product.id, p.id)" class="fa fa-trash text-lg text-gray-400 cursor-pointer hover:text-red-500"></i>
                    </div>
                </div>
            </div>
	   </div>
       <Modal :show="modalShow" :closeable="true">
            <div class="flex flex-col">
                <div class="flex justify-between items-center h-10 bg-gray-200 px-4">
                    <h1 class="font-bold text-slate-700">Price List</h1>
                    <i @click="modalShow=false" class="fa fa-close text-2xl cursor-pointer text-slate-600 hover:text-red-500"></i>
                </div>
                <PriceList :prices="prices" />
            </div>
        </Modal>
    </AdminLayout>
</template>
