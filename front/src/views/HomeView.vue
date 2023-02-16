<template>
    <main>
        <h1 class="text-2xl">Bienvenue sur Le Bon Côté !</h1>
        <div>
            <div>
                <button @click="goTo('/annonces')"> Voir les annonces !</button>
                <button @click="goTo('/upgrade-vendor')"> Demander à être annonceur !</button>
            </div>
        </div>
    </main>
</template>

<script setup>

import { useRouter } from 'vue-router';

const router = useRouter();

async function goTo(url) {
    router.push(url);
}
</script>
