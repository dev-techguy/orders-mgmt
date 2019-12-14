<template>
  <div>
      <div v-if="data.length > 0"><slot></slot></div>
      <h4 v-else v-html="placeholder" class="text-center text-red-600"></h4>
  </div>
</template>

<script>
export default {
    props: ['data', 'placeholder']
}
</script>

<style>

</style>