<?php
require 'dbconnect.php';

// $kezdo = $_POST["from_date"];
$sql1 = "SELECT kapacitas FROM lodinn.panziok WHERE nev='LodInn'";
$getKapacitas = $conn->prepare($sql1);
$getKapacitas->bindColumn("kapacitas",$kapacitas);
$getKapacitas->execute();
$getKapacitas->fetch(PDO::FETCH_BOUND);
// echo ($kezdo." ".$kapacitas);

$sql2 = "SELECT MIN(kezdoDatum) AS minDate, MAX(vegDatum) AS maxDate, DATEDIFF(MAX(vegDatum),MIN(kezdoDatum)) AS date_difference FROM lodinn.tartozik";
$diff = $conn->prepare($sql2);
$diff->bindColumn("minDate",$minDate,PDO::PARAM_STR);
$diff->bindColumn("maxDate",$maxDate,PDO::PARAM_STR);
$diff->bindColumn("date_difference",$difference,PDO::PARAM_STR);
$diff->execute();
$diff->fetch(PDO::FETCH_BOUND);
// echo($minDate);

$napok= array_fill(0, $difference, $kapacitas); //a 0 indexűtől tölti fel, tömb mérete, tömbelemek értéke

$sql3 = "SELECT kezdoDatum,vegDatum FROM tartozik";
$kezdo_veg = $conn->prepare($sql3);
$kezdo_veg->bindColumn("kezdoDatum",$kezdoDatum);
$kezdo_veg->bindColumn("vegDatum",$vegDatum);
$kezdo_veg->bindColumn("min_diff",$min_diff);
$kezdo_veg->execute();
$foglalt = $kezdo_veg->fetchAll(PDO::FETCH_ASSOC);
foreach($foglalt as $foglalas){
    $foglalas_kezdo = $foglalas["kezdoDatum"];
    $foglalas_veg = $foglalas["vegDatum"];
    $kezdo = abs(strtotime($foglalas_kezdo) - strtotime($minDate)); //másodperc
    $veg = abs(strtotime($foglalas_veg) - strtotime($minDate));

    $foglalt_kezdoindex = abs($kezdo/(60 * 60)/24); //másodperc -> nap
    $foglalt_vegindex = abs($veg/(60 * 60)/24);
    
    for($j=$foglalt_kezdoindex;$j<$foglalt_vegindex;$j++){
        $napok[$j]--;
    }
}

$response = json_encode(array("napok"=>$napok,"minnap"=>$minDate,"maxnap"=>$maxDate,"kapacitas"=>$kapacitas));
echo $response;

?>