<?php
	include '../include/header.php';
	$idGruppo=$_GET['idGruppo'];
?>
<html>
	<head>
		
	</head>
	<body>
		<form action="../script/scriptinserimentofotogruppo.php" enctype="multipart/form-data" method="POST">
			<legend>Inserisci stato:</legend>
			<label for="foto">Foto*</label>
			<input type="hidden" id="idGruppo" name="idGruppo" value="<?php echo $idGruppo; ?>"/>
			<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
			<input name="userfile" type="file" id="userfile">
			<label for="CAP">CAP</label>
			<input type="text" id="CAP" name="CAPLuogo">
			<label for="Citta">Città</label>
			<input type="text" id="Citta" name="CittaLuogo">
			<label for="Altitudine">Altitudine</label>
			<input type="text" id="Altitudine" name="AltitudineLuogo">
			<label for="Nazione">Nazione</label>
			<input type="text" id="Nazione" name="NazioneLuogo">
			<input type="submit" id="richiesta" value="Posta">
		</form>
	</body>
</html>