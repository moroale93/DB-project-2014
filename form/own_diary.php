<?php
	include '../include/header.php';
	include '../include/connection.php';
	$email=trim($_SESSION['username']);
	$result1=mysql_query("select Nome, Cognome, IdBacheca from Persone where EmailUser='$email'");
	$name=mysql_result($result1,0,"Nome");
	$surname=mysql_result($result1,0,"Cognome");
	$bacheca=mysql_result($result1,0,"idBacheca");
	echo "<br /><br />Sei nel tuo profilo ".$name." ".$surname;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>LifeON</title>
	</head>
	<body style="background-position-y: 35pt">
		<a href="formimpostazioni.php" ><img style="border:0;" align="right" src="../img/impo.png" width="120" height="120"></a><br /><br />
		<a href="forminserimentostato.php"><img style="border:0;" src="../img/stato.png" width="160" height="40"></a>
		<a href="forminserimentofoto.php"><img style="border:0;" src="../img/foto.png" width="160" height="40"></a>
		<a href="forminserimentovisita.php"><img style="border:0;" src="../img/luogo.png" width="160" height="40"></a><br />
		<label for="posts">Posts:</label>
		<table border=1 id='posts'>
			<tr>
				<td valign="baseline"><!– tutti gli stati –>
					<?php
						include '../include/tabstatiownprofile.php';
					?>
				</td valign="baseline">
				<td><!– tutte le foto –>
					<?php
						include '../include/tabfotoownprofile.php';
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
