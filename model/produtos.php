<?php
require "conexao.php";
class Produtos {

    private $id;
    private $categoriaId;
    private $nome;
    private $preco;

    public function __construct($categoriaId = null, $nome = null, $preco = null) {
        $this->categoriaId = htmlspecialchars($categoriaId);
        $this->nome = htmlspecialchars($nome);
        $this->preco = htmlspecialchars($preco);
    }

    public function create() {
        $stmt = Conexao::getConection()->prepare("INSERT INTO `produtos` (`categoria_id`, `nome`, `preco`) VALUES (?,?,?)");

        $stmt->bindParam(1, $this->categoriaId);
        $stmt->bindParam(2, $this->nome);
        $stmt->bindParam(3, $this->preco);
        $stmt->execute();
    }

    public function read() {
        $stmt = Conexao::getConection()->query("SELECT P.id, C.titulo, P.nome, P.preco FROM produtos P INNER JOIN categorias C ON P.categoria_id = C.id ORDER BY id");
        if($stmt->rowCount()>0){
            return $stmt->fetchAll();
        }
    }

    public function update() {
        $stmt = Conexao::getConection()->prepare("UPDATE `produtos` SET `categoria_id` = ?, `nome` = ?, `preco` = ? WHERE `id` = ?");
                
        $stmt->bindParam(1, $this->categoriaId);
        $stmt->bindParam(2, $this->nome);
        $stmt->bindParam(3, $this->preco);
        $stmt->bindParam(4, $this->id);
        $stmt->execute();
    }

    public function delete() {
        $stmt = Conexao::getConection()->query("DELETE FROM `produtos` WHERE `id` = $this->id");
    }

    public function readById($id) {
        $stmt = Conexao::getConection()->query("SELECT P.id, C.titulo, P.nome, P.preco FROM produtos P INNER JOIN categorias C ON P.categoria_id = C.id WHERE P.id = $id ORDER BY id");
        if($stmt->rowCount()>0){
            return $stmt->fetchAll();
        }
    }
    
    public function readByNome($nome) {
        $stmt = Conexao::getConection()->query("SELECT P.id, C.titulo, P.nome, P.preco FROM produtos P INNER JOIN categorias C ON P.categoria_id = C.id WHERE P.nome LIKE '%$nome%'");
        if($stmt->rowCount()>0){
            return $stmt->fetchAll();
        }
    }

    public function setId($id) {
        $this->id = htmlspecialchars($id);
    }
}
    