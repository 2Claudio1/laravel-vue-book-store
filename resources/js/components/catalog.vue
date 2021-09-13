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
                id="inputfilterStr"
                placeholder="Search within the title or genre"
                class="form-control"
              >
              <div class="input-group-append">
                <button class="input-group-text bg-success text-white">Clear</button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <h3>All Books   OU   Books whose title or genre includes "XXX"</h3>
            </div>
          </div>
        </div>

        <!-- REPETIR PARA CADA GENERO QUE APARECE NO FILTRO -->
        <div>
          <div class="row">
            <div class="col-12">
              <div class="bg-secondary px-3 pt-3 pb-2 my-3">
                <h4 class="text-white">Genre Name</h4>
              </div>
            </div>
          </div>
          <div class="row">
            
            <!-- REPETIR PARA CADA ITEM/LIVRO DO FILTRO -->
            <div class="col-sm-12 col-lg-6">
              <div class="card shadow-sm sm-4 mb-4 flex-row">
                <img
                  src="url_da_imagem_com_a_capa_do_livro"
                  class="bd-placeholder-img card-img-left w-25 m-2"
                >
                <div class="card-body d-flex flex-column">
                  <h3>Book Title</h3>
                  <p class="card-text">Book Description</p>
                  <div class="text-center mt-auto d-flex justify-content-center">
                    <h5 class="mx-2 pt-2">146 €</h5>
                    
                    <!-- Só mostra o próximo DIV se utilizador for cliente/customer -->
                    <div class="mx-2">
                      <div class="text-center">
                        <button class="btn btn-primary">Add to cart</button>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>  <!-- FIM - REPETIR PARA CADA ITEM/LIVRO DO FILTRO -->                      
          </div>        
        </div>   <!-- FIM - REPETIR PARA CADA GENERO QUE APARECE NO FILTRO -->  
      </div>
    </div>
  </div>
</template>

