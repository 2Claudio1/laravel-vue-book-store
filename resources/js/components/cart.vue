<template>
  <div>
    <h1>Cart</h1>
    <div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Qty.</th>
            <th>Book</th>
            <th class="text-right">Un. Price</th>
            <th class="text-right">Subtotal</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <!-- REPETIR PARA CADA ITEM DO CARRINHO -->
          <tr v-for="book in this.$store.state.cart" :key="book.item.id">
            <!-- Exemplo de uma linha -->
            <td> {{ book.quantity }}</td>
            <td> {{ book.item.title }} </td>
            <td class="text-right"> {{ book.item.price }}€</td>
            <td class="text-right"> {{ parseFloat(book.quantity * book.item.price).toFixed(2) }}€</td>
            <td
              class="text-right"
              style="width:5rem;"
            ><button class="btn btn-info"
            v-on:click.prevent="incrementItem(book.item)"
            >+</button></td>
            <td
              class="text-right"
              style="width:5rem;"
            ><button class="btn btn-secondary"
            v-on:click.prevent="decrementItem(book.item)"
            >-</button></td>
            <td
              class="text-right"
              style="width:6rem;"
            ><button class="btn btn-danger"
            v-on:click.prevent="removeItem(book.item)"
            >X</button></td>
          </tr>
          <!-- FIM DE REPETIR PARA CADA ITEM DO CARRINHO -->
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-7">
        <h2>Total: {{ parseFloat(totalPrice).toFixed(2) }}€</h2>
      </div>
      <div class="text-right col-5">
        <button class="btn btn-primary btn-lg"
        >Confirm Purchase</button>
      </div>
    </div>
  </div>
</template>



<script>
export default {
  data: function () {
    return {};
  },
  methods: {
    incrementItem: function (item) {
      this.$store.dispatch("incrementItem", item);
    },
    decrementItem: function (item) {
      this.$store.dispatch("decrementItem", item);
    },
    removeItem: function (item) {
      this.$store.dispatch("removeItemFromCart", item);
    },
  },
  computed: {
    totalPrice: function () {
      let totalPrice = 0.0;

      if (this.$store.state.cart.length > 0) {
        this.$store.state.cart.forEach(function (book) {
          console.log("book: " + book);
          totalPrice += book.item.price * book.quantity;
        });
      }

      return totalPrice;
    },
  },
};
</script>