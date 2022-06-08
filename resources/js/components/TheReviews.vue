<script async setup>
import { axiosClient } from "../utils/axios.js";
import { ref, watchEffect } from "vue";
import { user } from "../stores.js";
import router from '../router/index.js';
import { createApp } from 'vue';

// Quelques fonctions utilitaires
function domForEach(selector, callback) {
    document.querySelectorAll(selector).forEach(callback);
}
function domOn(selector, event, callback, options) {
    document.querySelectorAll(selector).forEach(element => element.addEventListener(event, callback, options));
}

const student = true;
const teacher = false;

// pour les profs 
async function reviewTeacher() {
    const { data } = await axiosClient.get('api/reviews');
    //console.log(data)
    //console.log(datas[0].created_at)

    return data

}
const reviews = await reviewTeacher();
console.log(reviews)


//pour les students
async function reviewStudent() {
    const { data } = await axiosClient.get('api/reviews/create');
    //console.log(dataStudent)
    //console.log(datas[0].created_at)

    return data

}
const reviewsPossibles = await reviewStudent();
console.log(reviewsPossibles)

 function test() {
    console.log(select.selectedIndex)
     console.log("3")
 }


</script>

<template>
    <div v-show="teacher">
        <h1>Vos reviews :</h1>
        <ul v-for="review in reviews" :key="review.id">

            <div>Cours : {{ review.course.acronym }}</div>
            <div>Note : {{ review.rating }}</div>
            <div>Feedback : {{ review.feedback }}</div>
        </ul>
    </div>


    <div v-show="student">
        <h1>Saisir une review :</h1>
        <select @change="test()">
            <option>Sélectionnez un cours</option>
            <option  v-for="reviewPossible in reviewsPossibles" :key="reviewPossible" :class="reviewPossible">
                {{ reviewPossible }} </option>
        </select>
    </div>
</template>

