<?php
	$result=mysql_query("select NumeroBanner from Bacheche natural join Persone where EmailUser='$email'");
	$numban=mysql_result($result,0,"NumeroBanner");
	echo "<table border=1 id='richieste'>";
	echo "";
	$i=0;
	while ($i < $numban) {
	 	echo "<tr><td><img src='../img/$i.png' width=\"140\" height=\"80\"></td></tr>";
	    $i++;
	}
	echo "</table>"; 
?>
