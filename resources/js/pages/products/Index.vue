<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import Button from '@/components/ui/button/Button.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Products',
        href: '/products',
    },
];

// const page = usePage()

</script>

<template>

    <Head title="Products" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">

            <div v-if="$page.props.flash.message" class="alert text-green-600 mb-4">
                {{ $page.props.flash.message }}
            </div>

            <Link :href="route('products.create')"> <Button>Create Product</Button></Link>

        </div>
    </AppLayout>
</template>
