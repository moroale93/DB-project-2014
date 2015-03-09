<?php
	include '../include/header.php';
	include '../include/connection.php';
	$nomeLavoro=trim($_GET["NomeLavoro"]);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>LifeON</title>
	</head>
	<body style="background-position-y: 35pt">
		<form action="../script/scriptlavoro.php" method="get">
			<input type="hidden" id="tipo" name="tipo" value="0">
			<legend>Inserisci id Lavoro se la Lavoro e' gia' presente qui sotto:</legend>
			<label for="Lavoro">Id Lavoro*</label>
			<input type="text" id="Lavoro" name="idLavoro">
			<input type="submit" id="insLavoro" value="inserisci informazione">
			<?php
				include '../include/tabformlavoro.php';
			?>
		</form>
		<form action="../script/scriptlavoro.php" method="get">
			<legend>Altrimenti:</legend>
			<input type="hidden" id="tipo" name="tipo" value="1">
			<input type="hidden" id="NomeLavoro" name="NomeLavoro" value="<?php echo $nomeLavoro;?>">
			<label for="datLavoro">Nome Datore:*</label>
			<input type="text" id="datLavoro" name="nomeDat">
			<label for="DataLavoro">Data Fondazione:</label>
			<input type="date" id="DataLavoro" name="DataLavoro">
			<label for="CAPLuogo">CAP:*</label>
			<input type="text" id="CAPLuogo" name="CAPLuogo">
			<label for="NomeLuogo">Nome Luogo:</label>
			<input type="text" id="NomeLuogo " name="NomeLuogo">
			<label for="Altitudine">Altitudine:</label>
			<input type="text" id="Altitudine " name="Altitudine">
			<label for="stato">Nazione:</label>
			<input type="text" id="stato" name="stato">
			<input type="submit" id="CercaLavoro" value="inserisci informazione">
		</form>
	</body>
</html>
