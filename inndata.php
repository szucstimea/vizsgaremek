<?php
require_once("dbconnect.php");

//Panzió adatok lekérése
$panzioadatok_sql = "SELECT * FROM panziok WHERE panzioID=1";
$panzioadatok = $conn->prepare($panzioadatok_sql);
$panzioadatok->execute();
$panzioadatok -> bindColumn("nev",$panzionev);
$panzioadatok -> bindColumn("telszam",$panziotel);
$panzioadatok -> bindColumn("email",$panzioemail);
$panzioadatok -> bindColumn("kapacitas",$kapacitas);
$panzioadatok -> bindColumn("iranyitoszam",$panzioirsz);
$panzioadatok -> bindColumn("megye",$panziomegye);
$panzioadatok -> bindColumn("varos",$panziovaros);
$panzioadatok -> bindColumn("utca",$panzioutca);
$panzioadatok -> bindColumn("hazszam",$panziohazszam);
$panzioadatok -> bindColumn("adoszam",$panzioadoszam);
$panzioadatok -> bindColumn("cegjegyzek",$panziocegjegyzek);
$panzioadatok -> bindColumn("engedely",$panzioengedely);
$panzioadatok -> bindColumn("bemutatkozas",$panziobemutatkozas);
$panzioadatok -> fetch(PDO::FETCH_ASSOC)
?>