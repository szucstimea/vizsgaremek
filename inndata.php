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
$panzioadatok -> fetch(PDO::FETCH_ASSOC);

$szolgaltatasok_sql = "SELECT Arak.kategoriaNev AS kategoriak, Arai.ar AS arak FROM Arak INNER JOIN Arai ON kategoria_ID=kategoriaID WHERE panzio_ID=1";
$szolgaltatasok = $conn->prepare($szolgaltatasok_sql);
$szolgaltatasok->execute();
$szolgaltatasok -> bindColumn("kategoriak",$kategoria);
$szolgaltatasok -> bindColumn("arak",$ar);
$szolgaltatas = $szolgaltatasok->fetchAll(PDO::FETCH_ASSOC);

?>