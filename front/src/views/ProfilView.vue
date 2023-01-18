<template>
    <form @submit.prevent="getUser($event)" class="flex flex-col gap-5">
        <div>
            <label for="email" class="block text-sm font-medium text-white"
                >Email</label
            >
            <div class="mt-1">
                <p>YOUR EMAIL</p>
            </div>
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-white"
                >Password</label
            >
            <div class="mt-1">
                <p>YOUR PASSWORD</p>
            </div>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-white"
                >Name</label
            >
            <div class="mt-1">
                <p>YOUR NAME</p>
            </div>
        </div>
        <button
            type="submit"
            class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
            Modifier
        </button>
    </form>
</template>

<script setup>
import { useUserStore } from "../stores/user";
import jwtDecode from "jwt-decode";

async function getUser(event) {


}
</script>
