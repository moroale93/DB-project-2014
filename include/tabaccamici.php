<?php 
	$emailSessione=trim($_SESSION['username']);
	$result=mysql_query("select p.EmailUser as Email, p.Nome as Nome, p.Cognome as Cognome, p.DataDiNascita as Nato_il from Amicizie natural join Persone p where IdAmico='$emailSessione' AND DataAmicizia is null;");
	$num=mysql_num_rows($result);
	$i=0;
	if($num==0){
		echo "Hai gia' accettato tutte le amicizie.";
	}
	else {
	echo "<table border=2 id='richieste'>";
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
	}
?>
