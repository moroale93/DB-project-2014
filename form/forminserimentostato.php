<?php
	include '../include/header.php';
?>
<html>
	<head>
		
	</head>
	<body>
		<form action="../script/scriptinserimentostato.php" method="get">
			<legend>Inserisci stato:</legend>
			<label for="Stato">Stato*</label>
			<input type="text" id="Stato" name="statoInserito">
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