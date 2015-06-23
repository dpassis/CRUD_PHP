<?php


require_once('classes/control/CategoriaProdutoControl.php');

class CategoriaProduto {

	private $idCategoria;
	private $descCategoria;


	public function setIdCategoria($id){

		$this->idCategoria = $id;

	}


	public function getIdCategoria(){

		return $this->idCategoria;
	}


	public function setDescCategoria($desc){

		$this->descCategoria = $desc;
	}


	public function getDescCategoria(){


		return $this->descCategoria;
	}


	public static function listaCategoriaProdutos(){

		$categoria = new CategoriaProdutoControl();

		return $categoria->listarCategoriasProdutos();

	}


}