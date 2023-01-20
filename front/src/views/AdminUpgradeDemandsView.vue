<template>
    <div v-for="demande in demandes">
        {{ demande.type }}
        {{ demande.firstname }}
        {{ demande.lastame }}
        {{ demande.adress }}
        {{ demande.postalcode }}
        {{ demande.phonenumber }}
    </div>
</template>
<script setup>
import { ENTRYPOINT } from "../../config/entrypoint";

import { ref, onBeforeMount } from 'vue';

const demandes = ref([]);

async function getData() {
    const requestOptions = {
        method: "GET",
        headers: { "Content-Type": "application/json" }
    };
    const response = await fetch(ENTRYPOINT + `/demandes`, requestOptions);
    const finalRes = await response.json();
    demandes.value = finalRes['hydra:member'];
    console.log(demandes.value);
}
onBeforeMount(() => getData());
</script>
