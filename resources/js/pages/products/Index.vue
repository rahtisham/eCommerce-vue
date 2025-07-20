<script setup lang="ts">
import { useToast } from 'vue-toastification';
import AppLayout from '@/layouts/AppLayout.vue';
import Button from '@/components/ui/button/Button.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, usePage } from '@inertiajs/vue3';

interface product {
    id: number;
    name: string;
    price: number;
    description: string;
}

interface Props {
    products: product[];
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Products',
        href: '/products',
    },
];

// const page = usePage()
const toast = useToast()

// if(page.props.flash?.message) {
//     toast.success(page.props.flash.message);
// }

const handleDelete = (id: number) => {
    if (confirm('Do you want to delete this product?')) {
        router.delete(route('products.destroy', { product: id }), {
            onSuccess: () => {
                toast.success('Product deleted successfully!');
            },
            onError: (errors) => {
                console.error(errors);
            }
        });
    }
};



</script>

<template>

    <Head title="Products" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <Link :href="route('products.create')"> <Button>Create Product</Button></Link>
        </div>
        <div class="overflow-x-auto gri">
            <table class="w-full caption-bottom text-sm">
                <thead class="[&_tr]:border-b">
                    <tr class="border-b">
                        <th class="text-left px-2 py-3 font-medium">ID</th>
                        <th class="text-left px-2 py-3 font-medium">Name</th>
                        <th class="text-left px-2 py-3 font-medium">Category</th>
                        <th class="text-right px-2 py-3 font-medium">Price</th>
                    </tr>
                </thead>
                <tbody class="[&_tr:last-child]:border-0">
                    <tr v-for="product in props.products" :key="product.id"
                        class="hover:bg-muted/50 border-b transition-colors">
                        <td class="px-2 py-2">{{ product.id }}</td>
                        <td class="px-2 py-2">{{ product.name }}</td>
                        <td class="px-2 py-2">{{ product.price }}</td>
                        <td class="text-right px-2 py-2">${{ product.description }}</td>
                        <td>
                            <Link :href="route('product.edit', { id: product.id })"><button
                                class="bg-slate-600 text-white">Edit</button></Link>
                            <button class="bg-red-600" @click="handleDelete(product.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <caption class="text-muted-foreground mt-4 text-sm">
                A list of your products.
            </caption>
        </div>
    </AppLayout>
</template>
