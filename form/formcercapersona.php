<?php
	include '../include/header.php';
	include '../include/connection.php';
?>
<html>
	<head>
		
	</head>
	<body>
		<form action="../script/chiediamicizia.php" method="get">
			<legend>Richiedi Amicizia:</legend>
			<label for="NomeP">Email Persona*</label>
			<input type="text" id="NomeP" name="NomePersona">
			<input type="submit" id="richiesta" value="Richiedi amicizia">
		</form>
		<label for="richieste">Persone che corrispondono alla tua ricerca:</label>
		<?php
			include '../include/tabcercapersona.php';
		?>
	</body>
</html>
