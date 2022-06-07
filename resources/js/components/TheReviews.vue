<!-- <script setup>
import { axiosClient } from "../../utils/axios.js";
import { ref, watchEffect } from "vue";
import { user } from "../../stores.js";
import router from '../../router/index.js';


const creds = {
  email : '',
  password : ''
}

async function login() {
  await axiosClient.get('/sanctum/csrf-cookie');
  const { data } = await axiosClient.post('api/login', creds);

  user.value={
    id : data.id,
    firstName : data.firstName,
    lastName : data.lastName,
    token : data.token,
  };
  // window.location.hash='#horaires';
}

async function submitForm() {
  await login();
  router.push({
    name : 'Horaires'
  })
}
</script> -->

