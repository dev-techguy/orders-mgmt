<template>
  <div class="panel">
    <form action @submit.prevent="makeOrder">
      <h4 class="text-xl">Add new order</h4>
      <div class="w-full mt-2">
        <label class="lg:flex">
          <span class="text-gray-700 lg:w-1/6 flex items-center">User</span>
          <select
            class="form-select mt-1 w-full lg:w-1/3 h-10"
            v-model="order.user_id"
            required
            :disabled="busy"
          >
            <option v-for="(user, index) in users" :key="index" :value="user.id" v-text="user.name"></option>
          </select>
        </label>
      </div>
      <div class="w-full mt-2">
        <label class="lg:flex">
          <span class="text-gray-700 lg:w-1/6 flex items-center">Product</span>
          <select class="form-select mt-1 w-full lg:w-1/3 h-10" v-model="order.product_id" required>
            <option
              v-for="(product, index) in products"
              :key="index"
              :value="product.id"
              v-text="product.name"
            ></option>
          </select>
        </label>
      </div>
      <div class="w-full mt-2">
        <label class="lg:flex">
          <span class="text-gray-700 lg:w-1/6 flex items-center">Quantity</span>
          <input
            class="form-input mt-1 w-full lg:w-1/3 h-10"
            type="number"
            min="1"
            v-model="order.quantity"
            required
          />
        </label>
      </div>
      <div class="w-full mt-4 flex">
        <div class="w-1/2 flex lg:justify-end">
          <button class="app-btn bg-gray-600 hover:bg-gray-700" :disabled="btnLoading">
              add<span v-show="btnLoading">ing...</span>
            </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import {eventBus} from '../services/Bus';
export default {
  data() {
    return {
      users: [],
      products: [],
      order: {},
      busy: false,
      btnLoading: false
    };
  },
  async mounted() {
    await this.loadSetupData();
  },
  methods: {
    async loadSetupData() {
      this.busy = true;
      const [users, products] = await Promise.all([
        this.fetchUsers(),
        this.fetchProducts()
      ]);
      this.users = users.data.data;
      this.products = products.data.data;
      this.busy = false;
    },

    fetchUsers() {
      return axios.get("/users/all");
    },
    fetchProducts() {
      return axios.get("/products/all");
    },
    makeOrder() {
      this.btnLoading = true;
      axios
        .post("/orders", this.order)
        .then(res => {
          this.order = {};
          eventBus.$emit('orderCreated');
        })
        .catch(err => {
          console.error(err);
          alert("An Error Occurred");
        })
        .finally(() => (this.btnLoading = false));
    }
  }
};
</script>

<style>
</style>