<?php
	include '../include/header.php';
	include '../include/connection.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>LifeON</title>
	</head>
	<body style="background-position-y: 35pt">
		<form action="../script/scriptiscrizionegruppo.php" method="get">
			<legend>Iscriviti a Gruppo:</legend>
			<label for="gruppo">Id Gruppo*</label>
			<input type="text" id="gruppo" name="idGruppo">
			<input type="submit" id="Iscrizione" value="Iscriviti">
		</form><br/><br/>
		<label for="richieste">Gruppi di cui non fai parte</label>
		<?php
			include '../include/tabiscrizionegruppo.php';
		?>
	</body>
</html>