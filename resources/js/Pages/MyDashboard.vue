<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import Modal from '@/Components/Modal.vue';
import TransactionDetails from '@/Components/app/TransactionDetails.vue';
import { useUtilities } from '@/Composables/Utilities.js'

const utils = useUtilities()

let starting = useForm({
    id: null,
    user_id: null,
    starting_amount: null,
    expected_amount: 0,
    actual_amount: 0,
    location: ""
})

const props = defineProps({
    user: {
        default: Object
    },
    today_sales: {
        default: Array
    },
    today: {
        default: Object
    }
})

function amountForm (amount) {
    return utils.formatAmount(amount)
}

const handleSubmit = () => {
    starting.user_id = props.user.id
    starting.post(route('today.store'), {
        onFinish: () => {
            starting = useForm({
                id: null,
                user_id: null,
                starting_amount: 0,
                expected_amount: 0,
                actual_amount: 0,
                location: ""
            })
        }
    });
}
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
                <div v-if="!today" class="flex">
                    <form @submit.prevent="handleSubmit">
                        <div v-if="addStartingAmount" class="flex items-center gap-2">
                            <input v-model="starting.starting_amount" type="number" class="border rounded-md h-8" placeholder="0.00" required>
                            <button class="rounded-md bg-green-500 text-white px-4 py-1">Save</button>
                        </div>
                        <button @click="addStartingAmount=true" v-else :href="route('transaction.create')" class="px-3 py-1 bg-white text-green-600 text-sm rounded-md cursor-pointer border border-green-600 border-1 hover:text-emerald-700"><i class="fa fa-money-bill-wave mr-2"></i> Add Starting Amount </button>
                    </form>
               </div>
               <div v-else class="flex gap-2">
                    <span class="text-gray-400">Starting Amount:</span>
                    <span class="font-bold text-green-500">{{ amountForm(today.starting_amount) }}</span>
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
							<td class="font-bold p-2">{{ formatAmount(totalAmount) }} <span v-if="today" class="ml-2 text-green-500">({{ formatAmount(totalAmount + today.starting_amount) }})</span></td>
							<td class="p-2">{{ totalDiscount }}</td>
							<td class="p-2">TOTAL</td>
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
            </div>
        </Modal>
    </AppLayout>
</template>
<script>
export default {
    props: {
        user: Object, // Define user prop as an object
        today_sales: Array,
        today: Object
    },
	data (){
		return {
            addStartingAmount: false,
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
		},
        totalDiscount () {
			let total = 0
			this.today_sales.forEach((sale) => {
				total += parseInt(sale.discount)
			})
            return total
		},
	},
    mounted () {
        // console.log(this.today)
    }
}
</script>

