<template>
    <h1>Ajout d'une enchere</h1>
    <form @submit.prevent="addNewEnchere($event)">
        <div>
            <label for="title" class="block text-sm font-medium text-white">Titre</label>
            <div class="mt-1">
                <input type="text" name="title" id="title"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
            <label for="price" class="block text-sm font-medium text-white">Prix de départ</label>
            <div class="mt-1">
                <input type="number" name="price" id="price"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
            <label for="date" class="block text-sm font-medium text-white">Date de début</label>
            <div class="mt-1">
                <input type="date" name="datestart" id="datestart"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
            <label for="date" class="block text-sm font-medium text-white">Date de fin</label>
            <div class="mt-1">
                <input type="date" name="dateend" id="dateend"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
            </div>
            <button type="submit"
                class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Ajouter
            </button>
        </div>
    </form>
</template>


<script setup>
import { ENTRYPOINT } from "../../config/entrypoint";
import jwtDecode from "jwt-decode";
let isAdmin = false;
let token = localStorage.getItem("token");
let decoded = jwtDecode(token);

if (decoded.roles.includes("ROLE_ADMIN")) {
    isAdmin = true;
} else {
    window.location.href = "/";
}

async function addNewEnchere(event) {

    const titre = event.target.title.value;
    const prix = event.target.price.value;
    const dateDebut = new Date(event.target.datestart.value);
    const dateFin = new Date(event.target.dateend.value);

    const addEnchere = await fetch(ENTRYPOINT + "/bids", {
        method: "POST",
        headers: {
            Authorization: "Bearer " + token,
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            name: titre,
            dateFin: dateFin,
            minPrice: parseInt(prix),
            dateDebut: dateDebut,
        }),
    });
    if (addEnchere.ok) {
        await router.push("/annonces");
    }
}
</script>>
