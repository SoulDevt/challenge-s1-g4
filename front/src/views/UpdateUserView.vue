<template>
    <form @submit.prevent="updateUser($event)" class="flex flex-col gap-5">
        <div>
            <label for="email" class="block text-sm font-medium text-white"
                >Email</label
            >
            <div class="mt-1">
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="you@example.com"
                />
            </div>
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-white"
                >Name</label
            >
            <div class="mt-1">
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="johndoe"
                />
            </div>
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-white"
                >Password</label
            >
            <div class="mt-1">
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
            </div>
        </div>
        <button
            type="submit"
            class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
            Update User
        </button>
    </form>
</template>

<script setup>
import { useUserStore } from "../stores/user";
import { useRoute } from 'vue-router';
import { ref } from "vue";
const route = useRoute();
const idUser = ref(null)
idUser.value = route.params.id


    async function updateUser(event) {
        const formData = new FormData(event.target);
        const store = useUserStore();
        await store.updateUser(
            formData.get("email"),
            formData.get("name"),
            formData.get("password"),
            idUser.value
        );
        console.log(store.token);
    }

</script>
