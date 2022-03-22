<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { useForm } from "@inertiajs/inertia-vue3";

let form = useForm({
  title: '',
  description: '',
  date: '',
});

let submit = () => {
  form.post('/todo-lists');
};

</script>

<template>
    <Head title="Create - Todo List" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create TODO List
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit" class="max-w-md mx-auto mt-8">
                            <div class="mb-6">
                                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name"> Title </label>
                                <input v-model="form.title" class="border border-gray-400 p-2 w-full" type="text" name="title" id="title" required />
                                <div v-if="form.errors.title" v-text="form.errors.title" class="text-red-500 text-xs mt-1"></div>
                            </div>

                            <div class="mb-6">
                                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="description"> Description </label>
                                <textarea v-model="form.description" required />
                                <div v-if="form.errors.description" v-text="form.errors.description" class="text-red-500 text-xs mt-1"></div>
                            </div>

                             <div class="mb-6">
                                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name"> Date </label>
                                <input v-model="form.date" class="border border-gray-400 p-2 w-full" type="date" name="date" id="date" required />
                                <div v-if="form.errors.date" v-text="form.errors.date" class="text-red-500 text-xs mt-1"></div>
                            </div>

                            <div class="mb-6">
                            <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" :disabled="form.processing">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
