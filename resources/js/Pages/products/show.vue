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
				<h1 class="text-2xl font-bold">Product Details</h1>
				<!-- <button class="bg-blue-500 text-white rounded-lg text-sm px-4 py-2 hover:bg-blue-600 active:bg-blue-500">Add Product</button> -->
			</div>			
	   </div>
    </AdminLayout>
</template>
