<?php
require 'dbconnect.php';

if(isset($_POST['szolgneve'])){
         $szolg = $_POST["szolgneve"];
         $ar = $_POST["ar"];
         $panzio_ID =  $_POST["id_panzio"];
         
         
         try{

            $sql4 = "INSERT INTO lodinn.arak (kategorianev) VALUES (:kategorianev)";
            $result4 = $conn->prepare($sql4);
            $result4->bindParam(':kategorianev', $szolg, PDO::PARAM_STR);
            $result4->execute();
            
            $lastId = $conn->lastInsertId();
            // $sql4 = "INSERT INTO lodinn.arak kategorianev VALUES :kategorianev";
            // $result4 = $conn->prepare($sql4);
            // $result4->bindParam(':kategorianev', $szolg, PDO::PARAM_STR);
            // $result4->execute();
           

         $sql="INSERT INTO lodinn.arai (ar, kategoria_ID, panzio_ID) VALUES (:ar, :kategoria_ID, :panzio_ID)";
         $update1 = $conn->prepare($sql);
         $update1->bindParam(':ar', $ar, PDO::PARAM_INT);
         $update1->bindParam(':kategoria_ID', $lastId, PDO::PARAM_INT);
         $update1->bindParam(':panzio_ID', $panzio_ID, PDO::PARAM_INT);
         $update1->execute();
        //  
        //  $sql2 ="SELECT * FROM lodinn.kutyak WHERE kutyak.vendeg_ID = ? AND kutyak.kutyaNev = ?";
        //  $update2 = $conn->prepare($sql2);
        //  $update2->bindParam(1, $vendegID, PDO::PARAM_INT);
        //  $update2->bindParam(2, $kutyanev, PDO::PARAM_INT);
        //  $update2->execute();
        //  $array = array('id' => $lastId, 'kutyanev' => $kutyanev, 'kutyakor' => $kutyakor, 'kutyafajta' => $kutyafajta);
        //  echo json_encode($array);

         } catch (PDOException $e){
         echo "Adatbázis hiba: " .$e->getMessage();    
         } catch (Exception $e){
         echo "Egyéb hiba: " .$e->getMessage();
         die();
         }
    } 
?>