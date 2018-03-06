<?php
include ('header.php');
?>		
		<div id="content">
			<form method="post" name="formular" id="forma" enctype="multipart/form-data" action="obrada.php">
				<table>
					<tr>					
						<td><label for="user" class="labela">Korisničko ime: </label></td>
						<td><input name="user" class="opcija" id="user"/></td>
					</tr>
					<tr>
						<td><label for="mail" class="labela">E-mail: </label></td>
						<td><input name="mail" class="opcija" id="mail"/></td>
					</tr>
					<tr>
						<td><label for="sifra" class="labela">Lozinka: </label></td>
						<td><input type="password" name="sifra" class="opcija" id="sifra"/></td>					
					</tr>
					<tr>
						<td><label for="sifra2" class="labela">Ponovljena lozinka: </label></td>
						<td><input type="password" name="sifra2" class="opcija" id="sifra2"/></td>
					</tr>
					<tr>
						<td><label for="status" class="labela">Status: </label></td>
						<td colspan="3">
							<input type="radio" name="status" id="st1" value="1"/><label for="st1" class="labela">Admin</label>
							<input type="radio" name="status" id="st2" value="2"/><label for="st2" class="labela">Zatvoren</label>
							<input type="radio" name="status" id="st3" value="3"/><label for="st3" class="labela">Obrisan</label>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input name="reset" type="reset" value="Očisti obrazac"/>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input name="edit" type="submit" value="Ažuriraj podatke"/>
						</td>
					</tr>
					
					<?php
						if (isset($_GET['error'])){
							$greska = $_GET['error'];
							if ($greska == 'passcheck'){echo '<p>Unesene lozinke se ne podudaraju.</p>';}
						}
					?>
					
				</table>
			</form>
		</div>