<template>
  <div>
      <new-order></new-order>
      <orders></orders>
  </div>
</template>

<script>
import NewOrder from './NewOrder';
import Orders from './Orders';
export default {
    components: {NewOrder, Orders}
}
</script>

<style>

</style>