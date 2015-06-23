<?php

require_once('util/Conexao.php');

class CategoriaProdutoControl {


	public static function listarCategoriasProdutos(){

		$db = Conexao::getInstance();

		$sql  = "SELECT * FROM tb_categoria_produto";
	
		$query = $db->query($sql);

		$listarCategoriasProdutos = new ArrayObject(); 

	   foreach($query->fetchAll(PDO::FETCH_ASSOC) as $categoria) {

	   	$categoriaProduto  = new CategoriaProduto();

    	$categoriaProduto->setIdCategoria($categoria['id_categoria']);
    	$categoriaProduto->setDescCategoria($categoria['desc_categoria']);


    	$listarCategoriasProdutos->append($categoriaProduto);

      }

		return $listarCategoriasProdutos;
		
	}


}