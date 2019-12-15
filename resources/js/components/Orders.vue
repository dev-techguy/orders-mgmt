<template>
  <div>
    <alert v-if="showDeleteAlert" @canProceed="deleteOrder" @alertClosed="showDeleteAlert = false">
      <h4>
        Are you sure you want to delete
        <span
          class="bg-yellow-100 px-2 py-1"
        >{{ focus.product.name }}</span> from the list of orders?
      </h4>
    </alert>

    <div class="panel mt-4 shadow">
      <form action @submit.prevent="searchOrder">
        <div class="w-full flex items-center">
          <div class="w-1/4">
            <label for>
              <select name id class="form-select" v-model="period">
                <option value="all">All time</option>
                <option value="week">Last 7 days</option>
                <option value="today">Today</option>
              </select>
            </label>
          </div>
          <div class="w-1/2">
            <input
              type="text"
              class="form-input w-full h-10"
              placeholder="enter search item"
              v-model="q"
              required
            />
          </div>
          <div class="w-1/4 px-2 flex justify-end">
            <button
              class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-1 px-4 rounded"
            >search</button>
          </div>
        </div>
      </form>
    </div>

    <div class="panel">
      <content-widget :data="orders.data" placeholder="There are no orders to display...">
        <table class="app-table table-auto w-full">
          <thead>
            <tr>
              <th>User</th>
              <th>Product</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Total</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="text-sm">
            <order-list-item
              v-for="(order, index) in orders.data"
              :key="index"
              :order="order"
              @deleteItem="triggerDelete"
              @updateItem="updateItem"
            ></order-list-item>
          </tbody>
        </table>
      </content-widget>

      <pagination :data="orders" @pagination-change-page="fetchProducts"></pagination>
    </div>
  </div>
</template>

<script>
import OrderListItem from "./OrderListItem";
import { eventBus } from "../services/Bus";
import Alert from "../utils/Alert.vue";
import ContentWidget from "../utils/ContentWidget.vue";
import Pagination from "laravel-vue-pagination";

export default {
  components: { OrderListItem, Alert, ContentWidget, Pagination },
  data() {
    return {
      orders: {},
      q: "",
      period: "all",
      busy: false,
      focus: {},
      showDeleteAlert: false
    };
  },
  created() {
    eventBus.$on("orderCreated", order => {
      this.fetchProducts();
    });
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    fetchProducts(page = 1) {
      this.busy = true;
      axios
        .get(`/orders?period=${this.period}&page=${page}`)
        .then(res => {
          this.orders = res.data.data;
        })
        .catch(err => {
          console.log(err);
        })
        .finally(() => (this.busy = false));
    },
    triggerDelete(order) {
      this.focus = order;
      this.showDeleteAlert = true;
    },
    deleteOrder() {
      axios
        .delete(`/orders/${this.focus.id}/delete`)
        .then(res => {
          let index = this.orders.data.indexOf(this.focus);
          this.orders.data.splice(index, 1);
        })
        .catch(err => {
          console.error(err);
        });
    },
    updateItem(order) {
      axios
        .patch(`/orders/${order.id}/update`, { quantity: order.quantity })
        .then(res => {
          this.fetchProducts();
        })
        .catch(err => {
          console.error(err);
        });
    },
    searchOrder() {
      this.busy = true;
      axios
        .get(`/search?q=${this.q}`)
        .then(res => {
          this.orders = res.data.data;
        })
        .catch(err => {
          console.log(err);
        })
        .finally(() => (this.busy = false));
    }
  },
  watch: {
    period() {
      return this.fetchProducts();
    }
  }
};
</script>

<style>

</style>