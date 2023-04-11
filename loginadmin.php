<?php
session_start();
require_once 'dbconnect.php';


if(isset($_POST["fel"])){

        $fel = $_POST["fel"];
        $pass = $_POST["pswrd"];
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
        
        try{ 
            
            $sql = "SELECT * FROM lodinn.felhasznalok WHERE felhasznalok.felhNev LIKE :fel";
            $result = $conn->prepare($sql);
            $felcheck = "$fel";
            $result -> bindParam(':fel',$felcheck, PDO::PARAM_STR);
            $result->execute();

            if($result ->rowCount() !=0){
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $db_felhID = $row['felhID'];
                    $db_password = $row['jelszo'];
                }
 
                $verify = password_verify($pass, $db_password);
                if($verify)
                {       
                    $sql2 = "SELECT * FROM lodinn.dolgozok WHERE dolgozok.felh_ID = ?";
                    $result2 = $conn->prepare($sql2);
                    $result2->bindParam(1, $db_felhID, PDO::PARAM_INT);
                    $result2->execute();          
                } 

                if($result2 ->rowCount() !=0){
                    
                    $_SESSION["loggedin"] = true;
                    $_SESSION["usernameadmin"] = $_POST["fel"];  

                } 
                else {
                    echo "<div><p style='color:red;'><i class='bi bi-exclamation-circle-fill'></i> Nem megfelelő felhasználónév vagy jelszó! Kérem próbálja meg újra!</p></div>";
                }
            }
            
            else {
                echo "<div><p style='color:red;'><i class='bi bi-exclamation-circle-fill'></i> Nem megfelelő felhasználónév vagy jelszó! Kérem próbálja meg újra!</p></div>";
            }

            if($_POST["rem"] == "yes"){   
                setcookie('veznev',  $db_vez, time()+3600*24*7);
                setcookie('kernev',  $db_ker, time()+3600*24*7);
                setcookie('usernameadmin',  $db_username, time()+3600*24*7);
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