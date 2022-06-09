<script setup>
const props = defineProps({
  type: {
    type: String,
    default: "validate",
    required: true,
  },
});
//console.log(props.type);
</script>

<template>
  <button>
      <!-- insérer le contenu du parent -->
      <slot></slot>
  </button>
</template>

<style scoped>
button {
  color: var(--green)  ;
  background-color: var(--white);
  border: none;
  border-radius: 0.3em;
  box-shadow: var(--shadow);
  margin: 1em;
}

button:hover, button:active {
  color: var(--orange)  ;
}
</style>