<template>

    <form @submit.prevent="login($event)" class="flex flex-col gap-5">
        <div>
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <div class="shadow sm:overflow-hidden sm:rounded-md">
                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500"
                                            >Email</span
                                        >
                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            placeholder="www.example.com"
                                        />
                                    </div>

                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500"
                                            >Mot de passe</span
                                        >
                                        <input
                                            type="password"
                                            name="password"
                                            id="password"
                                            class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            placeholder="www.example.com"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button
                                type="submit"
                                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                Login
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <RouterLink to="/forgot-password">Mot de passe oublié ?</RouterLink>
</template>

<script setup>
import { useUserStore } from "../stores/user";
import jwtDecode from "jwt-decode";
import ProfilViewVue from "./ProfilView.vue";

async function login(event) {
    const formData = new FormData(event.target);
    const store = useUserStore();
    await store.login(formData.get("email"), formData.get("password"));
    let decoded = jwtDecode(store.token);
    localStorage.setItem("token", store.token);
    if (decoded.roles.includes("ROLE_ADMIN")) {
        window.location.href = "/admin";
    } else {
        window.location.href = `/profile/${decoded.id}`;
    }
}
</script>
