<?php
include ('header.php');
?>		
		<div id="content">
			<form method="post" name="formular" id="forma" enctype="multipart/form-data" action="obrada.php">
				<table>
					<tr>
						<td><label for="ban" class="labela">Status 1: </label></td>
						<td colspan="3">
							<input type="radio" name="ban" id="ba1" value="0"/><label for="ba1" class="labela">Otkljuèan</label>
							<input type="radio" name="ban" id="ba2" value="1"/><label for="ba2" class="labela">Zakljuèan</label>
						</td>
					</tr>
					<tr>
						<td><label for="del" class="labela">Status 2: </label></td>
						<td colspan="3">
							<input type="radio" name="del" id="de1" value="0"/><label for="de1" class="labela">Postojeæi</label>
							<input type="radio" name="del" id="de2" value="1"/><label for="de2" class="labela">Obrisan</label>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input name="reset" type="reset" value="Oèisti obrazac"/>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input name="test" type="submit" value="Traži"/>
						</td>
					</tr>					
				</table>
			</form>
		</div>