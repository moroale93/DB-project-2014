<?php
	session_start();
	if(!isset($_SESSION['username']))
		header("Location:../index.php");
	echo "<div id=\"header\" style=\"background-color: #00dddd; border-bottom:3pt solid blue; margin-right:-8px; margin-left:-8px; margin-top:-10px; padding:5px 10px 25px 20px;\">
			<font size=\"7\" color=\"white\" face=\"Courier New, Verdana\">
				<a href=\"../first_page.php\" style=\"color: white\"><b>Life<font color=\"blue\">ON</font></b></a>
			</font>
		</div>";
?>