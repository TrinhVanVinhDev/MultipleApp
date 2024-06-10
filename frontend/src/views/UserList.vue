<template>
<!--    <ul role="list" class="divide-y divide-gray-100">-->
<!--        <li v-for="person in users.data" :key="person.email" class="flex justify-between gap-x-6 py-5">-->
<!--            <div class="flex min-w-0 gap-x-4">-->
<!--                <div class="min-w-0 flex-auto">-->
<!--                    <p class="text-sm font-semibold leading-6 text-gray-900">{{ person.name }}</p>-->
<!--                    <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ person.email }}</p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">-->
<!--                <button @click="showAddNewModal()">update</button>-->
<!--                |-->
<!--                <button @click="deleteUser(person)">delete</button>-->
<!--            </div>-->
<!--        </li>-->
<!--    </ul>-->
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="p-4">
                <div class="flex items-center">
                    <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-all-search" class="sr-only">checkbox</label>
                </div>
            </th>
            <th scope="col" class="px-6 py-3">
                Name
            </th>
            <th scope="col" class="px-6 py-3">
                Position
            </th>
            <th scope="col" class="px-6 py-3">
                Status
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="person in users.data" :key="person.email" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="w-4 p-4">
                <div class="flex items-center">
                    <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                </div>
            </td>
            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
<!--                <img class="w-10 h-10 rounded-full" src="#" alt="Jese image">-->
                <div class="ps-3">
                    <div class="text-base font-semibold">{{ person.name }}</div>
                    <div class="font-normal text-gray-500">{{ person.email }}</div>
                </div>
            </th>
            <td class="px-6 py-4">
                ###
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center">
                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                </div>
            </td>
            <td class="px-6 py-4">
                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" @click="showAddNewModal(person)">Edit</a>
                |
                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" @click="deleteUser(person)">Delete</a>
            </td>
        </tr>
        </tbody>
    </table>
    <userModal v-if="showUserModal" @close="onModalClose"/>
    <spinModal v-if="showSpin"/>
</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import router from "../router/index.js";
import store from "../store/index.js";
import userModal from "./UserModal.vue";
import spinModal from "./SpinModal.vue"

const users = computed(() => store.state.users);
const currentUserId = sessionStorage.getItem('userId');
const showUserModal = ref(false);
const showSpin = ref(false);

onMounted(() => {
    getUsers();
})
function getUsers() {
    store.dispatch('getUserList', {});
}

function deleteUser(user) {
    if(currentUserId.toString() === user.id.toString()) {
        alert(`You cannot delete yourself!`);
    } else {
        if (!confirm(`Are you sure you want to delete the product?`)) {
            return
        }
        store.dispatch('deleteUser', user.id)
            .then(res => {
                // TODO Show notification
                store.dispatch('getUserList')
            })
    }
}

function showAddNewModal(user) {
    showSpin.value = true;
    store.dispatch('getUser', user.id)
        .then(() => {
            showSpin.value = false;
            showUserModal.value = true;

        });
}

function onModalClose() {
    showUserModal.value = false
}
</script>

<style scoped>

</style>
