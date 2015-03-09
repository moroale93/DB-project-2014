<?php
	$emailSessione=trim($_SESSION['username']);
	$result=mysql_query("select p.EmailUser as Email, p.Nome as Nome, p.Cognome as Cognome, p.DataDiNascita as Nato_il from Persone p, Amicizie a where ((a.EmailUser ='$emailSessione' AND a.IdAmico=p.EmailUser) OR (a.IdAmico ='$emailSessione' AND a.EmailUser=p.EmailUser)) AND a.DataAmicizia is not null");
	$num=mysql_num_rows($result);
	echo "<table border=2 id='richieste'>";
	echo "<td>Email</td><td>Nome</td><td>Cognome</td><td>Data di Nascita</td></tr>";
	$i=0;
	 while ($i < $num) {
	 	echo "<tr>"; 
	    $id=mysql_result($result,$i,"Email");
	    $nome=mysql_result($result,$i,"Nome");
	    $cognome=mysql_result($result,$i,"Cognome");
	    $data=mysql_result($result,$i,"Nato_il");
		echo "<td>".$id."</td>";
		echo "<td>".$nome."</td>";
		echo "<td>".$cognome."</td>";
		echo "<td>".$data."</td>";
	 	echo "</tr>";
	    $i++;
	 }
	 echo "</table>"; 
?>
