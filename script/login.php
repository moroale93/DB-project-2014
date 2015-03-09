<?php
	$email=trim($_POST['user']);
	$password=$_POST['psw'];
	$passwordIN=sha1($password);
	echo $passwordIN;
	include '../include/connection.php';
	$query="select Psw as password from Persone where EmailUser='$email' and Psw='$passwordIN'";
	$result=mysql_query($query);
	if(mysql_num_rows($result)==1){
		session_start();
		$_SESSION['username']=$email;
		header("Location:../first_page.php");
	}
	else {
		header("Location:../index.php?avviso=Email%20o%20Password%20errata");
	}
	mysql_close();
?>
