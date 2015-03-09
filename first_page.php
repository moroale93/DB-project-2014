<?php
	session_start();
	if(!isset($_SESSION['username']))
		header("Location:../index.php");
	echo "<div id=\"header\" style=\"background-color: #00dddd; border-bottom:3pt solid blue; margin-right:-8px; margin-left:-8px; margin-top:-10px; padding:5px 10px 25px 20px;\">
			<font size=\"7\" color=\"white\" face=\"Courier New, Verdana\">
				<b>Life<font color=\"blue\">ON</font></b>
			</font>
		</div>";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>LifeON</title>
	</head>
	<body style="background-position-y: 35pt">
		<h4>
			<?php if(isset($_GET['avviso'])) echo $_GET['avviso'];?>
		</h4>
		<div>
			<a href="script/logout.php"><img style="border:0;" src="img/logout.png" width="45" height="45" align="right"></a><br />
		</div>
		<div>
			<a href="form/own_diary.php"><img style="border:0;" src="img/profile.png" width="180" height="60"></a><br /><br />
			<a href="form/formcreagruppo.php"><img style="border:0;" src="img/creategroup.png" width="300" height="60"></a>
			<a href="form/formiscrizionegruppo.php"><img style="border:0;" src="img/menagegroup.png" width="300" height="60"></a>
			<a href="form/gruppi.php"><img style="border:0;" src="img/group.png" width="180" height="60"></a><br /><br />
			<a href="form/amicizie.php"><img style="border:0;" src="img/menagefriend.png" width="300" height="60"></a>
			<a href="form/amici.php"><img style="border:0;" src="img/friend.png" width="180" height="60"></a><br />
		</div>
	</body>
</html>
