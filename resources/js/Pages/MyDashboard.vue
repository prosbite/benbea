<script setup>
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import Modal from '@/Components/Modal.vue';
import TransactionDetails from '@/Components/app/TransactionDetails.vue';

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
                        <th class="p-2">Amount</th>
                        <th class="p-2">Discount</th>
                        <th class="p-2">Items</th>
                    </thead>
                    <tbody>
                        <tr @click="showModal(s)" class="border hover:bg-gray-100 cursor-pointer active:bg-gray-200" v-for="s,i in today_sales" :key="i">
                            <td class="p-2">{{ i + 1 }}.</td>
                            <td class="p-2">{{ formatAmount(parseInt(s.total_amount) - parseInt(s.discount)) }}</td>
                            <td class="p-2">{{ parseInt(s.discount) }}</td>
                            <td class="p-2">
                                <div class="flex gap-1">
                                    <span v-for="it,k in getItems(s.products)" :key="k" class="text-sm rounded-md px-1 bg-green-500 text-white">{{it.count + " " + it.product_name }}</span>
                                    <!-- <span v-for="it,k in getItems(s.products)" :key="k" class="text-sm rounded-md px-1 bg-green-500 text-white flex items-center gap-1">{{it.count + " "}}<img :src="it.icon" class="h-4 w-4"  alt=""></span> -->
                                </div>
                            </td>
                        </tr>
						<tr v-if="showTotal" class="border bg-slate-200">
							<td></td>
							<td class="font-bold">{{ formatAmount(totalAmount) }}</td>
							<td></td>
							<td>TOTAL</td>
						</tr>
                        <tr></tr>
                    </tbody>
                </table>
				<div v-if="today_sales.length > 1" class="flex mt-4 justify-start">
					<button @click="showTotal = true" v-if="!showTotal" :href="route('transaction.create')" class="px-3 py-1 bg-green-500 text-white text-sm rounded-md cursor-pointer hover:bg-green-600"> Show Total </button>
					<button @click="showTotal = false" v-else :href="route('transaction.create')" class="px-3 py-1 bg-yellow-500 text-white text-sm rounded-md cursor-pointer hover:bg-yellow-600"> Hide Total </button>
				</div>
            </div>
        </div>
        <Modal :show="modalShow" :closeable="true">
            <div class="flex flex-col">
                <div class="flex justify-between items-center h-10 bg-gray-100 px-4">
                    <h1 class="font-bold text-slate-700">Transaction Details</h1>
                    <i @click="modalShow=false" class="fa fa-close text-2xl cursor-pointer text-slate-600 hover:text-red-500"></i>
                </div>
                <TransactionDetails :transaction="transaction" />
                <!-- <div class="flex flex-col p-4 gap-2">
                    <h2 class="text-xs font-bold text-slate-500">
                        ITEMS LIST
                    </h2>
                    <div class="flex flex-col mb-2 gap-1">
                        <div class="flex items-center pl-4">
                            <span class="w-1/3">Trouser</span>
                            <span class="w-2/3">250</span>
                        </div>
                        <div class="flex items-center pl-4">
                            <span class="w-1/3">Dress</span>
                            <span class="w-2/3">390</span>
                        </div>
                        <div class="flex items-center pl-4 border-b border-gray-200">
                            <span class="w-1/3">Blazer</span>
                            <span class="w-2/3">450</span>
                        </div>
                        <div class="flex flex-col gap-1 bg-gray-100 py-2 border-t">
                            <div class="flex items-center pl-4 font-bold">
                                <span class="w-1/3">3 Items</span>
                                <span class="w-2/3">1,020</span>
                            </div>
                            <div class="flex items-center pl-4 text-red-600 border-b border-gray-200">
                                <span class="w-1/3 pl-4">Discount</span>
                                <span class="w-1/3 font-bold"></span>
                                <span class="w-1/3">20</span>
                            </div>
                            <div class="flex items-center pl-4">
                                <span class="w-1/3 font-bold">Total</span>
                                <span class="w-1/3 font-bold">1,000</span>
                                <span class="w-1/3"></span>
                            </div>
                            <div class="flex items-center pl-4 border-b border-gray-200 text-red-600">
                                <span class="w-1/3 pl-4">Amount Received</span>
                                <span class="w-1/3 text-gray-700"></span>
                                <span class="w-1/3">1,200</span>
                            </div>
                            <div class="flex items-center pl-4 font-bold text-green-600">
                                <span class="w-1/3">Change</span>
                                <span class="w-2/3">200</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div class="flex gap-4">
                            <div class="flex flex-col gap-1 flex-1">
                                <label for="" class="text-xs text-slate-800">Date of Purchase</label>
                                <span type="text" class="border-0 h-10 bg-gray-100 rounded-md w-fill">21 Apr 2024</span>
                            </div>
                            <div class="flex flex-col gap-1 flex-1">
                                <label for="" class="text-xs text-slate-800">Time of Purchase</label>
                                <span type="text" class="border-0 h-10 bg-gray-100 rounded-md w-fill">10:51 AM</span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1 flex-1 mb-12">
                            <label for="" class="text-xs text-slate-800">Remarks</label>
                            <span type="text" class="border-0 min-h-10 bg-gray-100 rounded-md w-fill">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum fuga quisquam quo molestias, tenetur accusamus corrupti iste obcaecati deleniti pariatur laboriosam possimus officia voluptate! Excepturi libero necessitatibus nisi eaque consequuntur!</span>
                        </div>
                    </div>
                </div> -->
            </div>
        </Modal>
    </AppLayout>
</template>
<script>
export default {
    props: {
        user: Object, // Define user prop as an object
        today_sales: Array
    },
	data (){
		return {
			showTotal: false,
            transaction: {},
            modalShow: false,
		}
	},
    methods: {
        showModal (trans) {
            this.transaction = trans
            this.modalShow = true
        },
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
	computed: {
		totalAmount () {
			let total = 0
			this.today_sales.forEach((sale) => {
				total += parseInt(sale.total_amount - sale.discount)
			})
			return total
		}
	},
    mounted () {
        // console.log(this.today_sales)
    }
}
</script>

