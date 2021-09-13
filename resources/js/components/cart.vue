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
          <tr>
            <!-- Exemplo de uma linha -->
            <td>3</td>
            <td>Example Title</td>
            <td class="text-right">100 €</td>
            <td class="text-right">300 €</td>
            <td
              class="text-right"
              style="width:5rem;"
            ><button class="btn btn-info">+</button></td>
            <td
              class="text-right"
              style="width:5rem;"
            ><button class="btn btn-secondary">-</button></td>
            <td
              class="text-right"
              style="width:6rem;"
            ><button class="btn btn-danger">X</button></td>
          </tr>
          <!-- FIM DE REPETIR PARA CADA ITEM DO CARRINHO -->
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-7">
        <h2>Total: 300 €</h2>
      </div>
      <div class="text-right col-5">
        <button class="btn btn-primary btn-lg">Confirm Purchase</button>
      </div>
    </div>
  </div>
</template>

