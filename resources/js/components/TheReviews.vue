<script async setup>
import { axiosClient } from "../utils/axios.js";
import { ref, watchEffect } from "vue";
import { user } from "../stores.js";
import router from '../router/index.js';




async function review() {
    const { data } = await axiosClient.get('api/reviews');
    //console.log(data)
    //console.log(datas[0].created_at)

    return data

}

const reviews = await review();
console.log(reviews)

</script>

<template>
    <h1>Vos reviews :</h1>
    <div>
        <ul v-for="review in reviews" :key="review.id">
            
                <div>Cours : {{ review.course.acronym }}</div>
                <div>Note : {{ review.rating}}</div>
                <div>Feedback : {{ review.feedback }}</div>
           
        </ul>

    </div>
</template>

