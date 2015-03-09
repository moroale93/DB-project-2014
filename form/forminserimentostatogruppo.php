<?php
	include '../include/header.php';
	$idGruppo=trim($_GET["idGruppo"]);
?>
<html>
	<head>
		
	</head>
	<body>
		<form action="../script/scriptinserimentostatogruppo.php" method="get">
			<input type="hidden" id="idGruppo" name="idGruppo" value="<?php echo $idGruppo; ?>"/>
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