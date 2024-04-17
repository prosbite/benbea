<script setup>
import { computed, onMounted, ref } from 'vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import NavLink from '@/Components/NavLink.vue';

const props = defineProps(["user", "products"])

const transaction = useForm({
    id: null,
    items: [],
    total_amount: 0,
    amount_received: null,
    discount: null,
    change: 0,
    user_id: null,
})
const items = ref([])
function setItem(itm) {
    if (itm === item.value) {
        item.value = {}
    } else {
        item.value = itm
    }
}
function addItem (price) {
    transaction.items.push({
        id: item.value.id,
        product_name: item.value.product_name,
        price: parseInt(price.price)
    })
}
function removeItem (item) {
    transaction.items = transaction.items.filter(itm => itm !== item)
}
function formatCurrency (number, locale = "en-US") {
    const formatter = new Intl.NumberFormat(locale, {
        style: "decimal",
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    })
    return formatter.format(number)
}
const totalAmount = computed(() => {
    let amount = 0
    transaction.items.forEach((itm) => {
        amount += itm.price
    })
    return amount
})
const changeAmount = computed(() => {
    return transaction.amount_received + transaction.discount - totalAmount.value
})
const item = ref({})
onMounted(() => {
    items.value = props.products
    transaction.user_id = props.user.id
})
const checkOut = () => {
    transaction.discount = !transaction.discount ? 0 : transaction.discount
    transaction.post(route('transaction.store'), {
        onFinish: () => {
            alert("Saved successfully!")
        }
    });
}
</script>

<template>
    <Head title="New Transaction" />
    <AppLayout>
        <div class="flex flex-col items-center gap-2">
            <div class="flex flex-col max-w-[960px] p-4 w-full">
                <div class="flex bg-gray-100">
                    <div
                        @click="setItem(itm)"
                        v-for="itm,i in items"
                        :key="i"
                        class="flex flex-col items-center justify-center gap-2 bg-gray-100 w-20 h-20 border hover:bg-gray-200 cursor-pointer"
                        :class="itm === item? 'bg-gray-200' : 'bg-gray-100'"
                    >
                        <img :src="itm.icon" class="w-[24px] h-[24px]" alt="">
                        <span class="text-xs">{{ itm.product_name.toUpperCase() }}</span>
                    </div>
                </div>
                <div class="flex bg-gray-200">
                    <span @click="addItem(price)" v-for="price,i in item.prices" :key="price.id" class="w-20 h-20 cursor-pointer bg-gray-200 hover:bg-gray-300 active:bg-gray-400 flex justify-center items-center font-bold text-xl border-r border-gray-300">{{ parseInt(price.price) }}</span>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 w-full justify-between p-4 max-w-[960px]">
                <div class="flex flex-col gap-1 flex-1">
                    <label for="" class="text-sm font-bold">Amount Paid</label>
                    <input v-model="transaction.amount_received" type="number" class="px-2 py-1 rounded-md border border-gray-300 w-fill" placeholder="0.00">
                </div>
                <div class="flex flex-col gap-1 flex-1">
                    <label for="" class="text-sm font-bold">Discount</label>
                    <input v-model="transaction.discount" type="number" class="px-2 py-1 rounded-md border border-gray-300 w-fill" placeholder="0.00">
                </div>
            </div>
            <div class="flex flex-col w-full max-w-[960px] p-4">
                <div v-if="transaction.items.length === 0" class="py-12 bg-gray-100 flex items-center justify-center rounded-md">
                    <span class="text-gray-800">No items in your list.</span>
                </div>
                <div v-for="itm,i in transaction.items" :key="i" class="flex gap-2 items-center bg-white border-b px-2 py-1 rounded-md">
                    <span class="border-r px-3">{{ i + 1 }}.</span>
                    <span class="flex-1">{{ itm.product_name }}</span>
                    <span class="flex-1">{{ itm.price }}</span>
                    <span @click="removeItem(itm)" class="flex-1 text-right cursor-pointer"><i class="fa fa-times text-3xl font-bold text-red-500"></i></span>
                </div>
                <div v-if="transaction.items.length > 0" class="flex flex-col">
                    <div class="flex gap-2 items-center font-bold bg-blue-50 border-b px-2 py-1 rounded-md">
                        <span class="border-r px-4"></span>
                        <span class="flex-1">Total</span>
                        <span class="flex-2 text-left">{{ formatCurrency(totalAmount - transaction.discount) }}  <span v-if="transaction.discount > 0" class="text-gray-600 ml-4">({{ formatCurrency(totalAmount) + " - " + formatCurrency(transaction.discount) }})</span></span>
                        <!-- <span class="flex-1 text-left cursor-pointer">(400 - 35)</span> -->
                    </div>
                    <div v-if="transaction.discount > 0" class="flex gap-2 items-center font-bold bg-red-50 border-b px-2 py-1 rounded-md">
                        <span class="border-r px-4"></span>
                        <span class="flex-1 ml-4">Discount</span>
                        <span class="flex-1"></span>
                        <span class="flex-1">{{ formatCurrency(transaction.discount) }}</span>
                    </div>
                    <div v-if="transaction.amount_received > 0" class="flex gap-2 items-center font-bold bg-red-50 border-b px-2 py-1 rounded-md">
                        <span class="border-r px-4"></span>
                        <span class="flex-1 ml-4">Amount Paid</span>
                        <span class="flex-1"></span>
                        <span class="flex-1">{{ formatCurrency(transaction.amount_received) }}</span>
                    </div>
                    <div v-if="transaction.amount_received > 0" class="flex gap-2 items-center font-bold bg-green-50 border-b px-2 py-1 rounded-md">
                        <span class="border-r px-4"></span>
                        <span class="flex-1">Change</span>
                        <span class="flex-1">{{ formatCurrency(changeAmount) }}</span>
                        <span class="flex-1"></span>
                    </div>
                </div>
                <div class="flex justify-center sm:justify-end pb-48 pt-10 gap-4">
                    <NavLink :href="route('dashboard')" class="text-2xl px-8 text-white bg-yellow-600 hover:bg-yellow-700 active:bg-yellow-600 cursor-pointer rounded-lg"><i class="fa fa-ban mr-2"></i>Cancel</NavLink>
                    <span @click="checkOut" v-if="transaction.amount_received > 1&&transaction.items.length > 1" class="py-2 px-4 text-white bg-green-600 hover:bg-green-700 active:bg-green-600 cursor-pointer rounded-lg"><i class="fa fa-cart-shopping mr-2"></i>Check Out</span>
                    <span v-else class="py-2 px-4 text-white bg-gray-300 rounded-lg"><i class="fa fa-cart-shopping mr-2"></i>Check Out</span>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<style scoped>
.flex-2 {
    flex: 2
}
</style>
