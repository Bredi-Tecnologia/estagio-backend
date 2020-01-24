# Teste de estágio back-end php, mysql, html, css e javascript

# REGRAS
 - Orientação a objetos.
 - Indentação e comentários (caso precise).
 - Criação do banco de dados.
 - Criar crud (visualizar, cadastrar, alterar e excluir).

# CENÁRIO

 - Um cliente precisa em seu painel de controle um módulo simples de cadastro de produto, em que cada produto estar relacionado a uma tabela chamada 'categorias' (script da tabela categoria está abaixo) :
 ```sh
   CREATE TABLE `categorias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(190) NOT NULL,
  PRIMARY KEY (`id`)
  )
  ENGINE=InnoDB;
  INSERT INTO `categorias` (`id`, `titulo`) VALUES (4, 'Alimentos');
  INSERT INTO `categorias` (`id`, `titulo`) VALUES (5, 'Informática');
  INSERT INTO `categorias` (`id`, `titulo`) VALUES (2, 'Eletrodomésticos');
  INSERT INTO `categorias` (`id`, `titulo`) VALUES (3, 'Celulares');
 ```


# DEVERES
 - Tela de cadastro de produtos (listar, editar e excluir).
 - Criar a tabela de produtos com os seguintes campos => (id, categoria_id, nome, preço).
 - Caso necessário utilize javascript no layout, será um diferencial.

# CONCLUSÃO
- Após finalizar solicite um pull request nesse repositório ou envie um e-mail para contato@bredi.com.br com os seus dados.