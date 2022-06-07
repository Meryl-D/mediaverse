<script async setup>
import { axiosClient } from "../utils/axios.js";
import { ref, watchEffect } from "vue";
import { user } from "../stores.js";
import router from '../router/index.js';




async function review() {
    const { datas } = await axiosClient.get('api/reviews');

    console.log(datas)
    //console.log(datas[0].created_at)
    
     return datas

}

const test = await review();
console.log(test)
</script>

<template>
    <h1>Vos reviews :</h1>
    <div id="#app">
        <ul>
            <li class="rating" v-for="data in datas" :key="data.something">{{ data }}</li>
            <li class="feedback"></li>
            <li class="dateCreation"></li>
            <li class="acronym"></li>
        </ul>

    </div>
</template>

