<script setup lang="ts">
import { useToast } from 'vue-toastification';
import AppLayout from '@/layouts/AppLayout.vue';
import Button from '@/components/ui/button/Button.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create a Product',
        href: '/products/create',
    },
];

const page = usePage();
const toast = useToast();

const  form = useForm({
    name: '',
    price: '',
    description: ''
});

const handleSubmit = () => {
    console.log(form);
    form.post(route('products.store'), {
        onSuccess: () => {
            form.reset();
            toast.success('Product created successfully!');
        },
        onError: (errors) => {
            console.error(errors);
        }
    });
}
</script>

<template>

    <Head title="Products" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <h1>This is my Creat Page Form</h1>
            <form @submit.prevent="handleSubmit" class="w-8/12 space-y-4">
                <div class="space-y-2">
                    <label for="name">Name</label>
                    <input type="text" v-model="form.name" name="name" id="name" class="border p-2 rounded mb-4" />
                    <span class="text-sm text-red-600" x-if="form.errors.name">{{ form.errors.name }}</span>
                </div>
                <div class="space-y-2">
                    <label for="name">Price</label>
                    <input type="text" v-model="form.price" name="price" id="price" class="border p-2 rounded mb-4" />
                    <span class="text-sm text-red-600" x-if="form.errors.price">{{ form.errors.price }}</span>
                </div>
                <div class="space-y-2">
                    <label for="name">Description</label>
                    <input type="text" v-model="form.description" name="description" id="description" class="border p-2 rounded mb-4" />
                    <span class="text-sm text-red-600" x-if="form.errors.description">{{ form.errors.description }}</span>
                </div>
                <Button type="submit">Create Product</Button>

            </form>
        </div>
    </AppLayout>
</template>
