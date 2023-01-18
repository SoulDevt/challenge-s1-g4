<template>
    <h1>Ajout d'une annonce</h1>
    <form @submit.prevent="addNewAnnonce($event)">
        <div>
            <label for="title" class="block text-sm font-medium text-white"
            >Titre</label
            >
            <div class="mt-1">
                <input
                    type="text"
                    name="title"
                    id="title"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
            </div>
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-white"
            >Description</label
            >
            <div class="mt-1">
                <textarea name="description" id="description" class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
            </div>
        </div>
        <div>
            <label for="price" class="block text-sm font-medium text-white"
            >Prix</label
            >
            <div class="mt-1">
                <input
                    type="number"
                    name="price"
                    id="price"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
            </div>
        </div>
        <div>
            <label for="pictures" class="block text-sm font-medium text-white"
            >images</label
            >
            <div class="mt-1">
                <input
                    type="file"
                    name="pictures"
                    id="pictures"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    multiple="multiple"
                />
            </div>
        </div>
        <button
            type="submit"
            class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
            Register
        </button>
    </form>
</template>

<script setup>

import {useUserStore} from "../stores/user";
import {ENTRYPOINT} from "../../config/entrypoint";

async function addNewAnnonce(event) {
    const formData = new FormData(event.target);
    const response = await fetch(`${ENTRYPOINT}/items`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            title: formData.get('title'),
            price: parseInt(formData.get('price')),
            description: formData.get('description'),
            pictures: [event.target.pictures.files],
        }),
    });
    const data = await response.json();
    if (response.status === 201) {
        // window.location.href = '/annonces';
        console.log(data);
    } else {
        console.log('ERROR');
    }

}

</script>
