<?php
	$emailSessione=trim($_SESSION['username']);
	$result=mysql_query("select l.CAP as cap,l.Nome as nome,l.Stato as stato,l.Altitudine as altit from Luoghi l where l.CAP <> ALL (select IdLuogo from PersoneLuoghi where EmailUser='$emailSessione')");
	$num=mysql_num_rows($result);
	echo "<table border=1 id='richieste'>";
	echo "<td>CAP</td><td>Nome Luogo</td><td>Nazione</td><td>Altitudine</td></tr>";
	$i=0;
	while ($i < $num) {
	 	echo "<tr>"; 
	    $id=mysql_result($result,$i,"cap");
	    $nome=mysql_result($result,$i,"nome");
	    $stato=mysql_result($result,$i,"stato");
	    $altit=mysql_result($result,$i,"altit");
		echo "<td>".$id."</td><td>".$nome."</td><td>".$stato."</td><td>".$altit."</td>";
	 	echo "</tr>";
	    $i++;
	}
	echo "</table>"; 
?>
