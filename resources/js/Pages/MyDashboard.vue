<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import NavLink from '@/Components/NavLink.vue';
</script>

<template>
    <Head title="Dashboard" />
    <AppLayout>
        <div class="bg-gray-50 flex justify-center items-start min-h-screen">
            <div class="max-w-[960px] p-4 w-full flex flex-col gap-4">
                <div class="flex justify-between">
                    <span class="text-xl font-bold text-slate-600">Today's Sales</span>
                    <NavLink :href="route('transaction.create')" class="px-3 py-1 bg-green-500 text-white text-sm rounded-md cursor-pointer hover:bg-green-600"><i class="fa fa-cart-plus mr-2"></i> New Transaction </NavLink>
                </div>
                <div v-if="today_sales.length === 0" class="bg-gray-200 rounded-md py-10 flex items-center justify-center">
                    <span>No sales yet.</span>
                </div>
                 <table v-else class="w-full">
                    <thead class="bg-slate-200 text-left">
                        <th class="p-2">#</th>
                        <th class="p-2">Amount Received</th>
                        <th class="p-2">Discount</th>
                        <th class="p-2">Items</th>
                    </thead>
                    <tbody>
                        <tr class="border" v-for="s,i in today_sales" :key="i">
                            <td class="p-2">{{ i + 1 }}.</td>
                            <td class="p-2">{{ formatAmount(parseInt(s.amount_received)) }}</td>
                            <td class="p-2">{{ s.discount }}</td>
                            <td class="p-2">
                                <div class="flex gap-1">
                                    <span v-for="it,k in getItems(s.products)" :key="k" class="text-sm rounded-md px-1 bg-green-500 text-white">{{it.count + " " + it.product_name }}</span>
                                    <!-- <span v-for="it,k in getItems(s.products)" :key="k" class="text-sm rounded-md px-1 bg-green-500 text-white flex items-center gap-1">{{it.count + " "}}<img :src="it.icon" class="h-4 w-4"  alt=""></span> -->
                                </div>
                            </td>
                        </tr>
                        <tr></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
<script>
export default {
    props: {
        user: Object, // Define user prop as an object
        today_sales: Array
    },
    data () {
        return {
            sales: [
                {
                    id: 1,
                    amount_received: 640,
                    items: [
                        {
                            name: "Trouser",
                            amount: 200
                        },
                        {
                            name: "Dress",
                            amount: 290
                        },
                        {
                            name: "Tops",
                            amount: 150
                        }
                    ],
                    discount: 0
                },
                {
                    id: 2,
                    amount_received: 1200,
                    items: [
                        {
                            name: "Trouser",
                            amount: 250
                        },
                        {
                            name: "Trouser",
                            amount: 290
                        },
                        {
                            name: "Tops",
                            amount: 100
                        },
                        {
                            name: "Dress",
                            amount: 290
                        }
                    ],
                    discount: 0
                }
            ]
        }
    },
    methods: {
        getItems(arr) {
            return arr.reduce((acc, obj) => {
                const existing = acc.find(item => item.id === obj.id);
                if (existing) {
                existing.count++;
                } else {
                acc.push({ ...obj, count: 1 }); // Copy object and add count
                }
                return acc;
            }, [])
        },
        formatAmount(number, locale = "en-US") {
            const formatter = new Intl.NumberFormat(locale, {
                style: "decimal",
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            })
            return formatter.format(number)
        }
    },
    mounted () {
        // console.log(this.today_sales)
    }
}
</script>

