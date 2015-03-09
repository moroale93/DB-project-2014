<?php
	$result2=mysql_query("select p.IdPost as id, p.DataPost as Data, p.Ora as Ora, p.IdLuogo as Luogo, f.Fotografia as foto from Post p natural join Foto f where p.IdBacheca='$bacheca'");
	$num=mysql_num_rows($result2);
	echo "<table border=0>";
	$i=0;
	while ($i < $num) {
	 	echo "<tr>"; 
	    $idPost=mysql_result($result2,$i,"id");
	    $date=mysql_result($result2,$i,"Data");
	    $time=mysql_result($result2,$i,"Ora");
	    $luogos=mysql_result($result2,$i,"Luogo");
	    $foto=mysql_result($result2,$i,"foto");
		echo "<td>".$date." ".$time;
		if(isset($luogos)){
			$cittaresult= mysql_query("select Nome from Luoghi where CAP='$luogos'");
			echo " - presso: ".mysql_result($cittaresult,0,"Nome");;
		}
		echo "<br/>";
		echo '<img src="data:image/jpg;base64,' . base64_encode( $foto ) . '" />';
		echo "</td>";	
				
		$esistelike= mysql_query("select count(*) as exist from Likes l where l.EmailUser='$emailsession' AND l.IdPost='$idPost'");
		$exist=mysql_result($esistelike,0,"exist");
		if(!$exist){
			echo "<td><a href=\"../script/scriptlike.php?idpost=$idPost&email=$email\"><img style=\"border:0;\" src=\"../img/like.png\" width=\"28\" height=\"28\"></a></td></tr>";
		}
		else{
			echo "<td><img style=\"border:0;\" src=\"../img/like2.png\" width=\"28\" height=\"28\"></td></tr>";
		}
								
		$hamessolike= mysql_query("select p.Nome as name, p.Cognome as surname from Likes l natural join Persone p where l.IdPost='$idPost'");
		$numlike=mysql_num_rows($hamessolike);
		$x=0;
		if($numlike)
			echo "<tr><td>Ha messo mi piace: ";
		while ($x < $numlike) {
		    $nomelike=mysql_result($hamessolike,$x,"name");
		    $cognlike=mysql_result($hamessolike,$x,"surname");
			echo $nomelike." ".$cognlike."; ";
			$x++;					
		}
		echo "</td><td></td></tr><tr><td height=\"30\"></td><td></td></tr>";
	    $i++;
	}
	echo "</table>";
?>
