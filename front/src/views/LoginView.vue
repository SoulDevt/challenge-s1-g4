<template>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form
                    @submit.prevent="login($event)"
                    class="flex flex-col gap-5"
                >
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <label
                                        for="email-address"
                                        class="block text-sm font-medium text-gray-700"
                                        >Email address</label
                                    >
                                    <input
                                        style="color:black;"
                                        type="email"
                                        name="email"
                                        id="email"
                                        autocomplete="email"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    />
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label
                                        for="email-address"
                                        class="block text-sm font-medium text-gray-700"
                                        >Password</label
                                    >
                                    <input
                                        style="color:black;"
                                        type="password"
                                        name="password"
                                        id="password"
                                        autocomplete="email"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    />
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
                </form>
            </div>
        </div>
    </div>

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
