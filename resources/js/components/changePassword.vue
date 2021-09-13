<template>
  <div>
    <h2>Alterar Senha</h2>
    <div class="form-group">
      <label for="inputPassword">Old password</label>
      <input
        type="password"
        name="old_password"
        id="inputOldPassword"
        class="form-control"
        v-model="password.oldPassword"
      />
    </div>
    <div class="form-group">
      <label for="inputPassword">New password</label>
      <input
        type="password"
        name="new_password"
        id="inputNewPassword"
        class="form-control"
        v-model="password.newPassword"
      />
    </div>
    <div class="form-group">
      <label for="inputPassword">Confirm password</label>
      <input
        type="password"
        name="confirm_password"
        id="inputConfirmPassword"
        class="form-control"
        v-model="confirmPassword"
      />
    </div>
    <div class="form-group">
      <a class="btn btn-primary" v-on:click.prevent="alterarPassword">Change</a>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      password: {
        oldPassword: "",
        newPassword: "",
      },
      confirmPassword: "",
    };
  },
  methods: {
    alterarPassword() {
      if (this.confirmPassword === this.password.newPassword) {
        console.log(this.password.newPassword);
        axios
          .put("api/changePassword", this.password)
          .then((response) => {
            console.dir(response.data);
            this.$toasted.info('Utilizador "' + this.$store.state.user.name + '" alterou a senha!');
            this.$router.push("/");
          })
          .catch(error => {
            console.log(error);
            this.$toasted.error("Problemas ao alterar a senha do utilizador");
            console.dir(error);
          });
      } else {
        this.$toasted.error("Problemas ao alterar a senha do utilizador2");
      }
    },
  },
};
</script>