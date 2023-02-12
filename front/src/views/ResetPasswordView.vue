<template>
    <form @submit.prevent="resetPassword($event)" class="flex flex-col gap-5">
        <label for="password1" class="block text-sm font-medium text-white"
            >Mot de passe</label
        >
        <div class="mt-1">
            <input
                type="password"
                name="password1"
                id="password1"
                v-model="password1"
                class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            />
        </div>
        <label for="password2" class="block text-sm font-medium text-white"
            >Confirmation du mot de passe</label
        >
        <div class="mt-1">
            <input
                type="password"
                name="password2"
                id="password2"
                v-model="password2"
                class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            />
        </div>
        <button
            type="submit"
            class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Réinitialiser le mot de passe
        </button>
    </form>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useRouter, useRoute } from "vue-router";
import { ENTRYPOINT } from "../../config/entrypoint";

const password1 = ref("");
const password2 = ref("");

const router = useRouter();
const route = useRoute();
const token = route.params.token;

onMounted(async () => {
    if (token) {
        const response = await fetch(ENTRYPOINT + "/forgot-password/" + token, {
            method: "GET",
        });
        if (response.ok) {
            console.log("ok");
        } else {
            console.log("not ok");
            await router.push("/forgot-password");
        }
    } else {
        await router.push("/forgot-password");
    }
});

async function resetPassword(event) {
    if (password1.value !== password2.value) {
        console.error("Les mots de passe ne correspondent pas");
        return;
    }
    const response = await fetch(ENTRYPOINT + "/forgot-password/" + token, {
        method: "POST",
        body: JSON.stringify({
            password: password1.value,
        }),
    });
    const data = await response.json();
    if (response.ok) {
        await router.push("/login");
    } else {
        console.error(data);
    }
}
</script>
