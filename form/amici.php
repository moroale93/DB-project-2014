<?php
	include '../include/header.php';
	include '../include/connection.php';
?>
<html>
	<head>
		
	</head>
	<body>
		<form action="profiloamico.php" method="get">
			<legend>Visualizza profilo di:</legend>
			<label for="MailP">Email Persona*</label>
			<input type="text" id="MailP" name="EmailPersona">
			<input type="submit" id="richiesta" value="Visualizza profilo">
		</form>
		<label for="richieste">Persone che corrispondono alla tua ricerca:</label>
		<?php
			include '../include/tabamici.php';
		?>
		<form action="../script/scriptrimuoviamico.php" method="get">
			<legend><h3>Rimuovi amico:</h3></legend>
			<label for="emaildel">Email Persona*</label>
			<input type="text" id="emaildel" name="EmailPersonaDEL">
			<input type="submit" id="rimuovi" value="RIMUOVI AMICO">
		</form>
	</body>
</html>