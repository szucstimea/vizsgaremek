<?php
include 'dbconnect.php';

if (isset($_POST["ve"])){
    var_dump($_POST["ve"]);
    $veznev = trim($_POST["ve"]);
    $keresztnev = trim($_POST["ke"]);
    $user = trim($_POST["us"]);
    $mail = trim($_POST["ma"]);
    $phone = trim($_POST["ph"]);
    $megye = trim($_POST["me"]);
    $iranyitoszam = trim($_POST["ir"]);
    $telepules = trim($_POST["te"]);
    $utca = trim($_POST["ut"]);
    $hazszam = trim($_POST["ha"]);
    $pass = trim($_POST["pa"]);
    $pwhash = password_hash($pass,PASSWORD_DEFAULT);

    if (!empty($user)){
        try {
        $sql = "INSERT INTO lodinn.felhasznalok (felhNev,jelszo) VALUES (:felhNev,:jelszo) ";
        $queryReg = $conn->prepare($sql);
        $queryReg->bindParam(':felhNev',$user,PDO::PARAM_STR);
        $queryReg->bindParam(':jelszo',$pwhash,PDO::PARAM_STR);
        $queryReg->execute();

        $sql2 = "INSERT INTO lodinn.vendegek (felh_ID,vezNev,kerNev,email,telszam,megye,iranyitoszam,varos,utca,hazszam) VALUES (:felh_ID,:vezNev,:kerNev,:email,:telszam,:megye,:iranyitoszam,:varos,:utca,:hazszam) "; 
        $lastId = $conn->lastInsertId();
        $queryReg2 = $conn->prepare($sql2); 
        $queryReg2->bindParam(":felh_ID",$lastId,PDO::PARAM_INT);    
        $queryReg2->bindParam(":vezNev",$veznev,PDO::PARAM_STR);
        $queryReg2->bindParam(":kerNev",$keresztnev,PDO::PARAM_STR);
        $queryReg2->bindParam(":email",$mail,PDO::PARAM_STR);
        $queryReg2->bindParam(":telszam",$phone,PDO::PARAM_STR);
        $queryReg2->bindParam(":megye",$megye,PDO::PARAM_STR);
        $queryReg2->bindParam(":iranyitoszam",$iranyitoszam,PDO::PARAM_INT);
        $queryReg2->bindParam(":varos",$telepules,PDO::PARAM_STR);
        $queryReg2->bindParam(":utca",$utca,PDO::PARAM_STR);
        $queryReg2->bindParam(":hazszam",$hazszam,PDO::PARAM_INT);
        $queryReg2->execute();
        $_SESSION["loggedin"] = true;
            
        } catch (PDOException $e){
        $error = "Adatbázis hiba: ".$e->getMessage();
        } catch (Exception $e) {
        $error = "Hiba: ".$e->getMessage();
        }
    } else {
        $error = "Hibás adatok";
    }

}
?>