<?php
	include '../include/header.php';
	include '../include/connection.php';
	$email=trim($_GET["EmailPersona"]);
	$emailsession=trim($_SESSION['username']);
	$isamico=mysql_query("select * from Amicizie where ((EmailUser='$email' and IdAmico='$emailsession') OR (EmailUser='$emailsession' and IdAmico='$email')) and DataAmicizia is not null;");
	if(mysql_num_rows($isamico)==0) header("Location:../first_page.php?avviso=Non%20puoi%20visualizzare%20la%20pagina%20di%20una%20persona%20che%20non%20e%20tua%20amica!");
	$result1=mysql_query("select Nome, Cognome, IdBacheca from Persone where EmailUser='$email'");
	$name=mysql_result($result1,0,"Nome");
	$surname=mysql_result($result1,0,"Cognome");
	$bacheca=mysql_result($result1,0,"IdBacheca");
	echo "Profilo di ".$name." ".$surname;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>LifeON</title>
	</head>
	<body style="background-position-y: 35pt">
		<br/><br/>
		<label for="posts">Posts:</label>
		<table border=1 id='posts'>
			<tr>
				<td valign="baseline"><!– tutti gli stati –>
					<?php
						include '../include/tabstatoprofiloamico.php';
					?>
				</td>
				<td valign="baseline"><!– tutte le foto –>
					<?php
						include '../include/tabfotoamico.php';
					?>
				</td>
				<td valign="baseline"><!– banner pubblicitari –>
					<?php
						include "../include/tabpubblicita.php";
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
