<?php
		require ('baza.php');	
		require ('header.php');
		$sql = "SELECT * FROM log";
		$rs = mysql_query($sql) or die (mysql_error());
		
		echo "<table id='logdump' cellspacing='0' cellpadding='0'>";
		echo "<tr>
			<th>zapis</th>
			<th>vrijeme</th></tr>";			
		
		while($row = mysql_fetch_array($rs)) {
			echo "<tr>";
			echo "<td>" . $row['zapis'] . "</td>";
			echo "<td>" . $row['vrijeme'] . "</td>";
			echo "<tr>";
		}
		echo "</table>";
?>