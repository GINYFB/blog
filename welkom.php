<?php 
session_start();
// Pfff nl en engels door mekaar, ik zou je moeten slaan BOEK ZN FOUT LOGICA AAHHH
// Haat aan scholen though, ze leren je het gwn letterlijk fout ja achja. als het aan mij lag zou ik alles in het engels doen maar herezenloos overtypen enzo Gaat indd nergens over, maargoed
$mijnSession = session_id();
if(isset($_SESSION['ID']) && $_SESSION['ID'] === $mijnSession){
	echo <"<h3>Welkom</h3>";
}
else {
	echo "<br>Je moet eerst inloggen!<br>";
}

?>

<a href='uitloggen.php'><input type='button' name='terug' value='Uitloggen'/>
</a>