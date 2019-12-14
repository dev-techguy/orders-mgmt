<template>
  <div>
    <div class="panel mt-4 shadow">
      <form action>
        <div class="w-full flex items-center">
          <div class="w-1/4">
            <label for>
              <select name id class="form-select">
                <option value="all">All time</option>
                <option value="7">Last 7 days</option>
                <option value="today">Today</option>
              </select>
            </label>
          </div>
          <div class="w-1/2">
            <input type="text" class="form-input w-full h-10" placeholder="enter search item" />
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
          <order-list-item v-for="(order, index) in orders.data" :key="index" :order="order"></order-list-item>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import OrderListItem from './OrderListItem';
import {eventBus} from '../services/Bus';
export default {
    components: {OrderListItem},
    data() {
        return {
            orders: [],
            busy: false
        }
    },
    created() {
        eventBus.$on('orderCreated', (order) => {
            this.fetchProducts();
        })
    },
    mounted() {
        this.fetchProducts();
    },
    methods: {
        fetchProducts() {
            this.busy = true
            axios.get('/orders').then(res => {
                this.orders = res.data.data;
            }).catch(err => {
                console.log(err);
            }).finally(() => this.busy = false);
        }
    }
};
</script>

<style>
</style>