<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<title>Document</title>
</head>
<body>
	<?php header("Content-Type: text/html; charset=ISO-8859-1",true);?> 
	<?php
	if (isset($_GET['search'])) {
		$universidade = $_GET['search'];
		include './../connection.php';
		//echo $universidade;
		$tema;

		$result_cat_post = "SELECT * FROM temas_redacao WHERE modelo_tema = '$universidade'";
		echo $universidade;
		$resultado_cat_post = mysqli_query($conn, $result_cat_post);
		while($row_cat_post = mysqli_fetch_assoc($resultado_cat_post) ) {
			$tema = utf8_decode($row_cat_post['nome_tema']);
				echo '<option value="'.$tema.'">'.$tema.'</option>';
		}
	}

	?>
</body>
</html>
