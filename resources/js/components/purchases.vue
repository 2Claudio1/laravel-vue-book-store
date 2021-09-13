<template>
  <div>
    <h1><span>My Purchases   ou  Pending purchases</span>
    </h1>
    <div>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Customer or Status</th>
            <th class="text-right">Total</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <!-- REPETIR PARA CADA COMPRA NA LISTA -->
          <template>
            <tr>
              <td>234</td>
              <td>2020-01-20</td>
              <td>Customer Name   or   Purchase Status</td>
              <td class="text-right">300 €</td>
              <td
                class="text-right"
                style="width:7rem;"
              ><button class="btn btn-primary">Deliver</button></td>
              <td
                class="text-right"
                style="width:6rem;"
              ><button class="btn btn-danger">Cancel</button></td>
              <td
                class="text-right"
                style="width:9.5rem;"
              >
                <button class="btn btn-secondary">Details ...</button>
                <!-- 
                OU
                <button class="btn btn-dark">Close</button> 
                -->
              </td>
            </tr>
            <!-- Só mostra se detalhe estiver aberto -->
            <tr>
              <td></td>
              <td colspan="Nº de colunas da tabela principal MENOS dois. Por exemplo 3 ou 5">
                <!-- COLOCAR AQUI A TABELA COM OS DETALHES DA COMPRA --- VER detalhesCompra.template -->
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
