<template>
    <div className="grid gap-4 grid-cols-3 grid-rows-3 mt-2">
        <DemandsItem v-for="demande in demandes" :key="demande.id" :whoUser="demande.whoUser" :id="demande.id"
            :type="demande.type" :firstname="demande.firstname" :lastname="demande.lastname" :adress="demande.adress"
            :postalcode="demande.postalcode" :phonenumber="demande.phonenumber" :accepted="demande.accepted" />
        <h1 v-if="demandes.length === 0">Aucune demande pour le moment !</h1>
    </div>

</template>
<script setup>
import { ENTRYPOINT } from "../../config/entrypoint";

import { ref, onBeforeMount } from 'vue';
import DemandsItem from "../components/DemandsItem.vue";
import jwtDecode from "jwt-decode";
import { useRouter } from "vue-router";

const router = useRouter();
const demandes = ref([]);

let decoded = jwtDecode(localStorage.getItem("token"));
if (decoded.roles.includes("ROLE_ADMIN") === false) {
    router.push("/");
}

async function getData() {
    const requestOptions = {
        method: "GET",
        headers: { "Content-Type": "application/json" }
    };
    const response = await fetch(ENTRYPOINT + `/demandes`, requestOptions);
    const finalRes = await response.json();
    demandes.value = finalRes['hydra:member'];
}
onBeforeMount(() => getData());
</script>
