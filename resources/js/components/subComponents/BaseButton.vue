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
  color:#F9A228;
  background-color: #FFFCFA;
  border-color: #F9A228;
  border: 1em;
  border-radius: 25rem;
}
</style>