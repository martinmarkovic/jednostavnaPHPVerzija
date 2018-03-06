<?php
include ('header.php');
?>		
		<div id="content">
			<form method="post" name="formular" id="forma" enctype="multipart/form-data" action="obrada.php">
				<table>
					<tr>
						<td><label for="user" class="labela">Korisničko ime: </label></td>
						<td><input name="user" class="opcija" id="user"/></td>	
						<td id="err3"></td>
					</tr>
					<tr>
						<td><label for="mail" class="labela">E-mail: </label></td>
						<td><input name="mail" class="opcija" id="mail"/></td>
						<td id="err4"></td>
					</tr>
					<tr>
						<td><label for="sifra" class="labela">Lozinka: </label></td>
						<td><input type="password" name="sifra" class="opcija" id="sifra"/></td>
						<td id="err5"></td>
					</tr>
					<tr>
						<td><label for="sifra2" class="labela">Ponovljena lozinka: </label></td>
						<td><input type="password" name="sifra2" class="opcija" id="sifra2"/></td>
						<td id="err6"></td>
					</tr>
					<tr>
						<td colspan="2">
							<input name="reset" type="reset" value="Očisti obrazac"/>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input name="registriraj" type="submit" value="Registiraj me"/>
						</td>
					</tr>
					
					<?php
						if (isset($_GET['error'])){
							$greska = $_GET['error'];
							if ($greska == 'empty'){echo '<p>Niste popunili sva polja.</p>';}
							if ($greska == 'passcheck'){echo '<p>Unesene lozinke se ne podudaraju.</p>';}
							if ($greska == 'exists'){echo '<p>Korisnik već postoji u bazi podataka.</p>';}
						}
					?>
					
				</table>
			</form>
		</div>