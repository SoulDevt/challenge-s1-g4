<template>
    <div v-if="type === 'vendeur' && accepted !== true && accepted !== false">
        <div className="border-2 border-black">
            <h1 className="text-center">Demande annonceur {{ id }}</h1>
            <div className="p-2">
                <p className="my-auto" hidden>{{ type }}</p>
                <p className="my-auto">Nom : {{ lastname }}</p>
                <p className="my-auto">Prénom : {{ firstname }}</p>
                <p className="my-auto"> Adresse : {{ adress }}</p>
                <p className="my-auto">Code postal : {{ postalcode }}</p>
                <p className="my-auto">Tél : {{ phonenumber }}</p>
                <p className="my-auto"> : {{ whoUser }}</p>
                <div className="grid grid-cols-1">
                    <button @click="updateUser(id, whoUser)">Accepter</button>
                    <button @click="updateDemands(id, false)">Refuser</button>
                </div>

            </div>
        </div>
    </div>
</template>
<script setup>

import { ENTRYPOINT } from "../../config/entrypoint";

const props = defineProps(['id', 'type', 'firstname', 'lastname', 'adress', 'postalcode', 'phonenumber', 'accepted', 'whoUser'])

async function updateUser(id, whoUser) {
    const requestOptions = {
        method: "PATCH",
        headers: { "Content-Type": "application/merge-patch+json" },
        body: JSON.stringify({
            roles: [
                "ROLE_USER",
                "ROLE_ANNONCEUR"
            ],
        })
    };
    const response = await fetch(ENTRYPOINT + `/users/` + whoUser.substr(11), requestOptions);
    const data = await response.json();
    if (data.id) {
        updateDemands(id, true);
    }
}

async function updateDemands(id, status) {
    const requestOptions = {
        method: "PATCH",
        headers: { "Content-Type": "application/merge-patch+json" },
        body: JSON.stringify({
            accepted: status
        })
    };
    const response = await fetch(ENTRYPOINT + `/demandes/` + id, requestOptions);
    const data = await response.json();
    if (data.id) {
        alert("La demande a bien été traitée !");
        window.location.reload();
    }
}

</script>
