<?php
	include '../include/header.php';
	include '../include/connection.php';
?>
<html>
	<head>
		
	</head>
	<body>
		<form action="../script/confermaamico.php" method="get">
			<legend>Conferma Amicizia:</legend>
			<label for="NomeP">Email Persona*</label>
			<input type="text" id="NomeP" name="NomePersona">
			<input type="submit" id="conferma" value="Conferma amicizia">
		</form>
		<label for="richieste">Richieste Amicizia:</label>
		<?php 
			include '../include/tabaccamici.php';
		?>
	</body>
</html>
