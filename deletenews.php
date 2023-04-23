<?php

require 'dbconnect.php';

if(isset($_POST['id'])){
    $ID = $_POST['id'];

    try{
    $i = $_POST['id'];
    $delete = $conn->prepare("DELETE FROM lodinn.hirek WHERE hirek.hirID LIKE :id");
    $delete-> bindParam(':id',$ID, PDO::PARAM_STR);    
    $delete->execute();
    } catch (PDOException $e){
        $error = "Adatbázis hiba: ".$e->getMessage();
    } catch (Exception $e) {
        $error = "Hiba: ".$e->getMessage();
        }
}
?>