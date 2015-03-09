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
		<form action="../script/scriptluogo.php" method="get">
			<input type="hidden" id="tipo" name="tipo" value="0">
			<legend>Inserisci il cap se il luogo e' gia' presente qui sotto:</legend>
			<label for="cap">CAP*</label>
			<input type="text" id="cap" name="cap">
			<input type="submit" id="insluogo" value="inserisci informazione">
			<?php
				include '../include/tabinserimentovisita.php';
			?>
		</form>
		<form action="../script/scriptluogo.php" method="get">
			<legend>Altrimenti:</legend>
			<input type="hidden" id="tipo" name="tipo" value="1">
			<label for="CAPLuogo">CAP:*</label>
			<input type="text" id="CAPLuogo" name="CAPLuogo">
			<label for="NomeLuogo">Nome Luogo:</label>
			<input type="text" id="NomeLuogo " name="NomeLuogo">
			<label for="Altitudine">Altitudine:</label>
			<input type="text" id="Altitudine " name="Altitudine">
			<label for="stato">Nazione:</label>
			<input type="text" id="stato" name="stato">
			<input type="submit" id="insluogoo" value="inserisci informazione">
		</form>
	</body>
</html>