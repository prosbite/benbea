<script setup>
import { Head, router } from '@inertiajs/vue3'
import { computed, onMounted, ref } from 'vue'
import { Link } from '@inertiajs/vue3';
import { useUtilities } from '@/Composables/Utilities.js'

const utils = useUtilities()

const props = defineProps({
    prices: {
        type: Array,
        default: {}
    }
})

const price = ref(null)

const addPrice = () => {
    router.post(route('price.store', { price: price.value }))
    price.value = null
}

const removePrice = (price) => {
    router.delete(route('price.destroy', [price.id]))
}

</script>

<template>
    <div class="flex flex-col max-h-[500px] overflow-auto">
        <form action="" @submit.prevent="addPrice">
            <div class="flex gap-2 p-2 bg-slate-200">
                <input v-model="price" type="number" class="rounded-lg border border-slate-300 px-2 py-1 flex-1" placeholder="0.00" required>
                <button class="rounded-lg border border-slate-300 px-4 py-1 bg-slate-100 hover:bg-slate-200 active:bg-slate-300">Add Price</button>
            </div>
        </form>
        <div v-for="p in props.prices" :key="p.id" class="px-4 flex justify-between py-2 border-b cursor-pointer hover:bg-slate-100">
            <span class="text-md text-slate-600">{{ p.price }}</span>
            <i @click="removePrice(p)" class="fa fa-trash text-slate-600 hover:text-red-500"></i>
        </div>
    </div>
</template>
