<script setup>

</script>

<template>
  <div>
    <!-- insérer le contenu du parent -->
    <slot></slot>
  </div>
</template>

<style scoped>
div {
  display: flex;
  background-color: var(--white);
  border: none;
  border-radius: 0.3em;
  box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;
}
</style>