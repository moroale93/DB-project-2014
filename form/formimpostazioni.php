<?php
	include '../include/header.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>LifeON</title>
	</head>
	<body style="background-position-y: 35pt">
		<table border="1">
			<tr>
				<td>
					<form action="formscuola.php" method="get">
						<legend>Inserisci scuola che frequenti:</legend>
						<label for="NomeScuola">Nome Scuola*</label>
						<input type="text" id="NomeScuola" name="NomeScuola">
						<input type="submit" id="CercaScuola" value="Cerca">
					</form>
				</td>
				<td>
					<form action="formlavoro.php" method="get">
						<legend>Inserisci prosto di Lavoro:</legend>
						<label for="NomeLavoro">Nome Posto di Lavoro*</label>
						<input type="text" id="NomeLavoro" name="NomeLavoro">
						<input type="submit" id="CercaLavoro" value="Cerca">
					</form>
				</td>
			</tr>
		</table><br /><br />
		<a href="../script/eliminaaccount.php" ><button>Rimuovi Account</button></a>
	</body>
</html>
