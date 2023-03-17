<?php

// class Dd {
//     private $host = "localhost";
//     private $user = "root";
//     private $pwd = "";
//     private $dbName = "lodinn";

//     protected function connect(){
//     try{
//         $dsn = 'mysql:host=' . $this->host . ';dbname =' .$this->dbName;
//         $pdo = new PDO($dsn, $this->user, $this->pwd);
//         $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
//         return $pdo;

//     } catch(PDOException $e) {
//         echo "Adatbázis hiba: ".$e->getMessage() ."<br/>";
//         die();
//         }
//     }
//   }

// $felh = "root";
// $jelsz = "";

// $conn = new PDO('mysql:host = localhost; dbname = lodinn', $felh, $jelsz);
// $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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