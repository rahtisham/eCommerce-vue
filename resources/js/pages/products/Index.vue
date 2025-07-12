<script setup lang="ts">
import { useToast } from 'vue-toastification';
import AppLayout from '@/layouts/AppLayout.vue';
import Button from '@/components/ui/button/Button.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Products',
        href: '/products',
    },
];

const page = usePage()
const toast = useToast()

// if(page.props.flash?.message) {
//     toast.success(page.props.flash.message);
// }

</script>

<template>

    <Head title="Products" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <Link :href="route('products.create')"> <Button>Create Product</Button></Link>
        </div>
    </AppLayout>
</template>
