<template>
  <div>
    <div v-if="!loading">
      <div v-if="data && data.length > 0">
        <slot></slot>
      </div>
      <h4 v-else v-html="placeholder" class="text-center text-red-600"></h4>
    </div>
    <div v-else class="flex text-gray-500 justify-center">
      <img src="/images/adcash-loading.svg" alt="loading....">
    </div>
  </div>
</template>

<script>
export default {
  props: ["data", "loading", "placeholder"]
};
</script>

<style>
</style>