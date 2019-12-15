<template>
  <tr>
    <td>{{ order.user.name }}</td>
    <td>{{ order.product.name }}</td>
    <td>{{ price }}</td>
    <td @dblclick="editMode = true">
      <span v-if="!editMode">{{ order.quantity }}</span>
      <input
        type="number"
        class="form-input w-16 h-6"
        v-if="editMode"
        v-model="order.quantity"
        @keydown.esc="editMode = false"
        min="1"
        autofocus
      />
    </td>
    <td>{{ total }}</td>
    <td>{{ order.created_at }}</td>
    <td>
      <span v-if="!editMode">
          <a class="cursor-pointer text-green-500" @click="editMode = true">Edit</a> |
          <a class="cursor-pointer text-red-500" @click="$emit('deleteItem', order)">Delete</a>
      </span>
      <span v-if="editMode">
          <a class="cursor-pointer text-blue-500" @click="$emit('updateItem', order); editMode = false">Save</a>
      </span>
    </td>
  </tr>
</template>

<script>
export default {
  data() {
    return {
      editMode: false
    };
  },
  props: ["order"],
  computed: {
    price() {
      return `${this.order.price} ${this.order.currency}`;
    },
    total() {
      return `${this.order.total} ${this.order.currency}`;
    }
  }
};
</script>

<style>
</style>