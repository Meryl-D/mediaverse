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
  border-radius: var(--small-radius);
  box-shadow: var(--shadow);
  padding: .3rem .9rem;
}

button:hover, button:active {
  color: var(--orange)  ;
}
</style>