<?php
	$emailSessione=trim($_SESSION['username']);
	$result=mysql_query("select s.IdScuola as ids, s.Nome as Nomes, s.Grado as Grados, l.Nome as Nomel from Luoghi l join Scuole s on s.IdLuogo=l.CAP where s.Nome='$nomescuola' ");
	$num=mysql_num_rows($result);
	echo "<table border=1 id='richieste'>";
	echo "<td>id</td><td>Nome</td><td>grado</td><td>luogo</td></tr>";
	$i=0;
	while ($i < $num) {
	 	echo "<tr>"; 
	    $id=mysql_result($result,$i,"ids");
	    $nome=mysql_result($result,$i,"Nomes");
	    $grado=mysql_result($result,$i,"Grados");
	    $luogo=mysql_result($result,$i,"Nomel");
		echo "<td>".$id."</td>";
		echo "<td>".$nome."</td>";
		echo "<td>".$grado."</td>";
		echo "<td>".$luogo."</td>";
	 	echo "</tr>";
	    $i++;
	}
	echo "</table>"; 
?>
