<?php
require 'dbconnect.php';

if(isset($_POST['kutyanev'])){
         $kutyaID = $_POST["kutyaID"];
         $vendegID = $_POST["vendegID"];
         $kutyanev = $_POST["kutyanev"];
         $kutyakor = $_POST["kutyakor"];
         $kutyafajta = $_POST["kutyafajta"];
         $timestamp = date("Y-m-d H:i:s");

         try{


            
         $sql="INSERT INTO lodinn.kutyak (kutyaID,kutyaNev,kor,fajta,vendeg_ID, rogzites) VALUES ('',:kutyanev,:kutyakor,:kutyafajta,:vendeg_ID, :rogzites)";
         $update1 = $conn->prepare($sql);
         $update1->bindParam(':kutyanev', $kutyanev, PDO::PARAM_STR);
         $update1->bindParam(':kutyakor', $kutyakor, PDO::PARAM_INT);
         $update1->bindParam(':kutyafajta', $kutyafajta, PDO::PARAM_STR);
         $update1->bindParam(':vendeg_ID', $vendegID, PDO::PARAM_INT);
         $update1->bindParam(':rogzites', $timestamp, PDO::PARAM_STR);
         $update1->execute();

         $lastId = $conn->lastInsertId();
         $sql2 ="SELECT * FROM lodinn.kutyak WHERE kutyak.vendeg_ID = ? AND kutyak.kutyaNev = ?";
         $update2 = $conn->prepare($sql2);
         $update2->bindParam(1, $vendegID, PDO::PARAM_INT);
         $update2->bindParam(2, $kutyanev, PDO::PARAM_INT);
         $update2->execute();
         $array = array('id' => $lastId, 'kutyanev' => $kutyanev, 'kutyakor' => $kutyakor, 'kutyafajta' => $kutyafajta);
         echo json_encode($array);

         } catch (PDOException $e){
         echo "Adatbázis hiba: " .$e->getMessage();    
         } catch (Exception $e){
         echo "Egyéb hiba: " .$e->getMessage();
         die();
         }
    } 
?>