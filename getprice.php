<?php
require_once("dbconnect.php");
$ar = 0;
if (!empty($_POST["neve"])){
   try {
      $szolgnev = $_POST["neve"];
      $szolgaltatasok_sql = "SELECT ar FROM Arai INNER JOIN Arak ON kategoriaID=kategoria_ID WHERE kategoriaNev='$szolgnev'";
      $query1 = $conn->prepare($szolgaltatasok_sql);      
      $query1 -> bindColumn("ar",$ar);
      $query1 -> execute();
      $query1 -> fetch(PDO::FETCH_BOUND);

       echo $ar;
    }catch (Exception $e){
      echo $e;
    }
}
?>