<template>
  <div>
    <header>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
          <router-link
            class="navbar-brand d-flex align-items-center"
            to="/books"
          >
            <img
              src="img/logo.svg"
              width="20"
              height="20"
              style="margin-right: 20px"
            />
            <strong>Exame (DAD)</strong>
          </router-link>

          <ul class="nav justify-content-end">
            <li class="nav-item">
              <router-link class="nav-link" to="/books">Books</router-link>
            </li>
            <template v-if="$store.state.user">
              <li class="nav-item">
                <router-link
                  class="nav-link"
                  to="/mypurchases"
                  v-if="$store.state.user.type === 'Customer'"
                  >My Purchases</router-link
                >
              </li>
              <li class="nav-item">
                <router-link
                  class="nav-link"
                  to="/pendingpurchases"
                  v-if="$store.state.user.type === 'Employee'"
                  >Pending Purchases</router-link
                >
              </li>
              <li class="nav-item">
                <router-link
                  class="nav-link"
                  to="/cart"
                  v-if="$store.state.user.type === 'Customer'"
                  >Cart</router-link
                >
              </li>
            </template>
            <li v-if="!$store.state.user" class="nav-item">
              <router-link to="/login" class="btn btn-secondary" role="button"
                >Entrar</router-link
              >
            </li>
            <li v-else class="nav-item">
              <div class="dropdown">
                <button
                  class="btn btn-secondary dropdown-toggle"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                  tag="button"
                >
                  {{ $store.state.user.name }}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <router-link to="/password" class="dropdown-item"
                    >Alterar Senha</router-link
                  >
                  <a class="dropdown-item" v-on:click.prevent="logout">Sair</a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </header>
    <main role="main">
      <div class="container">
        <router-view></router-view>
      </div>
    </main>
  </div>
</template>

<script>
export default {
  methods: {
    logout () {
      axios.post('/api/logout').then(response => {
        this.$store.commit('clearUser')
        this.$toasted.show('Utilizador saiu da aplicação.', { type: 'warning' })
        this.$router.push('/')
      })
        .catch(error => {
          this.$toasted.show('Pedido HTTP "Logout" inválido!', { type: 'error' })
        })
    },
  },
}
</script>
