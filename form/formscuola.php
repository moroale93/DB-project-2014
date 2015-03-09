<?php
	include '../include/header.php';
	include '../include/connection.php';
	$nomescuola=trim($_GET["NomeScuola"]);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>LifeON</title>
	</head>
	<body style="background-position-y: 35pt">
		<form action="../script/scriptscuola.php" method="get">
			<input type="hidden" id="tipo" name="tipo" value="0">
			<legend>Inserisci id scuola se la scuola e' gia' presente qui sotto:</legend>
			<label for="Scuola">Id Scuola*</label>
			<input type="text" id="Scuola" name="idscuola">
			<input type="submit" id="insScuola1" value="inserisci informazione">
			<?php
				include '../include/tabscuola.php';
			?>
		</form>
		<form action="../script/scriptscuola.php" method="get">
			<legend>Altrimenti:</legend>
			<input type="hidden" id="tipo" name="tipo" value="1">
			<input type="hidden" id="NomeScuola" name="NomeScuola" value="<?php echo $nomescuola;?>">
			<label for="GradoScuola">Grado:*</label>
			<input type="text" id="GradoScuola" name="GradoScuola">
			<label for="DataScuola">Data Fondazione:</label>
			<input type="date" id="DataScuola" name="DataScuola">
			<label for="CAPLuogo">CAP:*</label>
			<input type="text" id="CAPLuogo" name="CAPLuogo">
			<label for="NomeLuogo">Nome Luogo:</label>
			<input type="text" id="NomeLuogo " name="NomeLuogo">
			<label for="Altitudine">Altitudine:</label>
			<input type="text" id="Altitudine " name="Altitudine">
			<label for="stato">Nazione:</label>
			<input type="text" id="stato" name="stato">
			<input type="submit" id="CercaScuola" value="inserisci informazione">
		</form>
	</body>
</html>
