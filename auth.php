<?php
session_start(); // inicijuojame kiekviename puslapyje
$c = new mysqli("localhost","root","","test");	// prisijungimas prie duomenu bazes

$postuser = $_POST['username']; // gautas kintamasis is index.php puslapio {name="username"}
$postpass = $_POST['password']; // gautas kintamasis is index.php puslapio {name="password"}

if($stmt = $c->prepare("SELECT id FROM user WHERE username=? AND password=?")){ // jeigu rastos visa reikiama informacija DB, lentele ir t.t.
	$stmt->bind_param("ss",$postuser,$postpass); // istatome i klaustukus du kintamuosius kuriuos irase vartotojas index.php faile. "ss" reiskia kad vartotojas i laukelius "string" t.y. teksta ir arba skaiciu
	// visi kintamieji eina eiles tvarka
	// pvz. jeigu uzklausoje buvo username=? AND password=? tai ir cia turi buti eiles tvakra $postuser, $postpassword
	$stmt->execute(); // darome uzklauso, t.y. mysql_query
	$stmt->bind_result($id); // issaugome isgauta vartotojo id is uzklausos 8 eiluteje, jeigu butu daugiau kintamuju tarkim username ir t.t. cia rasytume $id,$username ir t.t. 
	// taip pat eiles tvarka, taciau galite vadinti kaip norite
	if($stmt->fetch() == true){ // jeigu serveris grazina kazkokia eilute, t.y. vartotojas rastas ir duomenys teisingi
		$_SESSION['userid'] = $id; // issaugome sesija
		header("location:index.php"); // perardresuojame
 	}
 	else{ // jeigu duomenys neteisingi
 		echo 'Nepavyko prisijungti.';
 	}
}
else{// jeigu uzklausa neteisinga
	echo $stmt->error;
}

?>
