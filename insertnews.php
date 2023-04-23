<?php
require 'dbconnect.php';

if(isset($_POST['hircime'])){
         $cim = $_POST["hircime"];
         $leiras = $_POST["hirleiras"];
         $id = $_POST["id_panzio"];

         try{

         $sql="INSERT INTO lodinn.hirek (panzio_ID,cim,leiras) VALUES (:id,:cim,:leiras) ";
         $update1 = $conn->prepare($sql);
         $update1->bindParam(':id', $id, PDO::PARAM_INT);
         $update1->bindParam(':cim', $cim, PDO::PARAM_STR);
         $update1->bindParam(':leiras', $leiras, PDO::PARAM_STR);
         $update1->execute();

         } catch (PDOException $e){
         echo "Adatbázis hiba: " .$e->getMessage();    
         } catch (Exception $e){
         echo "Egyéb hiba: " .$e->getMessage();
         die();
         }
    } 
?>