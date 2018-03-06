<?php
		require ('baza.php');	
		require ('header.php');
		$sql = "SELECT * FROM korisnik";
		$rs = mysql_query($sql) or die (mysql_error());
		$brred = mysql_num_rows ($rs);
		
		echo "<table id='users' cellspacing='0' cellpadding='0'>";
		echo "<tr>
			<th>ID</th>
			<th>Lozinka</th>
			<th>Admin</th>
			<th>Korisnicko ime</th>
			<th>E-mail</th>
			<th>Banned</th>
			<th>Deleted</th>
			<th></th>
			<th></th></tr>";			
		
		while($row = mysql_fetch_array($rs)) {
			echo "<tr>";
			echo "<td>" . $row['idkorisnik'] . "</td>";
			echo "<td>" . $row['encryptedPassword'] . "</td>";
			echo "<td>" . $row['admin'] . "</td>";
			echo "<td>" . $row['username'] . "</td>";
			echo "<td>" . $row['email'] . "</td>";
			echo "<td>" . $row['banned'] . "</td>";
			echo "<td>" . $row['deleted'] . "</td>";
		}					
		echo "</table>";
?>