<?php
include 'dbconnect.php';

if (isset($_POST["dname"])){
    try{
    $ID = trim($_POST["i"]);
    $dogname = trim($_POST["dname"]);
    $dogage = trim($_POST["dage"]);
    $dogspecies = trim($_POST["dspecies"]);

    $sql = "UPDATE lodinn.kutyak SET kutyaID = ?, kutyaNev = ?, kor=?, fajta =? WHERE kutyaID = ?";
    
    $queryUpdate = $conn->prepare($sql);
    $queryUpdate->bindParam(1, $ID, PDO::PARAM_INT);
    $queryUpdate->bindParam(2, $dogname, PDO::PARAM_STR);
    $queryUpdate->bindParam(3, $dogage, PDO::PARAM_INT);
    $queryUpdate->bindParam(4, $dogspecies, PDO::PARAM_STR);
    $queryUpdate->bindParam(5, $ID, PDO::PARAM_INT);
    $queryUpdate->execute();

    }   catch (PDOException $e){
            echo "Adatbázis hiba: " .$e->getMessage();    
        } catch (Exception $e){
            echo "Egyéb hiba: " .$e->getMessage();
        die();
        }
} 
