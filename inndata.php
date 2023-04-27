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

$szolgaltatasok_sql = "SELECT Arak.kategoriaNev AS kategoria, Arai.ar AS ara FROM Arak INNER JOIN Arai ON kategoria_ID=kategoriaID WHERE panzio_ID=1";
$szolgaltatasok = $conn->prepare($szolgaltatasok_sql);
$szolgaltatasok->execute();
if($szolgaltatasok->rowCount()>0){
    $szolgaltatas = $szolgaltatasok->fetchAll(PDO::FETCH_ASSOC);
}else{
    $szolgaltatas = "nincs";
}

//képek útvonalának lekérdezése
$kepek_sql = "SELECT kepNev, kepUtvonal FROM Kepek WHERE panzio_ID=1";
$kepek_query = $conn->prepare($kepek_sql);
$kepek_query->execute();
$kepek_lista = $kepek_query->fetchAll(PDO::FETCH_ASSOC);
$kepek = [];
foreach ($kepek_lista as $k){
    $key = $k["kepNev"];
    $kepek[$key] = $k["kepUtvonal"];
}

//linkek útvonalának lekérdezése
$linkek_sql = "SELECT linkNev, link FROM linkek WHERE panzio_ID=1";
$linkek_query = $conn->prepare($linkek_sql);
$linkek_query->execute();
$linkek_lista = $linkek_query->fetchAll(PDO::FETCH_ASSOC);
$linkek = [];
foreach ($linkek_lista as $l){
    $key = $l["linkNev"];
    $linkek[$key] = $l["link"];
}

?>