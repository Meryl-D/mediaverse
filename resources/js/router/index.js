import { createRouter, createWebHistory } from "vue-router";
import { user } from './../stores.js';
import TheSchedule from '../components/TheSchedule.vue';
import TheResults from '../components/TheResults.vue';
import TheAbsences from '../components/TheAbsences.vue';
import TheAccount from '../components/TheAccount.vue';
import TheReviews from '../components/TheReviews.vue';
import TheLogin from '../components/TheLogin.vue';
import TheTasks from '../components/subComponents/TheTasks.vue';



const routes = [
    {
        path : '/login',
        name : 'Login',
        meta: {
            requiresAuth : false
        },
        component : TheLogin
    },
    {
        path : '/',
        name : 'Horaires',
        meta : {
            requiresAuth : true
        },
        component : TheSchedule
    },
    {
        path : '/compte',
        name : 'Compte',
        meta : {
            requiresAuth : true
        },
        component : TheAccount
    },
    {
        path : '/notes',
        name : 'Notes',
        meta : {
            requiresAuth : true
        },
        component : TheResults
    },
    {
        path : '/reviews',
        name : 'Reviews',
        meta : {
            requiresAuth : true
        },
        component : TheReviews
    },
    {
        path : '/absences',
        name : 'Absences',
        meta : {
            requiresAuth : true
        },
        component : TheAbsences
    },
    {
        path : '/tasks',
        name : 'Tasks',
        meta : {
            requiresAuth : true
        },
        component : TheTasks
    }
];

const router = createRouter({
    history : createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !user.value.token) {
        next({ name : 'Login' });
    } else {
        next();
    }
})

export default router;