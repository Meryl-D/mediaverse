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
  <button >
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
  box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;
}
button:hover {
  color: var(--white)  ;
  background-color: var(--orange);
}
button:active {
  color: var(--white)  ;
  background-color: var(--orange);
}
</style>