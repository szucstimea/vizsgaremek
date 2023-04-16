<?php

require 'dbconnect.php';

if(isset($_POST['id'])){
    try{
    $i = $_POST['id'];
    $sql="DELETE FROM lodinn.tartozik WHERE tartozik.fogl_ID = ?";
    $delete = $conn->prepare($sql);
    $delete->bindParam(1, $i, PDO::PARAM_INT);    
    $delete->execute();

    } catch (PDOException $e){
        $error = "Adatbázis hiba: ".$e->getMessage();
    } catch (Exception $e) {
        $error = "Hiba: ".$e->getMessage();
        }
}
?>