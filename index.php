<?php
session_start();
	if(isset($_SESSION['username']))
		header("Location:first_page.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>LifeON</title>
	</head>
	<body style="background-position-y: 35pt;">
		<div id="header" style="background-color: #00dddd; border-bottom:3pt solid blue; margin-right:-8px; margin-left:-8px; margin-top:-10px; padding:5px 10px 25px 20px;">
			<font size="7" color="white" face="Courier New, Verdana">
				<b>Life<font color="blue">ON</font></b>
			</font>
		</div>
		<div>
			<form action="script/login.php" method="post">
				<legend>Accedi:</legend>
				<label for="email">Email*</label>
				<input type="text" id="email" name="user">
				<label for="password">Password*</label>
				<input type="password" id="password" name="psw">
				<input type="submit" id="login" value="Login">
			</form>
		</div>
		<h4>
			<font color="red" face="Courier New, Verdana">
				<?php if(isset($_GET['avviso'])) echo $_GET['avviso'];?>
			</font>
		</h4>
		<div>
			<form action="script/register.php" method="post">
				<legend>Registrati:</legend>
				<label for="remail">Email*</label>
				<input type="text" id="remail" name="user">
				<label for="rpassword">Password*</label>
				<input type="password" id="rpassword" name="psw">
				<label for="rpasswordcon">Conferma Password*</label>
				<input type="password" id="rpasswordcon" name="pswcon">
				<label for="rnome">Nome*</label>
				<input type="text" id="rnome" name="nome">
				<label for="rcognome">Cognome*</label>
				<input type="text" id="rcognome" name="cognome">
				<label for="rdata">Data di nascita*</label>
				<input type="date" id="rdata" name="data">
				<input type="submit" id="rlogin" value="Register">
			</form>
		</div>
	</body>
</html>
