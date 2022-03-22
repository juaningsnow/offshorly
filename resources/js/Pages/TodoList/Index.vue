<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Pagination from '../../Common/Pagination';
import { useForm } from "@inertiajs/inertia-vue3";

let props = defineProps({
  todoLists: Object,
  filters: Object,
});

let form = useForm({});

let deleteItem = (id) => {
  form.delete(`/todo-lists/${id}`);
};

</script>

<template>
    <Head title="Todo List" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                TODO List
            </h2>
            <Link href="/todo-lists/create" class="text-sm ml-3">
            <button class="px-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"> New TODO List</button>
            </Link>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-4 whitespace-nowrap text-left">Title</th>
                                    <th class="px-6 py-4 whitespace-nowrap text-left">Description</th>
                                    <th class="px-6 py-4 whitespace-nowrap text-left">Date</th>
                                    <th class="px-6 py-4 whitespace-nowrap text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="todo in todoLists.data" :key="todo.id">
                                <td class="px-6 py-4 whitespace-nowrap text-left">
                                        {{ todo.title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-left">
                                        {{ todo.description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-left">
                                        {{ todo.date }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <Link :href="`/todo-lists/${todo.id}/edit`" class="text-indigo-600 hover:text-indigo-900">
                                <button class="px-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                 Edit</button></Link>
                                <button class="px-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" @click="deleteItem(todo.id)">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">
                                        <Pagination :links="todoLists.links" class="mt-6" />
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
