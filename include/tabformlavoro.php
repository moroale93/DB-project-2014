<?php
	$emailSessione=trim($_SESSION['username']);
	$result=mysql_query("select l.IdImpresa as idl, l.Nome as Nomel, l.NomeDatore as nomeDatore, lg.Nome as Nomel from Luoghi lg join PostiDilavoro l on l.IdLuogo=lg.CAP where l.Nome='$nomeLavoro' ");
	$num=mysql_num_rows($result);
	echo "<table border=1 id='richieste'>";
	echo "<td>id</td><td>Nome</td><td>Datore</td><td>luogo</td></tr>";
	$i=0;
	while ($i < $num) {
	 	echo "<tr>"; 
	    $id=mysql_result($result,$i,"idl");
	    $nome=mysql_result($result,$i,"Nomel");
	    $dat=mysql_result($result,$i,"nomeDatore");
	    $luogo=mysql_result($result,$i,"Nomel");
		echo "<td>".$id."</td>";
		echo "<td>".$nome."</td>";
		echo "<td>".$dat."</td>";
		echo "<td>".$luogo."</td>";
	 	echo "</tr>";
	    $i++;
	}
	echo "</table>"; 
?>
