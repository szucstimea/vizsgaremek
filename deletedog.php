<?php

require 'dbconnect.php';

if(isset($_POST['id'])){
    try{
    $i = $_POST['id'];
    $delete = $conn->prepare("DELETE FROM lodinn.kutyak WHERE kutyaID = ?");
    $delete->bindParam(1, $i, PDO::PARAM_INT);    
    $delete->execute();
    } catch (PDOException $e){
        $error = "Adatbázis hiba: ".$e->getMessage();
    } catch (Exception $e) {
        $error = "Hiba: ".$e->getMessage();
        }
}
?>