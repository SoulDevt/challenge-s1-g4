<template>
    <div v-for="auction in auctions">
        {{ auction.id }}
        {{ auction.creator }}
        {{ auction.startPrice }}
        {{ auction.actualPrice }}
        {{ auction.endAt }}
    </div>
    <h2>===========================================</h2>
    <form @submit.prevent="addNewAuction($event)">
        <div>
            <label for="startPrice" class="block text-sm font-medium">Start Price</label>
            <div class="mt-1">
                <input type="text" name="startPrice" id="startPrice"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Prix de départ" />
            </div>
        </div>
        <div>
            <label for="endAt" class="block text-sm font-medium">End At</label>
            <div class="mt-1">
                <input type="date" name="endAt" id="endAt"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Date de fermeture" />
            </div>
        </div>
        <button type="submit"
            class="mt-2 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Enregistrer
        </button>
    </form>
</template>
<script setup>

import { ENTRYPOINT } from "../../config/entrypoint";

import { ref, onBeforeMount } from 'vue';
import jwtDecode from "jwt-decode";

const auctions = ref([]);

async function getData() {
    const requestOptions = {
        method: "GET",
        headers: { "Content-Type": "application/json" }
    };
    const response = await fetch(ENTRYPOINT + `/auctions`, requestOptions);
    const finalRes = await response.json();
    auctions.value = finalRes['hydra:member'];
    console.log(auctions.value);
}
onBeforeMount(() => getData());

async function addNewAuction(event) {
    const formData = new FormData(event.target);
    let decoded = jwtDecode(localStorage.getItem("token"));
    // PUT request using fetch with async/await
    const requestOptions = {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            creator: `api/users/${decoded.id}`,
            endAt: formData.get("endAt"),
            startPrice: parseFloat(formData.get("startPrice")),
            actualPrice: null
        })
    };
    const response = await fetch(ENTRYPOINT + `/auctions`, requestOptions);
    const data = await response.json();
    if (data.id) {
        alert("L'enchère a bien été créée !");
    }
}
</script>
