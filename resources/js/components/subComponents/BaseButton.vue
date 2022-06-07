<script setup>
const props = defineProps({
  type: {
    type: String,
    default: "validate",
    required: true,
  },
});
console.log(props.type);
</script>

<template>
  <button >
      <!-- insérer le contenu du parent -->
      <slot></slot>
  </button>
</template>

<style scoped>
button {
  color: var(--orange)  ;
  background-color: var(--white);
  border-color:var(--orange);
  border:solid 0.2em;
  border-radius: 0.5rem;
}
</style>