<?php 
require '../model/produtos.php';

$opcao = $_POST['opcao'];

switch($opcao){
    case 'create':
        if(isset($_POST['categoria']) && isset($_POST['nome']) && isset($_POST['preco'])) {
            $produto = new Produtos($_POST['categoria'], $_POST['nome'], $_POST['preco']);
            $produto->create();
            $dadosJson = json_encode($produto->read()); //pegar os dados para adicionar o novo produto 
            echo $dadosJson;
        }
        break;
        case 'read':
            $produto = new Produtos();
            $dados = $produto->read();
            $dadosJson = json_encode($dados);
            echo $dadosJson;
            break;
    case 'update':
        if(isset($_POST['id']) && isset($_POST['categoria']) && isset($_POST['nome']) && isset($_POST['preco'])) {
            $produto = new Produtos($_POST['categoria'], $_POST['nome'], $_POST['preco']);
            $produto->setId($_POST['id']);
            $produto->update();
            $dadosJson = json_encode($produto->readById($_POST['id'])); //pegar os dados para editar o conteudo do html
            echo $dadosJson;
        }
        break;
    case 'delete':
        if(isset($_POST['id'])) {
            $produto = new Produtos();
            $produto->setId($_POST['id']);
            $produto->delete();
        }
        break;
    case 'readByNome':
        if(isset($_POST['nome'])){
            $produto = new Produtos();
            $dados = $produto->readByNome($_POST['nome']);
            $dadosJson = json_encode($dados);
            echo $dadosJson;
        }
    break;
}





