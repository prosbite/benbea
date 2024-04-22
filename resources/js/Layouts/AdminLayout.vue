<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

</script>

<template>
    <div class="flex flex-col items-center relative">
        <div class="h-16 w-full bg-red-500 flex justify-center">
            <div class="flex bg-white w-full h-full max-w-[1300px] justify-between">
                <div class="logo flex items-center">
                    <NavLink :href="route('dashboard')">
                        <span class="text-2xl font-bold text-blue-500">Ben&amp;</span>
                        <span class="text-2xl text-pink-500">Bea</span>
                    </NavLink>
                </div>
            </div>
        </div>
        <div class="flex max-w-[1300px] min-h-screen flex-1">
            <!-- sidebar -->
            <div class="flex flex-col bg-white w-48">

            </div>
            <div class="flex flex-1 bg-gray-50">
                <slot />
            </div>
        </div>
    </div>
</template>
