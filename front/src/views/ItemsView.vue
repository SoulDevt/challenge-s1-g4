<template>
    <div class="allItems">
        <div class="left">
            <img :src="item.images[0].filePath" alt="image" />
        </div>
        <div class="right">            
            <h1>{{item.title}}</h1>
            <p>{{item.price}}€</p>
            <p>{{item.description}}</p>
        </div>
        
    </div>

</template>

<script setup>
import { onBeforeMount, ref } from "vue";
import {ENTRYPOINT} from "../../config/entrypoint";
import { useRoute } from "vue-router";



const item = ref([]);
const route = useRoute();
const getItem = async () => {
    const response = await fetch(
        ENTRYPOINT + "/items/" + route.params.id
    );
    const data = await response.json();
    item.value = data;
    console.log(data);
};

onBeforeMount(getItem);

async function buyItem() {
    console.log('test');
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

    .left > img {
        width: 100%;
    }
</style>

