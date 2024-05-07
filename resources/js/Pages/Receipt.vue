<template>
    <div class="flex justify-center text-2xl">
        <div class="p-6 border flex flex-col w-full" style="max-width: 500px!important;">
            <div class="header flex flex-col mb-2">
                <span class="font-bold text-4xl text-center">BEN&BEA</span>
                <span class="text-xl text-center">{{ utils.formatDate(new Date(props.transaction.created_at)) + " " + utils.formatTime(new Date(props.transaction.created_at)) }}</span>
            </div>
            <div class="items flex flex-col w-full border-b-2 border-black text-xl">
                <div v-for="item in transaction.products" :key="item.id" class="flex justify-between items-center ">
                    <span class="">{{ item.product_name }}</span>
                    <span class="">{{ item.pivot.price }}</span>
                </div>
            </div>
            <span v-if="transaction.discount > 0" class="text-bold text-right text-xl">{{ utils.twoDigits(total) }}</span>
            <div v-if="transaction.discount > 0" class="flex justify-between items-center border-b-2 border-black">
                <span class="">DISCOUNT</span>
                <span class="">{{ "- " + transaction.discount }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-bold">TOTAL</span>
                <span class="font-bold">{{ utils.twoDigits(total - transaction.discount) }}</span>
            </div>
            <div class="flex justify-between items-center ">
                <span class="">Amount Paid</span>
                <span class="">{{ transaction.amount_received }}</span>
            </div>
            <div class="flex justify-between items-center mb-4">
                <span class="">Change</span>
                <span class="">{{ transaction.change }}</span>
            </div>
            <span class="font-bold text-center text-xl">***</span>
            <span class="font-bold text-center text-xl">THANK YOU, COME AGAIN!</span>
            <span class="text-center text-lg">Add <b>Ben N Bea</b> on facebook.</span>
        </div>
    </div>
</template>

<script setup>
import { onMounted, computed } from "vue"
import { useUtilities } from '@/Composables/Utilities.js'

const utils = useUtilities()
const props = defineProps(['transaction'])

const total = computed(() => {
    let amount = 0
    props.transaction.products.forEach((element) => {
        amount += parseFloat(element.pivot.price)
    });
    return amount
})
</script>
