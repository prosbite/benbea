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
                    <NavLink :href="route('transaction.create')" class="px-3 py-1 bg-green-500 text-white text-sm rounded-md cursor-pointer hover:bg-green-600"> New Transaction </NavLink>
                </div>
                 <table class="w-full">
                    <thead class="bg-slate-200 text-left">
                        <th class="p-2">#</th>
                        <th class="p-2">Amount Received</th>
                        <th class="p-2">Discount</th>
                        <th class="p-2">Items</th>
                    </thead>
                    <tbody>
                        <tr class="border" v-for="s,i in sales" :key="i">
                            <td class="p-2">{{ i + 1 }}</td>
                            <td class="p-2">{{ formatAmount(s.amount_received) }}</td>
                            <td class="p-2">{{ formatAmount(s.discount) }}</td>
                            <td class="p-2">
                                <div class="flex gap-1">
                                    <span v-for="it,k in getItems(s.items)" :key="k" class="text-sm rounded-md px-1 bg-green-500 text-white">{{it.count + " " + it.name }}</span>
                                </div>
                            </td>
                        </tr>
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
                const existing = acc.find(item => item.name === obj.name);
                if (existing) {
                existing.count++;
                } else {
                acc.push({ ...obj, count: 1 }); // Copy object and add count
                }
                return acc;
            }, [])
        },
        formatAmount(number) {
            return number.toFixed(2);
        }
    }
}
</script>

