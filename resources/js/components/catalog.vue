<template>
  <div>
    <div>
      <h1>Books</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="col-12">
          <div class="form-group">
            <div class="input-group">
              <input
                type="text"
                name="filterStr"
                v-model="search"
                id="inputfilterStr"
                placeholder="Search within the title or genre"
                class="form-control"
              />
              <div class="input-group-append">
                <button
                  class="input-group-text bg-success text-white"
                  v-on:click.prevent="clearSearch"
                >
                  Clear
                </button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <h3>
                <span v-if="search.trim() === ''"> All Books </span>
                <span v-else>
                  Books whose title or genre includes "{{ search }}"
                </span>
              </h3>
            </div>
          </div>
        </div>

        <div v-for="genre in genres" :key="genre.id">
          <div class="row">
            <div class="col-12">
              <div class="bg-secondary px-3 pt-3 pb-2 my-3">
                <h4 class="text-white">{{ genre.name }}</h4>
              </div>
            </div>
          </div>

          <div class="row">
            <!-- REPETIR PARA CADA ITEM/LIVRO DO FILTRO -->
            <div
              class="col-sm-12 col-lg-6"
              v-for="book in booksByGenreCode(genre.code)"
              :key="book.id"
            >
              <div class="card shadow-sm sm-4 mb-4 flex-row">
                <!-- v-if="genre.name == book.name" -->

                <img
                  v-if="book.cover_img != null"
                  :src="`./storage/capas/${book.cover_img}`"
                  class="bd-placeholder-img card-img-left w-25 m-2"
                />

                <div class="card-body d-flex flex-column">
                  <h3>{{ book.title }}</h3>
                  <p class="card-text">{{ book.description }}</p>
                  <div
                    class="text-center mt-auto d-flex justify-content-center"
                  >
                    <h5 class="mx-2 pt-2">{{ book.price }}</h5>

                    <!-- Só mostra o próximo DIV se utilizador for cliente/customer -->
                    <div class="mx-2" v-if="user.type === 'Customer'">
                      <div class="text-center">
                        <button
                          class="btn btn-primary"
                          @click.prevent="addItemToCart(book)"
                        >
                          Add to cart
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- FIM - REPETIR PARA CADA ITEM/LIVRO DO FILTRO -->
          </div>
        </div>
        <!-- FIM - REPETIR PARA CADA GENERO QUE APARECE NO FILTRO -->
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      user: [],
      books: [],
      genres: [],
      search: "",
      booksGenre: [],
    };
  },
  methods: {
    setUser: function () {
      if (this.$store.state.user !== null) this.user = this.$store.state.user;
      console.log(this.user);
    },
    getBooks: function () {
      axios.get("api/books").then((response) => {
        this.books = response.data;
      });
    },
    getGenres: function () {
      axios.get("api/genres").then((response) => {
        this.genres = response.data;
      });
    },
    clearSearch: function () {
      this.search = "";
    },
    addItemToCart: function (book) {
      this.$store.commit("addItemToCart", book);
    },
    booksByGenreCode: function (genreCode) {
      return this.filteredBooks.filter( (book) =>
        book.genre == (genreCode)
      );
    },
  },
  computed: {
    filteredBooks: function () {
      if (this.search.trim() == "") {
        return this.books;
      } else {
        return this.books.filter(
          (book) =>
            book.title.toLowerCase().includes(this.search.toLowerCase()) ||
            (book.name.toLowerCase().includes(this.search.toLowerCase()) )
        );
      }
    },
  },
  mounted() {
    this.setUser();
    this.getBooks();
    this.getGenres();
  },
};
</script>