<?php

require_once('util/Conexao.php');

class ProdutosControl{
	
	/**
	* Insere os valores de Produtos na base de Dados
	*
	* @var Produtos
	*/
	public static function inserirProduto(Produtos $produto){

	$retorno = false;

	try {
			
		$db = Conexao::getInstance();

		$sql = "INSERT INTO 
					tb_produtos
					 (
					 desc_produto,
					 valor_produto,
					 data_vencimento,
					 categoria_produto
					 )
			 	VALUES 
			 		(
		 			?,
		 			?,
		 			?,
		 			?);";

		$strDesc = $produto->getDescricao();
		$decVal  = $produto->getValor();
		$dtVenc = date('Y-m-d', strtotime(str_replace('/','-', $produto->getVencimento())));
		
		$intCat = $produto->getCategoria()->getIdCategoria();

		$stmt = $db->prepare($sql);
		$stmt->bindParam(1, $strDesc, PDO::PARAM_STR);
		$stmt->bindParam(2, $decVal, PDO::PARAM_STR);
		$stmt->bindParam(3, $dtVenc, PDO::PARAM_STR);
		$stmt->bindParam(4, $intCat, PDO::PARAM_INT);

		$stmt->execute(); 
		

		$retorno = true;

		} catch (Exception $e) {
			
			echo $e->getMessage();
		}finally{
			Conexao::close();
		}


		return $retorno;

	}


	/**
	* Atualiza um registro na tabela de Produtos de acordo com o ID passado
	*
	* @param Produtos
	* @return boolean 
	**/
	public static function atualizarProduto(Produtos $produto){

			$retorno = false;

	try {
			
		$db = Conexao::getInstance();

		$sql = "UPDATE  
					tb_produtos
					 SET
					 desc_produto = ?,
					 valor_produto = ?,
					 data_vencimento = ? ,
					 categoria_produto = ?
				 WHERE 
				 	id_produto = ?";

					 
		
		$strDesc = $produto->getDescricao();
		$decVal  = $produto->getValor();
		$dtVenc =  date('Y-m-d', strtotime(str_replace('/','-', $produto->getVencimento())));
		$intCat = $produto->getCategoria()->getIdCategoria();
		$intIdProd = $produto->getIdProduto();

		$stmt = $db->prepare($sql);
		$stmt->bindParam(1, $strDesc, PDO::PARAM_STR);
		$stmt->bindParam(2, $decVal, PDO::PARAM_STR);
		$stmt->bindParam(3, $dtVenc, PDO::PARAM_STR);
		$stmt->bindParam(4, $intCat, PDO::PARAM_INT);
		$stmt->bindParam(5, $intIdProd, PDO::PARAM_INT);

		$stmt->execute(); 
		

		$retorno = true;

		} catch (Exception $e) {
			
			echo $e->getMessage();

		}finally{

			Conexao::close();
		}


		return $retorno;
	}

	/**
	* Excluir um registro da tabela de Produtos pelo Id passado
	*
	* @var Produto
	**/
	public static function excluirProduto(Produtos $produto){

 		$retorno = false;

 		try {

	 		$db = Conexao::getInstance();
	 		$idProduto = $produto->getIdProduto();

			$sql = "DELETE FROM tb_produtos WHERE id_produto = ?";

			$stmt = $db->prepare($sql);
			$stmt->bindParam(1, $idProduto, PDO::PARAM_INT);
			$stmt->execute(); 
 			

 			$retorno = true;
 		} catch (Exception $e) {

 			echo $e->getMessage();
 			
 		}finally{

 			Conexao::close();
 		}


		return $retorno;


	}

	/**
	* Retorna uma lista de Objetos do tipo Produto
	*
	**/
	public static function listarProdutos(){

		$db = Conexao::getInstance();

		$sql  = "SELECT 
					produtos.id_produto,
					produtos.desc_produto,
					produtos.valor_produto,
					produtos.data_vencimento,
					categoria.id_categoria,
					categoria.desc_categoria
				FROM
				 	tb_produtos as produtos INNER JOIN tb_categoria_produto as categoria
				ON 
					(produtos.categoria_produto = categoria.id_categoria);";
	
		$stmt = $db->prepare($sql);

		$stmt->execute();

		$listarProdutos = new ArrayObject(); 

	   foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $produto) {

	   	$prod  = new Produtos();

    	$prod->setIdProduto($produto['id_produto']);
    	$prod->setDescricao($produto['desc_produto']);
    	$prod->setValor($produto['valor_produto']);
    	$prod->setVencimento($produto['data_vencimento']);

    	$categoria = new CategoriaProduto();
    	$categoria->setIdCategoria($produto['id_categoria']);
    	$categoria->setDescCategoria($produto['desc_categoria']);

    	$prod->setCategoria($categoria);


    	$listarProdutos->append($prod);

      }

		return $listarProdutos;

	}

	/**
	* Retorna um objeto do tipo Produto de acordo com o ID passado
	*
	*@param Produtos
	**/
	public static function buscarProdutoById(Produtos $produto){

		$db = Conexao::getInstance();
		$idProduto = $produto->getIdProduto();


		$sql  = "SELECT 
					produtos.id_produto,
					produtos.desc_produto,
					produtos.valor_produto,
					produtos.data_vencimento,
					categoria.id_categoria,
					categoria.desc_categoria
				FROM
				 	tb_produtos as produtos INNER JOIN tb_categoria_produto as categoria
				ON 
					(produtos.categoria_produto = categoria.id_categoria)
				WHERE produtos.id_produto = ?;";


		$stmt = $db->prepare($sql);
		$stmt->bindParam(1, $idProduto, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetch();

		$prod  = new Produtos();

    	$prod->setIdProduto($result->id_produto);
    	$prod->setDescricao($result->desc_produto);
    	$prod->setValor($result->valor_produto);
    	$prod->setVencimento($result->data_vencimento);

    	$categoria = new CategoriaProduto();
    	$categoria->setIdCategoria($result->id_categoria);
    	$categoria->setDescCategoria($result->desc_categoria);

    	$prod->setCategoria($categoria);

		return $prod;
	}

}