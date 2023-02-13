<template>
    <form @submit.prevent="forgotPassword($event)" class="flex flex-col gap-5">
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
                    placeholder="test@test.com"
                />
            </div>
        </div>
        <button
            type="submit"
            class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
            Envoyer
        </button>
    </form>
</template>

<script setup>
//import { useUserStore } from "../stores/user";
import { onMounted } from "vue";
import { useRouter } from "vue-router";
import { ENTRYPOINT } from "../../config/entrypoint";

//const store = useUserStore();
const router = useRouter();
let token = localStorage.getItem("token");

async function forgotPassword(event) {
    const formData = new FormData(event.target);
    const response = await fetch(ENTRYPOINT + "/forgot-password", {
        method: "POST",
        body: formData,
    });
    const data = await response.json();
}

onMounted(() => {
    if (token) {
        router.push("/");
    }
});
</script>
