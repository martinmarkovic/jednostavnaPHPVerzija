<?php
	session_start();
	if(isset($_POST['registriraj'])) {																// kad se klikne "predaj"				
			require_once("baza.php");
			$reg_kor_ime = mysql_real_escape_string($_POST['user']);
			$reg_email = mysql_real_escape_string($_POST['mail']);
			$reg_lozinka = mysql_real_escape_string($_POST['sifra']);
			$reg_lozinka2 = mysql_real_escape_string($_POST['sifra2']);
			
			$user_check = "SELECT * FROM korisnik WHERE username = '$reg_kor_ime'";		// pripremi upit za provjeru postojanja korisnika
			$rezultat = mysql_query($user_check) or die (mysql_error());						// izvrši upit i spremi rezultat, prekini ako dođe do greške
			$red = mysql_fetch_array($rezultat);												// izvadi podatke o korisniku u varijablu

			if (empty($reg_kor_ime) || empty($reg_email) || empty($reg_lozinka)) {				// ako fali podatak
				header("Location:registracija.php?error=empty");							// ispiši grešku i ponovno prikaži obrazac
			} 
			
			elseif ($reg_lozinka <> $reg_lozinka2){												// ako lozinke nisu iste
				header("Location:registracija.php?error=passcheck");						// ispiši grešku i ponovno prikaži obrazac
			}
			
			elseif (!empty($red)){																// ako rezultat upita nije prazan (korisnik postoji)
				header("Location:registracija.php?error=exists");						// ispiši grešku i ponovno prikaži obrazac
			}
			
			else{ 																				// ako su sve provjere prošle			
				require("baza.php");
				$reg_sql = "INSERT INTO korisnik (email, username, encryptedPassword)  VALUES 
												 ('$reg_email','$reg_kor_ime','$reg_lozinka')";	
				$izvedi= mysql_query($reg_sql) or die (mysql_error());
				
				$sql = "INSERT INTO log (zapis) VALUES ('Korisnik $reg_kor_ime se registrirao sa sljedećim podacima: 
						lozinka-$reg_lozinka, mail-$reg_email')";
				$rs = mysql_query($sql) or die (mysql_error());
				
				header('Location:login.php') ; 
			}
	}
	
	if(isset($_POST['prijavi'])){												//kad se klikne "prijavi se"
		require "baza.php";
	
		$username = mysql_real_escape_string($_POST['loguser']);
		$pass = mysql_real_escape_string($_POST['sifra3']);
		
		$sql= "SELECT * FROM korisnik WHERE 
			   username = '$username' AND encryptedPassword = '$pass'";
		$sql_provjerilogin = mysql_query($sql);
		$red = mysql_fetch_array($sql_provjerilogin);
			
		if(mysql_num_rows($sql_provjerilogin) == 1)	{  							//ako je provjera prošla						 
			if (($red['deleted']==0) && ($red['banned']==0)){					//ako je useru koji je u sesiji račun aktiviran
				$_SESSION['kor1'] = $username;									//dodaj ime useru u sessionu
				$_SESSION['userid'] = $red['idkorisnik'];						//dodaj id useru u sessionu
				
				$sql = "INSERT INTO log (zapis) VALUES ('Korisnik $username se uspješno prijavio.')";
				$rs = mysql_query($sql) or die (mysql_error());
				header('Location:pocetna.php');
			}
			else if ($red['deleted']==1) {								//ako obrisan
				$sql = "INSERT INTO log (zapis) VALUES ('Korisnik $username se nije uspio prijaviti jer mu je račun obrisan.')";
				$rs = mysql_query($sql) or die (mysql_error());
				header("Location:login.php?error=deleted");
			}
			else  {														//ako blokiran
				$sql = "INSERT INTO log (zapis) VALUES ('Korisnik $username se nije uspio prijaviti jer mu je račun blokiran.')";
				$rs = mysql_query($sql) or die (mysql_error());
				header("Location:login.php?error=banned");
			}
		}  
		else {  																//ako provjera nije prošla
			$sql = "INSERT INTO log (zapis) VALUES ('Neuspjeli pokušaj prijavljivanja u račun $username - krivi podaci.')";
			$rs = mysql_query($sql) or die (mysql_error());
			header("Location:login.php?error=data");
		}  
	}
	if(isset($_GET['logout'])) {												//ako korisnik zatraži odjavu
		$username = $_SESSION['kor1'];
		require_once "baza.php";
		$sql = "INSERT INTO log (zapis) VALUES ('Korisnik $username se odjavio.')";
		$rs = mysql_query($sql) or die (mysql_error());
		unset($_SESSION['kor1']);												//izbaci korisnika iz sesije
		unset($_SESSION['userid']);
		session_destroy();														//i uništi sesiju
		header("Location:pocetna.php");
	}
	if(isset($_POST['edit'])) {																// kad se klikne "ažuriraj"				
			require_once("baza.php");
			$edit_kor_ime = mysql_real_escape_string($_POST['user']);
			$edit_email = mysql_real_escape_string($_POST['mail']);
			$edit_lozinka = mysql_real_escape_string($_POST['sifra']);
			$edit_lozinka2 = mysql_real_escape_string($_POST['sifra2']);
			
			if (!empty($edit_lozinka)){
				if ($edit_lozinka <> $edit_lozinka2){												// ako lozinke nisu iste
					header("Location:korisnikedit.php?error=passcheck");							// ispiši grešku i ponovno prikaži obrazac
				}
			}
						
				require("baza.php");																						// pristupi bazi
				if (!empty($edit_email)){
					$edit_sql = "UPDATE korisnik SET mail='$edit_email' WHERE username='$edit_kor_ime'";					//uredi mail u bazi
					$izvedi= mysql_query($edit_sql) or die (mysql_error());
				}
				if (!empty($edit_lozinka)){
					$edit_sql = "UPDATE korisnik SET lozinka='$edit_lozinka' WHERE username='$edit_kor_ime'";				//uredi lozinku u bazi
					$izvedi= mysql_query($edit_sql) or die (mysql_error());
				}
				if (!empty($status)){
					if($status==1){$edit_sql = "UPDATE korisnik SET admin='1',banned='0',deleted='0' WHERE username='$edit_kor_ime'";}
					if($status==2){$edit_sql = "UPDATE korisnik SET admin='0',banned='1',deleted='0' WHERE username='$edit_kor_ime'";}
					else {$edit_sql = "UPDATE korisnik SET admin='0',banned='0',deleted='1' WHERE username='$edit_kor_ime'";}
					$izvedi= mysql_query($edit_sql) or die (mysql_error());
				}
				$sql = "INSERT INTO log (zapis) VALUES ('Korisnik $edit_kor_ime je promijenio svoje podatke.')";
				$rs = mysql_query($sql) or die (mysql_error());
				echo "Promjena podataka je uspjela. Nastavite klikom na  <a href='pocetna.php'>link</a>";				
	}
	if(isset($_POST['test'])) {																// kad se klikne "ažuriraj"				
		require_once("baza.php");
		$band = mysql_real_escape_string($_POST['ban']);
		$deld = mysql_real_escape_string($_POST['del']);
			
		$sql = "SELECT * FROM korisnik WHERE deleted='$deld' AND banned='$band'";
		$rs = mysql_query($sql) or die (mysql_error());
		$brred = mysql_num_rows ($rs);
		
		echo "<table id='users' cellspacing='0' cellpadding='0'>";
		echo "<tr>
			<th>ID</th>
			<th>Lozinka</th>
			<th>Status</th>
			<th>Korisnicko ime</th>
			<th>E-mail</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th></tr>";			
		
		while($row = mysql_fetch_array($rs)) {
			echo "<tr>";
			echo "<td>" . $row['idkorisnik'] . "</td>";
			echo "<td>" . $row['encryptedPassword'] . "</td>";
			echo "<td>" . $row['status_korisnika'] . "</td>";
			echo "<td>" . $row['username'] . "</td>";
			echo "<td>" . $row['email'] . "</td>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td></tr>";
		}					
		echo "</table>";
	}
	if(isset($_POST['kill'])) {	
		$kime = mysql_real_escape_string($_POST['kime']);
		require "baza.php";		
		$sqll= "DELETE FROM korisnik WHERE username = '$kime'";
		$sqldel = mysql_query($sqll) or die (mysql_error());
		$sql = "INSERT INTO log (zapis) VALUES ('Korisnik $username je obrisan.')";
		$rs = mysql_query($sql) or die (mysql_error());
		header("Location:users.php");
	}
?>