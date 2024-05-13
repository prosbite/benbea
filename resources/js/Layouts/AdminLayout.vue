<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const showSidebar = ref(false)
onMounted(() => {
    console.log(route().current())
})
</script>

<template>
    <div class="flex bg-gray-100 min-h-screen relative">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
         <!-- sidebar -->
        <div class="hidden md:flex flex-col items-center relative w-64 bg-gray-900 ml-[-256px] md:ml-0 transition-all" :style="showSidebar?'margin-left:-256px!important':'margin-left:0px!important'">
            <div class="flex items-center border-b border-black h-14 w-full justify-center">
                <span class="font-bold text-blue-500 text-2xl">BEN&amp;</span>
                <span class="font-bold text-pink-500 text-2xl">BEA</span>
            </div>

            <!-- Navigation  -->
            <div class="flex flex-col gap-1 w-full pt-12">
                <div class="flex gap-3 items-center h-10 text-slate-200 w-full pl-6 hover:text-blue-500">
                    <i class="fa fa-dashboard"></i>
                    <Link :href="route('admin.dashboard')">Dashboard</Link>
                </div>
                <div class="flex gap-3 items-center h-10 text-slate-200 w-full pl-6 hover:text-blue-500">
                    <i class="fa fa-gear"></i>
                    <Link :href="route('admin.dashboard')">Setup</Link>
                </div>
            </div>
        </div>

        <div class="md:hidden fixed left-0 top-0 flex flex-col items-center w-64 bg-gray-900 min-h-screen ml-[-256px] md:ml-0 transition-all" :style="showSidebar?'margin-left:-256px!important':'margin-left:0px!important'">
            <div class="flex w-full items-center justify-between border-b border-black px-6">
                <div class="flex items-center h-14 w-full justify-start">
                    <span class="font-bold text-blue-500 text-2xl">BEN&amp;</span>
                    <span class="font-bold text-pink-500 text-2xl">BEA</span>
                </div>
                <i @click="showSidebar = !showSidebar" class="fa fa-bars text-blue-200 text-2xl cursor-pointer text-right"></i>
            </div>

            <!-- Navigation  -->
            <div class="flex flex-col gap-1 w-full pt-12">
                <div class="flex gap-3 items-center h-10 text-slate-200 w-full pl-6 hover:text-blue-500" :class="route().current()==='admin.dashboard'?'bg-gray-800':''">
                    <i class="fa fa-dashboard"></i>
                    <Link :href="route('admin.dashboard')">Dashboard</Link>
                </div>
                <div class="flex gap-3 items-center h-10 text-slate-200 w-full pl-6 hover:text-blue-500">
                    <i class="fa fa-gear"></i>
                    <Link :href="route('admin.dashboard')">Setup</Link>
                </div>
            </div>
        </div>

        <div class="flex flex-col flex-1">
            <div class="flex justify-between w-full h-14 border-b bg-white items-center px-8">
                <i @click="showSidebar = !showSidebar" class="fa fa-bars text-2xl cursor-pointer text-gray-500 hover:text-gray-600 active:text-gray-700"></i>
                <div class="flex items-center gap-4">
                    <span>Hi, <span class="font-bold text-blue-500"> {{ $page.props.user.name }} </span></span>
                    <i class="fa fa-right-from-bracket text-2xl font-bold text-gray-700 hover:text-gray-800 active:text-gray-900 cursor-pointer"></i>
                </div>
            </div>
            <div class="p-4">
                <slot />
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
