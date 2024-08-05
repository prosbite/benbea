<script setup>
import { Head, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import NavLink from '@/Components/NavLink.vue'
import { ref, onMounted } from 'vue';

const props = defineProps(['user', 'products'])
onMounted(() => {
	console.log(props.user)
})
</script>

<template>
    <Head title="Dashboard" />
    <AdminLayout>
       <div class="flex flex-col border rounded-lg bg-white px-8 py-10">
			<div class="flex justify-between items-center mb-6">
				<h1 class="text-2xl font-bold">List of Products</h1>
				<!-- <button class="bg-blue-500 text-white rounded-lg text-sm px-4 py-2 hover:bg-blue-600 active:bg-blue-500">Add Product</button> -->
			</div>

			<form action="" @submit.prevent>
			<div class="flex flex-col md:flex-row gap-2 md:gap-6 py-4 md:items-end bg-blue-100 px-4 rounded-lg mb-4 border">
				<div class="flex flex-col flex-1 gap-1">
					<span class="text-xs text-gray-500">Product Name</span>
					<input type="text" class="rounded-lg border px-2 py-1 w-full" required>
				</div>
				<div class="flex flex-col flex-1 gap-1">
					<span class="text-xs text-gray-500">Price</span>
					<input type="text" class="rounded-lg border px-2 py-1 w-full" required>
				</div>
				<div class="flex flex-col gap-1 max-w-56">
					<span class="text-xs text-gray-500">Icon</span>
					<!-- <input type="text" class="rounded-lg border px-2 py-1 w-full" required> -->
					<!-- <div class="w-12 h-12 border rounded bg-gray-100"></div> -->
					<input type="file" class="">
					<!-- <button class="border bg-gray-100 px-6 py-1 rounded-lg">Select an image</button> -->
				</div>
				<button class="bg-yellow-500 text-white rounded-lg text-sm px-4 py-2 hover:bg-yellow-600 active:bg-yellow-500">Add Product</button>
				<!-- <span class="fa fa-close text-4xl font-bold text-red-500 hover:text-red-600 cursor-pointer"></span> -->
			</div>
			</form>
			
			<table class="table w-full rounded-lg border">
				<thead class="bg-gray-100">
					<tr class="text-left">
						<th class="px-2 py-3">Product Name</th>
						<th class="px-2 py-3">Price</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="p in products" :key="p.id" class="border-b">
						<td class="px-2 py-3 flex gap-4">
							<img :src="p.icon" alt="" style="width:18px;height:auto" class="w-3 h-auto">
							<a :href="route('products.show',[p.id])" class="text-blue-500">
								{{ p.product_name }}
							</a>
						</td>
						<td class="px-2 py-2">{{ p.price }}</td>
					</tr>
				</tbody>
			</table>
	   </div>
    </AdminLayout>
</template>
