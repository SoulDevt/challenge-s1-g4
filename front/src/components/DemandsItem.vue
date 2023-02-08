<script setup>

import { ref } from 'vue'

const props = defineProps(['type', 'firstname', 'lastname', 'adress', 'postalcode', 'phonenumber', 'accepted'])

</script>

<template>
    <div v-if="type === 'vendeur' && !accepted">
        <div className="border-2 border-black">
            <h1 className="text-center">Demande annonceur</h1>
            <div className="p-2">
                <p className="my-auto" hidden>{{ type }}</p>
                <p className="my-auto">Nom : {{ lastname }}</p>
                <p className="my-auto">Prénom : {{ firstname }}</p>
                <p className="my-auto"> Adresse : {{ adress }}</p>
                <p className="my-auto">Code postal : {{ postalcode }}</p>
                <p className="my-auto">Tél : {{ phonenumber }}</p>
                <div className="grid grid-cols-1">
                    <button>Accepter</button>
                    <button>Refuser</button>
                </div>

            </div>
        </div>
    </div>
</template>
