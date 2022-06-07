import TheSchedule from './components/TheSchedule.vue';
import TheResults from './components/TheResults.vue';
import TheAbsences from './components/TheAbsences.vue';
import TheAccount from './components/TheAccount.vue';
import TheLoginForm from './components/subComponents/TheLoginForm.vue';

export const routes = {
    '#login' : {
        name : 'Login',
        meta: {
            requiresAuth : false
        },
        component : TheLoginForm
    },
    '#horaires' : {
        name : 'Horaires',
        meta : {
            requiresAuth : true
        },
        component : TheSchedule
    },
    '#compte' : {
        name : 'Compte',
        meta : {
            requiresAuth : true
        },
        component : TheAccount
    },
    '#notes' : {
        name : 'Notes',
        meta : {
            requiresAuth : true
        },
        component : TheResults
    },
    '#absences' : {
        name : 'Absences',
        meta : {
            requiresAuth : true
        },
        component : TheAbsences
    }
};