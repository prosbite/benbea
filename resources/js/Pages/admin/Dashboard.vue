<script setup>
import { Head } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import NavLink from '@/Components/NavLink.vue'
import { ref, onMounted } from 'vue';

const props = defineProps(["user"])
// onMounted(() => {
//     console.log(props.user)
// })
</script>

<template>
    <Head title="Dashboard" />
    <AdminLayout>
        <div class="flex">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere animi aliquam blanditiis eius unde quis suscipit, assumenda nam officia dolor nihil odit ea explicabo repellat voluptates esse, quo laboriosam amet?
        </div>
    </AdminLayout>
</template>
