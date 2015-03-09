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
		<form action="visualizzagruppo.php" method="get">
			<legend>Apri bacheca gruppo:</legend>
			<label for="gruppo">Id Gruppo*</label>
			<input type="text" id="gruppo" name="idGruppo">
			<input type="submit" id="Iscrizione" value="Visualizza">
		</form><br/><br/>
		<label for="richieste">Gruppi di cui fai parte</label>
		<?php
			include '../include/tablegruppi.php';
		?>
		<form action="../script/scriptrimuoviiscrizionegruppo.php" method="get">
			<legend><h3>Rimuovi iscrizione dal gruppo:</h3></legend>
			<label for="idgrdel">Id Gruppo*</label>
			<input type="text" id="idgrdel" name="IdGruppoDEL">
			<input type="submit" id="rimuovi" value="RIMUOVI ISCRIZIONE">
		</form>
	</body>
</html>