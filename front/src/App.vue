<script setup>
import { RouterView } from "vue-router";
import NavBar from "./components/NavBar.vue";

console.log(import.meta.env.VITE_STRIPE_PUBLIC_KEY);
</script>

<template>
    <NavBar />
    <RouterView />
</template>
