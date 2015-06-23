<?php
function __autoload($class_name){
	require_once 'classes/model/' . $class_name . '.php';
}

#instância do objeto do Tipo Produto
$produto  = new Produtos();

#recupera via POST o id Produto
if (isset($_POST["idProduto"])) {
	$produto->setIdProduto($_POST["idProduto"]);
}

#recupera via POST a descrição do Produto
if (isset($_POST["descricao"])) {
	$produto->setDescricao($_POST["descricao"]);
}

#recupera via POST o valor do Produto
if(isset($_POST["valor"])){

	$produto->setValor($_POST["valor"]);
}

#recupera via POST a data de vencimento do Produto
if(isset($_POST["vencimento"])){

	$produto->setVencimento($_POST["vencimento"]);

}

#recupera via POST a categoria do Produto
if(isset($_POST["categoria"])){

	#instância do objeto CategoriaProduto
	$categoria = new CategoriaProduto();
	
	$categoria->setIdCategoria($_POST["categoria"]);
	$categoria->setDescCategoria("Perecível");

	$produto->setCategoria($categoria);

}

/** Verifica se é update ou insert **/
if(isset($_POST["idProduto"])){

		#atualiza o registro selecionado
		if(Produtos::atualizarProduto($produto)){

		 	header('Location: index.php');
		 	print('<h2>Inserido </h2>');

		 }else{

		  header('Location: error.php?cod=1');
		}


}else{
		#insere um novo registro
		if(Produtos::inserirProduto($produto)){

		 	header('Location: index.php');
		 	
		 }else{

		 	header('Location: error.php?cod=2');
		 }
}

?>