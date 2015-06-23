<?php


require_once('CategoriaProduto.php');
require_once('classes/control/ProdutosControl.php');

class Produtos{

	private $idProduto;
	private $descricao;
	private $valor;
	private $vencimento;
	private $categoria;


	//set Id
	public function setIdProduto($id){
		$this->idProduto = $id;
	}

	//get Id
	public function getIdProduto(){

		return $this->idProduto;
	}


	//set Descrição
	public function setDescricao($desc){

		$this->descricao = $desc;
	}

	//get Descrição
	public function getDescricao(){

		return $this->descricao;
	}

	//set Valor
	public function setValor($val){
		$this->valor = $val;
	}

	//get Valor
	public function getValor(){

		return $this->valor;
	}

	//set Vencimento
	public function setVencimento($venc){

		$this->vencimento = $venc;

	}

	//get Vencimento
	public function getVencimento(){
		
		return $this->vencimento;
	}

	//set Categoria
	public function setCategoria(CategoriaProduto $cat){

		$this->categoria =  $cat;
	}

	//get Categoria
	public function getCategoria(){

		return $this->categoria;
	}

	/**===========================================================**/


	/**
	* Insere um produto 
	*
	* @param Produtos
	**/
	public static function inserirProduto(Produtos $produto){


		return ProdutosControl::inserirProduto($produto);
	}


	/**
	* Atualiza um objeto do tipo Produtos de acordo com o ID passado
	*
	* @param Produtos
	* @return boolean true para sucesso e false para erro
	**/
	public static function atualizarProduto(Produtos $produto){


		return  ProdutosControl::atualizarProduto($produto);

	}

	/**
	* Exclui um objeto do tipo Produtos de acordo com o Id passado
	*
	* @param  Produtos
	* @return bool true para sucesso e false para erro 
	**/
	public static function excluirProduto(Produtos $produto){


		return ProdutosControl::excluirProduto($produto);
	
	}


	/**
	* Retorna uma lista de objetos do tipo Produtos
	*
	* @return Produtos lista de objetos 
	**/
	public static function listarProdutos(){

		return ProdutosControl::listarProdutos();
	}


	/**
	* Retorna um objeto do tipo de Produto de acordo com ID passado
	*
	*@param Produtos
	*@return Produtos objeto do tipo
	*
	**/
	public static function buscarProdutoById(Produtos $produto){


		return ProdutosControl::buscarProdutoById($produto);
	}

}

