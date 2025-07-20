<script setup lang="ts">
import { useToast } from 'vue-toastification';
import AppLayout from '@/layouts/AppLayout.vue';
import Button from '@/components/ui/button/Button.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';

interface Prodcut {
    'id': number,
    'name': string,
    'price': number,
    'description': string,
}

const props = defineProps<({ product: Prodcut })>();

// const page = usePage();
const toast = useToast();

const form = useForm({
    name: props.product.name,
    price: props.product.price,
    description: props.product.description
});

const handleSubmit = () => {
    form.put(route('products.update', {product: props.product}), {
        onSuccess: () => {
            form.reset();
            toast.success('Product has been Updated successfully!');
        },
        onError: (errors) => {
            console.error(errors);
        }
    });
}
</script>

<template>

    <Head title="Edit a Product" />

    <AppLayout :breadcrumbs="[
        {
            title: `Edit a Product`,
            href: `/products/${props.product.id}/edit`,
        },
    ]">
        <div class="p-4">
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
                    <input type="text" v-model="form.description" name="description" id="description"
                        class="border p-2 rounded mb-4" />
                    <span class="text-sm text-red-600" x-if="form.errors.description">{{ form.errors.description
                        }}</span>
                </div>
                <Button type="submit" :disabled="form.processing">Create Product</Button>

            </form>
        </div>
    </AppLayout>
</template>
