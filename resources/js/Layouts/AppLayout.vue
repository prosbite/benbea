<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

</script>

<template>
    <div class="flex flex-col">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <div class="bg-white flex justify-center border-b">
            <div class="max-w-[960px] flex-1 flex justify-between p-4 margin-auto">
                <NavLink :href="route('dashboard')">
                    <span class="text-2xl font-bold text-blue-500">Ben&amp;</span>
                    <span class="text-2xl text-pink-500">Bea</span>
                </NavLink>
                <div class="flex items-center gap-2">
                    <span class="flex-1">Welcome, {{ $page.props.user.name }}</span>
                    <Link :href="route('logout')" method="post" as="button" class="bg-white text-gray-700 border font-bold px-4 py-1 rounded-lg">Logout</Link>
                    <!-- <form action="/logout" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="bg-green-500 text-white px-4 py-1 rounded-lg">Logout</button>
                    </form> -->
                    <!-- <DropdownLink :href="route('logout')" method="post" as="button">
                        Log Out
                    </DropdownLink> -->
                </div>
            </div>
        </div>
        <div>
            <slot />
        </div>
    </div>
</template>
