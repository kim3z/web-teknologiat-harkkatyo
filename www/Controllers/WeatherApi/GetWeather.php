<?php
	if (!isset($_POST['city']) || strlen((string)$_POST['city']) <= 0) {
		echo "<br><br>";
		echo 'En antanut kaupunkia';
		return;
	}

	$taulu = null;
	try {
		$ennuste = @file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$_POST['city']."&lang=fi&units=metric&appid=f7c991c0633727fd09ee570b014ca5a4");
		$taulu = json_decode($ennuste,true);
	} catch (Exception $e) {
		echo 'Ei löytynyt';
	}
	
	echo "<br><br>";
	
	if ($taulu) {
		$tilanne="Säätilanne paikkakunnalla ".$_POST['inputti']." on tällä hetkellä: ".$taulu[
		'weather'][0]['description'];
			
		$asteet="Lämpötila paikkakunnalla ".$_POST['inputti']." on tällä hetkellä: ".$taulu[
		'main']['temp'];
			
		echo '<h3>' . $_POST['city'] . '</h3>';
		echo $tilanne;
		echo "<br><br>";
		echo $asteet;
	} else {
		echo 'Ei löytynyt säätietoa kaupungista ' . $_POST['city'];
	}
?>