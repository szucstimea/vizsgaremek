<?php

define("DBHOST","localhost");
define("DBNAME","lodinn");
define("DBUSER","root");
define("DBPASSWORD","");
$conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


try {
    $conn->beginTransaction();

    $conn->commit();   
    } catch (PDOException $e){
        echo "Adatbázis hiba: " .$e->getMessage();
        $conn->rollBack();
    } catch (Exception $e){
        echo "Egyéb hiba: " .$e->getMessage();
        die();
}
?>