<?php
include ('header.php');
?>
		<div id="content">
			<form method="post" name="login" id="login" action="obrada.php">							
				<table>
					<tr>
					<td><label for="loguser" class="labela">Korisničko ime: </label></td>
					<td><input type="text" name="loguser" class="opcija" id="loguser"/></td>
					</tr>
					<tr>
					<td><label for="sifra3" class="labela">Lozinka: </label></td>
					<td><input type="password" name="sifra3" class="opcija" id="sifra3"/></td>
					</tr>
					<tr>
					<td colspan="2"><input name="prijavi" type="submit" value="Login" id="prijavi"/></td>
					</tr>
				</table>
			</form>	
				<?php
					if (isset($_GET['error'])){
						$greska = $_GET['error'];
						if ($greska == 'data'){echo '<p>Krivi korisnički podaci. Molimo ponovite unos.</p>';}
						if ($greska == 'deleted'){echo '<p>Vaš račun je obrisan od strane administratora.</p>';}
						if ($greska == 'banned'){echo '<p>Vaš račun je blokiran od strane administratora.</p>';}
					}
				?>
		</div>