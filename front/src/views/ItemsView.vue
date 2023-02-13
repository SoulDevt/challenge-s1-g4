<template>
    <div class="allItems">
        <div class="left">
            <img :src="item.images[0].filePath" alt="image" />
        </div>
        <div class="right">
            <h1>{{ item.title }}</h1>
            <p>{{ item.price }}€</p>
            <p>{{ item.description }}</p>
            <p>{{ item.name }}</p>
            <button v-if="item.isOwner" @click="showPopup">Supprimer mon annonce</button>
        </div>

        <div v-if="item.isOwner">
            <div class="bg_deletePopup" @click="showPopup"></div>
            <div class="deletePopup">
                <p>Voulez vous vraiment supprimer votre annone ?</p>
                <button @click="deleleteItem">Oui</button>
                <button @click="showPopup">Non</button>
            </div>
        </div>
    </div>
    <div>
        <button @click="buy"
            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Pay now!
        </button>
    </div>
</template>

<script setup>
import jwtDecode from "jwt-decode";
import { onBeforeMount, ref, reactive, toRaw } from "vue";
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
let token = localStorage.getItem("token");
let decodedToken = '';

const getItem = async () => {
    const response = await fetch(ENTRYPOINT + "/items/" + route.params.id);
    const data = await response.json();
    item.value = data;
    if (token === null || token === undefined || token === "") {
    } else {
        decodedToken = jwtDecode(token);
        const owner = await fetch(toRaw(item.value.itemOwner));
        const ownerItem = await owner.json();
        item.value.name = ownerItem.name;
        item.value.email = ownerItem.email;
        item.value.mediaObjectId = data.images[0]["@id"];
        lineItems[0].price = data["stripe_price_id"];
        if (decodedToken.username === ownerItem.email) {
            item.value.isOwner = true;
        } else {
            item.value.isOwner = false;
        }
    }
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


function showPopup() {
    const popup = document.querySelector(".deletePopup");
    const bgPopup = document.querySelector(".bg_deletePopup");
    popup.classList.toggle("showDeletePopup");
    bgPopup.classList.toggle("show_bg_deletePopup");
    document.body.classList.toggle("hideOverflow");
}

async function deleleteItem() {
    const r = await fetch(item.value.mediaObjectId, {
        method: "DELETE",
        headers: {
            Authorization: "Bearer " + token,
        },
    }).then(function () {
        fetch(ENTRYPOINT + "/items/" + route.params.id, {
            method: "DELETE",
            headers: {
                Authorization: "Bearer " + token,
            },
        });
    })
    .then(function () {
        window.location.href = "/";
    });
}



</script>

<style>
.allItems {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin: 0 auto;
    width: 80%;
}

.left,
.right {
    width: 50%;
}

.left>img {
    width: 100%;
}

.showDeletePopup {
    display: block !important;
}

.deletePopup {
    display: none;
    position: absolute;
    width: 100%;
    left: 0;
    text-align: center;
    background: white;
    color: black;
    padding: 2em;
}

.deletePopup>button {
    margin: 1em;
}

.deletePopup>button:nth-child(2) {
    background: red;
    padding: 5px;
    padding-left: 1em;
    padding-right: 1em;
    color: white;
    border-radius: 12px;
}

.deletePopup>button:nth-child(3) {
    background: green;
    padding: 5px;
    padding-left: 1em;
    padding-right: 1em;
    color: white;
    border-radius: 12px;
}

.show_bg_deletePopup {
    display: block !important;
}

.bg_deletePopup {
    display: none;
    position: fixed;
    height: 100%;
    width: 100%;
    background-color: rgb(0, 0, 0, 0.5);
    top: 0;
    left: 0;
}

.hideOverflow {
    overflow: hidden;
}
</style>
