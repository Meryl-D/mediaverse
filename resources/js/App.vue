<script setup>
     import {ref} from 'vue';

	const message = ref('hello from vue');
	const message2 = ref(data);

	fetch('/api/test').then(
		resp => resp.json()
	).then(
		test => console.log(test)
	)
</script>


<template>
    <h1>
        {{message}}
    </h1>
    <h2>
         {{message2}}
    </h2>
</template>