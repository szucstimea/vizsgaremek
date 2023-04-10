<?php
require 'dbconnect.php';

$kezdo = $_POST["from_date"];

$sql1 = "SELECT kapacitas FROM lodinn.panziok WHERE nev='LodInn'";
$getKapacitas = $conn->prepare($sql1);
$getKapacitas->bindColumn("kapacitas",$kapacitas);
$getKapacitas->execute();
$getKapacitas->fetch(PDO::FETCH_BOUND);
// echo ($kezdo." ".$kapacitas);

?>