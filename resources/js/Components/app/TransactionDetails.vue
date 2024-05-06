<script setup>
import { Head } from '@inertiajs/vue3'
import { computed } from 'vue'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import NavLink from '@/Components/NavLink.vue'
import { Link } from '@inertiajs/vue3';
import { useUtilities } from '@/Composables/Utilities.js'

const utils = useUtilities()

const props = defineProps({
    transaction: {
        type: Object,
        default: {}
    }
})

const productTotal = computed(() => {
    let amount = 0
    props.transaction.products.forEach(pr => {
        amount += parseInt(pr.pivot.price)
    });
    return amount
})

</script>

<template>
    <div>
        <div class="flex flex-col p-4 gap-2">
            <h2 class="text-xs font-bold text-slate-500">
                ITEMS LIST
            </h2>
            <div class="flex flex-col mb-2 gap-1">
                <div v-for="tp in transaction.products" :key="tp.id" class="flex items-center pl-4">
                    <span class="w-1/3">{{ tp.product_name }}</span>
                    <span class="w-2/3">{{ utils.formatAmount(parseInt(tp.pivot.price)) }}</span>
                </div>
                <div class="flex flex-col gap-1 bg-gray-100 py-2 border-t">
                    <div class="flex items-center pl-4 font-bold">
                        <span class="w-1/3">{{ transaction.products.length }} Items</span>
                        <span class="w-2/3">{{ utils.formatAmount(productTotal) }}</span>
                    </div>
                    <div v-if="transaction.discount > 0" class="flex items-center pl-4 text-red-600 border-b border-gray-200">
                        <span class="w-1/3 pl-4">Discount</span>
                        <span class="w-1/3 font-bold"></span>
                        <span class="w-1/3">{{ utils.formatAmount(parseInt(transaction.discount)) }}</span>
                    </div>
                    <div v-if="transaction.discount > 0" class="flex items-center pl-4">
                        <span class="w-1/3 font-bold">Total</span>
                        <span class="w-1/3 font-bold">{{ utils.formatAmount(productTotal - parseInt(transaction.discount)) }}</span>
                        <span class="w-1/3"></span>
                    </div>
                    <div class="flex items-center pl-4 border-b border-gray-200 text-red-600">
                        <span class="w-1/3 pl-4">Amount Received</span>
                        <span class="w-1/3 text-gray-700"></span>
                        <span class="w-1/3">{{ utils.formatAmount(parseInt(transaction.amount_received)) }}</span>
                    </div>
                    <div class="flex items-center pl-4 font-bold text-green-600">
                        <span class="w-1/3">Change</span>
                        <span class="w-2/3">{{ utils.formatAmount(parseInt(transaction.change)) }}</span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex gap-4">
                    <div class="flex flex-col gap-1 flex-1">
                        <label for="" class="text-xs text-slate-800">Date of Purchase</label>
                        <span type="text" class="border-0 h-10 bg-gray-100 rounded-md w-fill">{{ utils.formatDate(new Date(transaction.created_at)) }}</span>
                    </div>
                    <div class="flex flex-col gap-1 flex-1">
                        <label for="" class="text-xs text-slate-800">Time of Purchase</label>
                        <span type="text" class="border-0 h-10 bg-gray-100 rounded-md w-fill">{{ utils.formatTime(new Date(transaction.created_at)) }}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-1 flex-1 mb-12">
                    <label for="" class="text-xs text-slate-800">Remarks</label>
                    <span type="text" class="border-0 min-h-10 bg-gray-100 rounded-md w-fill">{{ transaction.note }}</span>
                </div>
                <Link :href="route('receipt', transaction.id)" class="border px-8 py-2 text-center rounded-md hover:bg-gray-100 active:bg-gray-200">Print Receipt</Link>
            </div>
        </div>
    </div>
</template>
