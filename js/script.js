document.querySelector("#addForm").addEventListener("submit", addProduto);
document.onload = listarProdutosBd();

function listarProdutosBd(){
  const formData = new FormData();
  formData.append("opcao", "read");
  window.fetch("controller/produtosController.php", {
    method: "post",
    body: formData
  }).then(response => response.text())
    .then(data => {
      let dadosJson = JSON.parse(data);
      for(let i = 0; i<dadosJson.length; i++){
        let el = document.createElement("tr");
        el.setAttribute("id", `${dadosJson[i]['id']}`);
        document.querySelector("tbody").appendChild(el).innerHTML = 
        `<th scope="row">${dadosJson[i]['id']}</th>
        <td>${dadosJson[i]['nome']}</td>
        <td>${dadosJson[i]['titulo']}</td>
        <td>${dadosJson[i]['preco']}</td>
        <td class="text-right">
          <a title="Editar" data-toggle="modal" data-target="#editModal" onclick="editarProduto(${dadosJson[i]['id']})"><i class="fas fa-edit fa-lg p-2"></i></a>
          <a title="Excluir" onclick="deletarProduto(${dadosJson[i]['id']})"><i class="fas fa-trash-alt fa-lg p-2"></i></a>
        </td>`;
      }
  }); 
}

function addProduto(event) { 
  event.preventDefault(); //impedir o submit de dar reload na página 
  const formData = new FormData(this);
  formData.append("opcao", "create"); 
  window.fetch("controller/produtosController.php", {
    method: 'post',
    body: formData
  }).then(response => response.text())
    .then(data => {
      let dadosJson = JSON.parse(data);
      listarNovoProduto(dadosJson); //adicionar o html do novo produto adicionado

      document.querySelector("#resultadoAcao").innerHTML = "Adicionado com sucesso!";
      document.querySelector("#resultadoAcao").classList.add("addSucesso");
    });
  //Resetar os campos do form
  document.querySelector("#addNomeInput").value = "";
  document.querySelector("#addPrecoInput").value = "";
  document.querySelector("#addCategoriaInput").value = "2";

  $("#addModal").modal('hide'); //fechar o modal depois de adicionar o produto

}

function listarNovoProduto(data) {
  let el = document.createElement("tr");
  el.setAttribute("id", `${data[data.length-1]['id']}`);
  document.querySelector("tbody").appendChild(el).innerHTML = 
  `<th scope="row">${data[data.length-1]['id']}</th>
  <td>${data[data.length-1]['nome']}</td> 
  <td>${data[data.length-1]['titulo']}</td>
  <td>${data[data.length-1]['preco']}</td>
  <td id = 12 class="text-right">
    <a title="Editar" data-toggle="modal" data-target="#editModal" onclick="editarProduto(${data[data.length-1]['id']})"><i class="fas fa-edit fa-lg p-2"></i></a>
    <a title="Excluir" onclick="deletarProduto(${data[data.length-1]['id']})"><i class="fas fa-trash-alt fa-lg p-2"></i></a>
  </td>`; 
}

function deletarProduto(id) {
  const formData = new FormData();
  formData.append("id", id);
  formData.append("opcao", "delete");
  window.fetch("controller/produtosController.php", {
    method:"post",
    body:formData
  });
  $(`tr[id=${id}]`).remove(); //remover o html desse produto
  document.querySelector("#resultadoAcao").innerHTML = "Removido com sucesso!";
  document.querySelector("#resultadoAcao").classList.add("addSucesso");
}

function editarProduto(id) {
  document.querySelector("#editForm").addEventListener("submit", function handler(){
    event.preventDefault(); //impedir o submit de dar reload na página 
    const formData = new FormData(this);
    formData.append("opcao", "update");
    formData.append("id", id);
    window.fetch("controller/produtosController.php", {
      method: 'post',
      body: formData
    }).then(response => response.text())
      .then(data => {
        let dadosJson = JSON.parse(data);
        //Mudar para os novos valores
        document.querySelector(`tr[id='${id}'] > td:nth-child(2)`).innerText = dadosJson[0]['nome'];
        document.querySelector(`tr[id='${id}'] > td:nth-child(3)`).innerText = dadosJson[0]['titulo'];
        document.querySelector(`tr[id='${id}'] > td:nth-child(4)`).innerText = dadosJson[0]['preco'];
        
        document.querySelector("#resultadoAcao").innerHTML = "Editado com sucesso!";
        document.querySelector("#resultadoAcao").classList.add("addSucesso");
      });

    //Resetar os campos do form
    document.querySelector("#editNomeInput").value = "";
    document.querySelector("#editPrecoInput").value = "";
    document.querySelector("#editCategoriaInput").value = 2;
    $("#editModal").modal('hide'); //fechar o modal depois de adicionar o produto

    this.removeEventListener('submit', handler); //evitar que crie o mesmo eventListener diversas vezes
  });
}

function buscar(el) {
  
  if(el.value != ""){
    document.querySelector("#todosProdutos").classList.add("d-none"); //esconder a table que tem o html de todos os produtos
    const formData = new FormData();
    formData.append("opcao", "readByNome");
    formData.append("nome", el.value);
    window.fetch("controller/produtosController.php", {
      method:'post',
      body: formData
    }).then(response => response.text())
    .then(data => {
      $("#buscaProdutos > tr").remove(); //remover o html da table de busca para adicionar os novos resultados
      let dadosJson = JSON.parse(data); 
        for(let i = 0; i<dadosJson.length; i++){
          let el = document.createElement("tr");
          el.setAttribute("id", `${dadosJson[i]['id']}`);
          document.querySelector("tbody[id='buscaProdutos']").appendChild(el).innerHTML = 
         `<th scope="row">${dadosJson[i]['id']}</th>
          <td>${dadosJson[i]['nome']}</td>
          <td>${dadosJson[i]['titulo']}</td>
          <td>${dadosJson[i]['preco']}</td>
          <td class="text-right">
            <a title="Editar" data-toggle="modal" data-target="#editModal" onclick="editarProduto(${dadosJson[i]['id']})"><i class="fas fa-edit fa-lg p-2"></i></a>
            <a title="Excluir" onclick="deletarProduto(${dadosJson[i]['id']})"><i class="fas fa-trash-alt fa-lg p-2"></i></a>
          </td>`;
        }
      });
  } else {
      document.querySelector("#todosProdutos").classList.remove("d-none");
      $("#buscaProdutos > tr").remove(); //remover o html da table de busca
  }
}


