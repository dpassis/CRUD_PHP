<?php
function __autoload($class_name){
	require_once 'classes/model/' . $class_name . '.php';
}
?>



<!DOCTYPE html>

<html >
<head>
	<meta charset="UTF-8">
	<title>Exemplo CRUD PHP</title>
	<script type="text/javascript">

	function clearFields(){

		window.location = 'index.php';
		

		document.getElementById('idProduto').value = '';
		document.getElementById('descricao').value = '';
		document.getElementById('valor').value = '';
		document.getElementById('vencimento').value = '';
		document.getElementById('categoria').value = 0;
	}
	</script>

	<script type="text/javascript">
	function verifySelect(){

		if(document.getElementById('categoria').value == 0){

			alert('Selecione uma categoria!');
			return false;
		}else{

			return true;
		}

	}
	</script>

	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.maskedinput-1.2.2-co.min.js"></script>
	<script type="text/javascript" src="js/jquery.maskMoney.js"></script>

	<script type="text/javascript">
	jQuery(function($){
		$("#vencimento").mask("99/99/9999");
	});
	</script>
	<script type="text/javascript">
	jQuery(function(){
		$("#valor").maskMoney({allowZero:false, allowNegative:false, defaultZero:true});
	});

	</script>
</head>
<body>

	<?php

	$produtos = new Produtos();

	if(isset($_GET['action']) && $_GET['action'] == 'del'):

		$produtos->setIdProduto ((int)$_GET['id']);
	if(Produtos::excluirProduto($produtos)){
		echo "Deletado com sucesso!";
		header('Location: index.php');
	}else{
		header('Location: error.php?cod=3');
	}

	endif;
	?>

	<?php
	if(isset($_GET['action']) && $_GET['action'] == 'edit'){

		$produtos->setIdProduto((int)$_GET['id']);

		$prodResult = new Produtos();
		$prodResult =  $produtos->buscarProdutoById($produtos);

		?>

		<h2>Formulário de Cadastro Produtos</h2>
		<form method="post" action="envia.php" style="border: 1px solid; width: 400px;">
			<table>
				<tr>
					
					<input id="idProduto"  name="idProduto" value="<?php echo $prodResult->getIdProduto(); ?>" type="hidden">
					
					<td>
						<label for"descricao">Descrição:</label>
					</td>
					<td>
						<input id="descricao"  type="text"  value="<?php echo $prodResult->getDescricao(); ?>" name="descricao">
					</td>
				</tr>
				<tr>
					<td>
						<label for="valor">Valor:</label>
					</td>
					<td>
						<input id="valor" type="text" value="<?php echo $prodResult->getValor(); ?>" name="valor">
					</td>	
				</tr>
				<tr>
					<td>
						<label for="vencimento">Data Vencimento:</label>
					</td>
					<td>
						<input  id="vencimento" type="text" value="<?php $date = date_create($prodResult->getVencimento()); echo date_format($date,'d/m/Y'); ?>" name="vencimento">
					</td>
				</tr>
				<tr>
					<td>
						<label for="categoria">Categoria</label>
					</td>
					<td>
						<select  id="categoria" name="categoria" "<?php echo $prodResult->getCategoria()->getIdCategoria(); ?>">
							<option value="0">Selecione</option>
							<?php
							$categoriaProduto = new CategoriaProduto();

							foreach ($categoriaProduto->listaCategoriaProdutos() as $categoria) :?>
							<option <?php if($categoria->getIdCategoria() == $prodResult->getCategoria()->getIdCategoria()){echo("selected");}?> value="<?php echo $categoria->getIdCategoria();?>"><?php echo $categoria->getDescCategoria();?></option>
						<?php endforeach;?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="center">
					<input type="submit" value="Atualizar">
				</td>
				<td>
					<input type="button" value="Limpar" onclick ="clearFields()" >
				</td>
			</tr>


		</table>
	</form>
	<br style="clear:both;">
	<br style="clear:both;">


	<?php }else{ ?>


	<h2>Formulário de Cadastro Produtos</h2>
	<form method="post" action="envia.php" style="border: 1px solid; width: 400px;">
		<table>
			<tr>
				<td>
					<label for"descricao">Descrição:</label>
				</td>
				<td>
					<input id="descricao"  type="text"  name="descricao" required>
				</td>
			</tr>
			<tr>
				<td>
					<label for="valor">Valor:</label>
				</td>
				<td>
					<input id="valor" type="text" name="valor" required>
				</td>	
			</tr>
			<tr>
				<td>
					<label for="vencimento">Data Vencimento:</label>
				</td>
				<td>
					<input  id="vencimento" type="text" name="vencimento" required>
				</td>
			</tr>
			<tr>
				<td>
					<label for="categoria">Categoria</label>
				</td>
				<td>
					<select  id="categoria" name="categoria">
						<option value="0">Selecione</option>
						<?php
						$categoriaProduto = new CategoriaProduto();

						foreach ($categoriaProduto->listaCategoriaProdutos() as $categoria) :?>
						<option value="<?php echo $categoria->getIdCategoria();?>"><?php echo $categoria->getDescCategoria();?></option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td align="center">
				<input type="submit" value="Salvar" onclick = "return verifySelect();">
			</td>
			<td>
				<input type="button" value="Limpar" onclick ="clearFields()" >
			</td>
		</tr>


	</table>
</form>
<br style="clear:both;">
<br style="clear:both;">

<?php }?>

<table name="Produtos" border="1px">

	<tr>
		<th>
			Descrição
		</th>
		<th>
			Valor
		</th>
		<th>
			Data de Vencimento
		</th>
		<th>
			Categoria
		</th>
		<th colspan="2">
			Opções
		</th>
	</tr>
	<?php
	

	foreach ($produtos->listarProdutos() as $prods) : ?>
	<tr>
		<td>
			<?php echo	$prods->getDescricao(); ?>
		</td>
		<td>
			<?php echo	$prods->getValor(); ?>
		</td>
		<td>
			<?php
			$date = date_create($prods->getVencimento());

			echo	date_format($date,'d/m/Y'); ?>
		</td>
		<td>
			<?php echo	$prods->getCategoria()->getDescCategoria(); ?>
		</td>
		<td>
			<?php echo "<a href='index.php?action=edit&id=".$prods->getIdProduto() ."'>Editar</a>"; ?>
		</td>
		<td>
			<?php echo "<a href='index.php?action=del&id=".$prods->getIdProduto() ."'onClick='return confirm(\"Deseja realmente excluir?\")'>Excluir</a>"; ?>
		</td>
	</tr>
<?php endforeach; ?>

</table>

</body>
</html>

