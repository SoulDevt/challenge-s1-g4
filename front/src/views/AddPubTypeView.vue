<template>
    <form @submit.prevent="submit($event)" class="flex flex-col gap-5">
        <div>
            <label for="titre" class="block text-sm font-medium text-white"
                >Titre</label
            >
            <div class="mt-1">
                <input
                    type="text"
                    name="title"
                    id="email"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="test"
                />
            </div>
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-white"
                >Description</label
            >
            <div class="mt-1">
                <input
                    type="textarea"
                    name="description"
                    id="name"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="johndoe"
                />
            </div>
        </div>
        <div>
            <label for="prix" class="block text-sm font-medium text-white"
                >Prix</label
            >
            <div class="mt-1">
                <input
                    type="number"
                    name="price"
                    id="password"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
            </div>
        </div>
        <div>
            <label for="image" class="block text-sm font-medium text-white"
                >Image</label
            >
            <div class="mt-1">
                <input
                    type="text"
                    name="image"
                    id="password"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
            </div>
        </div>
        <div>
            <label for="liens" class="block text-sm font-medium text-white"
                >Liens</label
            >
            <div class="mt-1">
                <input
                    type="text"
                    name="liens"
                    id="password"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
            </div>
        </div>
        <div>
            <label for="tags" class="block text-sm font-medium text-white"
                >Tags</label
            >
            <div class="mt-1">
                <input
                    type="text"
                    name="tags"
                    id="password"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
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
import { useUserStore } from "../stores/annonces";
import jwtDecode from "jwt-decode";

async function submit(event) {
    let token = localStorage.getItem('token')
    let decoded = jwtDecode(token);
    let author = decoded.id;
    console.log(author)
    const formData = new FormData(event.target);
     const store = useUserStore();
     await store.addAnnonce(
         formData.get("title"),
         formData.get("description"),
         parseInt(formData.get("price")),
         formData.get("image"),
         formData.get("liens"),
         formData.get("tags"),
         author
     );
}
</script>
