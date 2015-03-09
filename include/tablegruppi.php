<?php
	$emailSessione=trim($_SESSION['username']);
	$result=mysql_query("select g.IdGruppo as id, g.Nome as Nome, g.DataCreazione as Data_creazione from Gruppi g where exists ( select * from GruppiPersone gp where g.IdGruppo=gp.IdGruppo and gp.EmailUser='$emailSessione')");
	$num=mysql_num_rows($result);
	echo "<table border=2 id='richieste'>";
	echo "<tr><td>id</td><td>Nome Gruppo</td><td>Data creazione</td></tr>";
	$i=0;
	 while ($i < $num) {
	 	echo "<tr>"; 
	    $id=mysql_result($result,$i,"id");
	    $nome=mysql_result($result,$i,"Nome");
	    $data=mysql_result($result,$i,"Data_creazione");
		echo "<td>".$id."</td>";
		echo "<td>".$nome."</td>";
		echo "<td>".$data."</td>";
	 	echo "</tr>";
	    $i++;
	 }
	 echo "</table>"; 
?>
