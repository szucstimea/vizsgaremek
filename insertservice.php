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
           

         $sql="INSERT INTO lodinn.arai (ar, kategoria_ID, panzio_ID) VALUES (:ar, :kategoria_ID, :panzio_ID)";
         $update1 = $conn->prepare($sql);
         $update1->bindParam(':ar', $ar, PDO::PARAM_INT);
         $update1->bindParam(':kategoria_ID', $lastId, PDO::PARAM_INT);
         $update1->bindParam(':panzio_ID', $panzio_ID, PDO::PARAM_INT);
         $update1->execute();
        

         } catch (PDOException $e){
         echo "Adatbázis hiba: " .$e->getMessage();    
         } catch (Exception $e){
         echo "Egyéb hiba: " .$e->getMessage();
         die();
         }
    } 
?>