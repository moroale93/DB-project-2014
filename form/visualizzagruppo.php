<?php
	include '../include/header.php';
	include '../include/connection.php';
	$idGruppo=trim($_GET["idGruppo"]);
	$emailsession=trim($_SESSION['username']);
	$result1=mysql_query("select Nome, IdBacheca from Gruppi where IdGruppo='$idGruppo'");
	$name=mysql_result($result1,0,"Nome");
	$idBacheca=mysql_result($result1,0,"IdBacheca");
	echo "<h1>".$name."</h1>";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>LifeON</title>
	</head>
	<body style="background-position-y: 35pt">
		<br/><br/>
		<form action="forminserimentostatogruppo.php" method="get">
			<input type="hidden" id="idGruppo" name="idGruppo" value="<?php echo $idGruppo; ?>"/>
			<input type="submit" value="Posta stato" />
		</form>
		<form action="forminserimentofotogruppo.php" method="get">
			<input type="hidden" id="idGruppo" name="idGruppo" value="<?php echo $idGruppo; ?>"/>
			<input type="submit" value="Posta foto" />
		</form><br />
		<label for="posts">Posts:</label>
		<table border=1 id='posts'>
			<tr>
				<td valign="baseline"><!– tutti gli stati –>
					<?php
						include '../include/tabstatogruppo.php';
					?>
				</td valign="baseline">
				<td><!– tutte le foto –>
					<?php
						include '../include/tabfotogruppo.php';
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
