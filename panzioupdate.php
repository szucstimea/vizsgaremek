<?php
include 'dbconnect.php';

if (isset($_POST["id"])){
    try{
    $ID = trim($_POST["id"]);
    $panzionev = trim($_POST["pn"]);
    $panziotel = trim($_POST["pt"]);
    $panzioemail = trim($_POST["pe"]);
    $kapacitas = trim($_POST["ka"]);
    $megye = trim($_POST["me"]);
    $iranyitoszam = trim($_POST["ir"]);
    $telepules = trim($_POST["te"]);
    $utca = trim($_POST["ut"]);
    $hazszam = trim($_POST["ha"]);
    $adoszam = trim($_POST["ad"]);
    $cegjegyzek = trim($_POST["ce"]);
    $engedely = trim($_POST["en"]);
    $bemutat = trim($_POST["be"]);

    $sql = "UPDATE lodinn.panziok SET nev = ?, telszam = ?, email = ?, kapacitas =?, iranyitoszam = ?, megye = ?, varos = ?, utca = ?, adoszam = ?, cegjegyzek = ?, engedely = ?, hazszam = ?, bemutatkozas = ? WHERE panzioID = ?";
    
    $queryUpdate = $conn->prepare($sql);
    $queryUpdate->bindParam(1, $panzionev, PDO::PARAM_STR);
    $queryUpdate->bindParam(2, $panziotel, PDO::PARAM_STR);
    $queryUpdate->bindParam(3, $panzioemail, PDO::PARAM_STR);
    $queryUpdate->bindParam(4, $kapacitas, PDO::PARAM_INT);
    $queryUpdate->bindParam(5, $iranyitoszam, PDO::PARAM_INT);
    $queryUpdate->bindParam(6, $megye, PDO::PARAM_STR);
    $queryUpdate->bindParam(7, $telepules, PDO::PARAM_STR);
    $queryUpdate->bindParam(8, $utca, PDO::PARAM_STR);
    $queryUpdate->bindParam(9, $adoszam, PDO::PARAM_STR);
    $queryUpdate->bindParam(10, $cegjegyzek, PDO::PARAM_STR);
    $queryUpdate->bindParam(11, $engedely, PDO::PARAM_STR);
    $queryUpdate->bindParam(12, $hazszam, PDO::PARAM_STR);
    $queryUpdate->bindParam(13, $bemutat, PDO::PARAM_STR);
    $queryUpdate->bindParam(14, $ID, PDO::PARAM_INT);
    $queryUpdate->execute();
    }catch (PDOException $e){
        echo "Adatbázis hiba: " .$e->getMessage();    
    } catch (Exception $e){
        echo "Egyéb hiba: " .$e->getMessage();
    die();
    }
}          
?>