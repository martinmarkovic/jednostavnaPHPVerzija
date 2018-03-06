<?php
include ('header.php');
?>		
		<div id="content">
			<form method="post" name="formular" id="forma" enctype="multipart/form-data" action="obrada.php">
				<table>
					<tr>
						<td><label for="kime" class="labela">Username: </label></td>
						<td><input name="kime" class="opcija" id="kime"/></td>
					</tr>
					<tr>
						<td colspan="2">
							<input name="kill" type="submit" value="Obriši usera"/>
						</td>
					</tr>					
				</table>
			</form>
		</div>