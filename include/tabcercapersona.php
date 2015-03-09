<?php
	$emailSessione=trim($_SESSION['username']);
	$Nome=trim($_GET["NomePersona"]);
	$Cognome=trim($_GET["CognomePersona"]);
	$result=mysql_query("select p.EmailUser as Email, p.Nome as Nome, p.Cognome as Cognome, p.DataDiNascita as Nato_il from Persone p where not exists (select p.EmailUser from Amicizie a where a.IdAmico='$emailSessione' and p.EmailUser=a.EmailUser) AND not exists(select p.EmailUser from Amicizie a where a.EmailUser='$emailSessione' and p.EmailUser=a.IdAmico) AND p.EmailUser <> '$emailSessione' AND p.Nome='$Nome' And p.Cognome='$Cognome'");
	$num=mysql_num_rows($result);
	echo "<table border=2 id='richieste'>";
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
