<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>Error Page</title>

</head>
<body>

	<?php
		if(isset($_GET['cod']) && $_GET['cod'] == '1'){

			echo 'Erro ao inserir!';
			echo '<br>';
			echo "<a href='index.php'>Voltar</a>";

		}else if(isset($_GET['cod']) && $_GET['cod'] == '2'){

			echo 'Erro ao atualizar!';
			echo '<br>';
			echo "<a href='index.php'>Voltar</a>";

		}else if(isset($_GET['cod']) && $_GET['cod'] == '3'){
			echo 'Erro ao excluir!';
			echo '<br>';
			echo "<a href='index.php'>Voltar</a>";
		}

	?>

</body>

</html>