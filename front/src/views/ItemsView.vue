<template>
    <div class="allItems">
        <div class="left">
            <img :src="item.images[0].filePath" alt="image" />
        </div>
        <div class="right">
            <h1>{{ item.title }}</h1>
            <p>{{ item.price }}</p>
            <p>{{ item.description }}</p>
        </div>
    </div>
    <div>
        <button
            @click="buy"
            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
            Pay now!
        </button>
    </div>
</template>

<script setup>
import { onBeforeMount, ref, reactive } from "vue";
import { ENTRYPOINT } from "../../config/entrypoint";
import { useRoute } from "vue-router";
import { loadStripe } from "@stripe/stripe-js";

const publishableKey = import.meta.env.VITE_STRIPE_PUBLIC_KEY;
const stripePromise = loadStripe(publishableKey);
const successURL = `https://${window.location.host}/success`;
const cancelURL = `https://${window.location.host}/cancel`;
const item = ref([]);
const lineItems = reactive([
    {
        price: "",
        quantity: 1,
    },
]);
const route = useRoute();
const getItem = async () => {
    const response = await fetch(ENTRYPOINT + "/items/" + route.params.id);
    const data = await response.json();
    item.value = data;
    lineItems[0].price = data["stripe_price_id"];
};

async function buy() {
    const stripe = await stripePromise;
    const { error } = await stripe.redirectToCheckout({
        mode: "payment",
        lineItems: lineItems,
        successUrl: successURL,
        cancelUrl: cancelURL,
    });
    if (error) {
        console.error("Error:", error);
    }
}

onBeforeMount(getItem);
</script>

<style>
.allItems {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin: 0 auto;
    width: 80%;
}
</style>
