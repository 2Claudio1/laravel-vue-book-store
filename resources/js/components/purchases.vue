<template>
  <div>
    <h1>
      <span v-if="user.type === 'Customer'">My Purchases</span>
      <span v-else>Pending purchases</span>
    </h1>
    <div>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Date</th>
            <th v-if="user.type === 'Employee'">Customer</th>
            <th v-if="user.type === 'Customer'">Status</th>
            <th class="text-right">Total</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <!-- REPETIR PARA CADA COMPRA NA LISTA -->
          <template v-for="(purchase, index) in purchases">
            <tr :key="purchase.id">
              <td>{{ purchase.id }}</td>
              <td>{{ purchase.date }}</td>
              <td v-if="user.type === 'Customer'">
                {{
                  purchase.status == "D"
                    ? "Delivered"
                    : purchase.status == "C"
                    ? "Canceled"
                    : "Pending"
                }}
              </td>
              <td v-else>Customer {{ purchase.customer_id }}</td>
              <td class="text-right">{{ purchase.total }} €</td>
              <td class="text-right" style="width: 7rem">
                <button
                  class="btn btn-primary"
                  v-if="user.type === 'Employee'"
                >
                  Deliver
                </button>
              </td>
              <td class="text-right" style="width: 6rem">
                <button
                  class="btn btn-danger"
                  v-if="user.type === 'Employee'"
                >
                  Cancel
                </button>
              </td>
              <td class="text-right" style="width: 9.5rem">
                <button
                  class="btn btn-secondary"
                  v-show="!show.includes(index)"
                  v-on:click.prevent="showDetails(index)"
                >
                  Details ...
                </button>

                <button
                  class="btn btn-dark"
                  v-show="show.includes(index)"
                  v-on:click.prevent="closeDetails(index)"
                >
                  Close
                </button>
              </td>
            </tr>
            <!-- Só mostra se detalhe estiver aberto -->
            <tr v-show="show.includes(index)">
              <td></td>
              <td colspan="5">
                <!-- COLOCAR AQUI A TABELA COM OS DETALHES DA COMPRA --- VER detalhesCompra.template -->
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Qty.</th>
                      <th>Book</th>
                      <th class="text-right">Un. Price</th>
                      <th class="text-right">Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- REPETIR PARA CADA ITEM DA COMPRA -->
                    <tr v-for="book in purchase.books" :key="book.id">
                      <td> {{ book.pivot.qty }} </td>
                      <td> {{ book.title }}</td>
                      <td class="text-right"> {{ book.price }} €</td>
                      <td class="text-right"> {{ parseFloat (book.pivot.qty * book.price).toFixed(2) }} €</td>
                    </tr>
                    <!-- FIM DE REPETIR PARA CADA ITEM DA COMPRA -->
                  </tbody>
                </table>
              </td>
              <td></td>
            </tr>
            <!-- FIM DE Só mostra se detalhe estiver aberto -->
          </template>
          <!-- FIM DE REPETIR PARA CADA COMPRA NA LISTA -->
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      user: [],
      purchases: [],
      show: [],
    };
  },
  methods: {
    setUser: function () {
      if (this.$store.state.user !== null) this.user = this.$store.state.user;
    },
    getPurchases: function () {
      axios.get("api/purchases").then((response) => {
        this.purchases = response.data;
      });
    },
    showDetails: function (index) {
      this.show.push(index);
    },
    closeDetails: function (index) {
      this.show = this.show.filter((item) => item !== index);
    },
    moreDetails: function () {
      this.visible = false;
    },

  },
  mounted() {
    this.setUser();
    this.getPurchases();
  },
};
</script>
