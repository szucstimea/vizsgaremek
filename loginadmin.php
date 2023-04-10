<?php
session_start();
require_once 'dbconnect.php';


if(isset($_POST["vez"])){

        $vez = $_POST["vez"];
        $ker = $_POST["ker"];
        $pass = $_POST["pswrd"];
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
        $verify = password_verify($pass, $hashed_password);
        
        
        
        try{ 

            $sql = "SELECT * FROM lodinn.dolgozok WHERE dolgozok.vezNev LIKE :veznev AND dolgozok.kerNev LIKE :kernev";
            $result = $conn->prepare($sql);
            $vezcheck = "%".$vez."%";
            $kercheck = "%".$ker."%";
            $result -> bindParam(':veznev',$vezcheck, PDO::PARAM_STR);
            $result -> bindParam(':kernev',$kercheck, PDO::PARAM_STR);
            $result->execute();

            if($result ->rowCount() !=0){
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $db_vez = $row['vezNev'];
                    $db_ker = $row['kerNev'];
                    $db_felhID = $row['felh_ID'];
                }
            }

            $sql2 = "SELECT * FROM lodinn.felhasznalok WHERE felhasznalok.felhID = ?";
            $result2 = $conn->prepare($sql2);
            $result2->bindParam(1, $db_felhID, PDO::PARAM_INT);
            $result2->execute();
            
            if($result2 ->rowCount() !=0){
                while($row = $result2->fetch(PDO::FETCH_ASSOC)){
                    $db_username = $row['felhNev'];
                    $db_password = $row['jelszo'];
                }
            }
            $verify = password_verify($pass, $db_password);
            if($verify)
            {       
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $db_username;
            
            } else {
            
                echo "<div><p style='color:red;'><i class='bi bi-exclamation-circle-fill'></i> Nem megfelelő felhasználónév vagy jelszó! Kérem próbálja meg újra!</p></div>";
            }

            if($_POST["rem"] == "yes"){   
                setcookie('veznev',  $db_vez, time()+3600*24*7);
                setcookie('kernev',  $db_ker, time()+3600*24*7);
                setcookie('username',  $db_username, time()+3600*24*7);
                setcookie('password',  $pass, time()+3600*24*7);
                setcookie('loggedin',  '1', time()+3600*24*7);
                } else {
                setcookie('veznev', '', time()-3600);
                setcookie('kernev', '', time()-3600);
                setcookie('username', '', time()-3600);
                setcookie('password', '', time()-3600);
                }
        } catch (PDOException $e){
            echo "Adatbázis hiba: " .$e->getMessage();    
        } catch (Exception $e){
            echo "Egyéb hiba: " .$e->getMessage();
            die();
        } 
    }


?>