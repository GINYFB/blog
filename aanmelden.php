<?php
//Neem een goede IDE, PHPStorm ofzo, ik zie gewoon niks op deze manier 
	if(isset($_POST["submit"])) {
		// Hiero tzelfde though
		$fotoNaam = basename($_FILES["foto"]["name"]);
		global $uploadsMap;
		function upload(){
			//Engels variabelenamen
			global $uploadsMap;
			$uploadsMap = "uploads/";
			//Foto is niet verplicht in het form dus als de lijn hieronder kan errors veroorzaken, of maak verplicht of zet een isset() eropj
	
			if($_FILES['foto']['size'] != 0) {
				$uploadsMap = $uploadsMap . basename($_FILES["foto"]["name"]);
				$fotoType = pathinfo($uploadsMap,PATHINFO_EXTENSION);
			
			//Controleer of deze foto al bestaat
			if (file_exists($uploadsMap)) {
				echo "Deze foto bestaat al.";
				echo $uploadsMap; die;
				return false;
			}

			//Valideer fotoSize
			if ($_FILES["foto"]["size"] > 500000) {
				echo "Deze foto is te groot.";
				return false;
			}

			//Valideer formaat
			if ($fotoType != "jpg" &&
				$fotoType != "png" &&
				$fotoType != "jpeg" &&
				$fotoType != "gif") {
				echo "Foto  moet JPG, JPEG, PNG of GIF zijn.";
				return false;
			}
	}
	else {
			echo "Er is geen bestand ge-upload";
			die;
		}
			return true;
		}

		// Verplaats foto van temp-map naar uploadsMap
		//Waarom staat er een if om n standaard php functie? xD
		if (upload()) {
			if (move_uploaded_file($_FILES["foto"]["tmp_name"], $uploadsMap)) {
				echo "Foto is geüpload.";

				//gebruiker opslaan
				$bestand=fopen("gebruikers.txt", "ab");
				if (!$bestand) {
					echo "Kon geen bestand openen!";
				}

				$naam = htmlspecialchars($_POST['naam']);
				$email = htmlspecialchars($_POST['email']);
				$wachtwoord = htmlspecialchars($_POST['password']);
				$profielFoto = $fotoNaam;

// Waar the fuck om een sterretje? xD
				$profiel = "Naam = ".$naam . "\n Email = " . $email . "\n Wachtwoord  = " . $wachtwoord . "\n Foto = " . $profielFoto . "\n";

				fwrite($bestand, $profiel,strlen($profiel));

				if (fclose($bestand)) {
					echo "Account is aangemaakt";
				}
				else {
					echo "Kon bestand niet afsluiten";
				}
			}
			else {
				echo "Probleem bij het uploaden. Foto niet geüpload";
			}
		}
	}

	
?>
<a href="aanmelden.html">
	<br>
	<input type="button" name="terug" value=" Terug " />
</a>