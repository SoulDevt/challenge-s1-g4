<template>
    <form @submit.prevent="askUpgradeVendor($event)" class="flex flex-col gap-5">
        <div>
            <label for="lastname" class="block text-sm font-medium text-white">Nom</label>
            <div class="mt-1">
                <input type="text" name="lastname" id="lastname"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Nom" />
            </div>
        </div>
        <div>
            <label for="firstname" class="block text-sm font-medium text-white">Prénom</label>
            <div class="mt-1">
                <input type="text" name="firstname" id="firstname"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Prénom" />
            </div>
        </div>
        <div>
            <label for="adress" class="block text-sm font-medium text-white">Adresse</label>
            <div class="mt-1">
                <input type="text" name="adress" id="adress"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Adresse" />
            </div>
        </div>
        <div>
            <label for="cp" class="block text-sm font-medium text-white">Code postale</label>
            <div class="mt-1">
                <input type="text" name="cp" id="cp"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Code postale" />
            </div>
        </div>
        <div>
            <label for="tel" class="block text-sm font-medium text-white">N° de Téléphone</label>
            <div class="mt-1">
                <input type="tel" name="tel" id="tel"
                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="N° de Téléphone" />
            </div>
        </div>
        <button type="submit"
            class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Envoyer la demande
        </button>
    </form>
</template>

<script setup>

import { ENTRYPOINT } from "../../config/entrypoint";
import jwtDecode from "jwt-decode";

async function askUpgradeVendor(event) {
    const formData = new FormData(event.target);
    let decoded = jwtDecode(localStorage.getItem("token"));
    // PUT request using fetch with async/await
    const requestOptions = {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            whoUser: `api/users/${decoded.id}`,
            type: "vendeur",
            firstname: formData.get("firstname"),
            lastname: formData.get("lastname"),
            adress: formData.get("adress"),
            postalcode: formData.get("cp"),
            phonenumber: formData.get("tel")
        })
    };
    const response = await fetch(ENTRYPOINT + `/demandes`, requestOptions);
    const data = await response.json();
    if (data.id) {
        alert("Votre demande a bien été prise en compte");
    }
}
</script>
