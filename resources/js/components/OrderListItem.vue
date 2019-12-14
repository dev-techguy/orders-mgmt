<template>
  <tr>
    <td>{{ order.user.name }}</td>
    <td>{{ order.product.name }}</td>
    <td>{{ price }}</td>
    <td>{{ order.quantity }}</td>
    <td>{{ total }}</td>
    <td>{{ order.created_at }}</td>
    <td>
      <span class="text-green-500">
        <a class="cursor-pointer">Edit</a>
      </span> |
      <span class="text-red-500">
        <a class="cursor-pointer" @click="$emit('deleteItem', order)">Delete</a>
      </span>
    </td>
  </tr>
</template>

<script>
export default {
  props: ["order"],
  computed: {
    price() {
      return `${this.order.price} ${this.order.currency}`;
    },
    total() {
      return `${this.order.total} ${this.order.currency}`;
    }
  },
};
</script>

<style>
</style>