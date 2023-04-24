<?php
session_start();
require_once 'dbconnect.php';

if(isset($_POST["usern"]) && isset($_POST["pswrd"])){

        $username = $_POST["usern"];
        $pass = $_POST["pswrd"];
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
        $verify = password_verify($pass, $hashed_password);

        try{
        $sql = "SELECT * FROM lodinn.felhasznalok WHERE felhasznalok.felhNev LIKE '%".$username."%'";
        $result = $conn->prepare($sql);
        $result->execute();

        if($result ->rowCount() !=0){
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $db_username = $row['felhNev'];
                $db_password = $row['jelszo'];
            }
        } 
        if(password_verify($pass, $db_password))
        {       
            $_SESSION["login"] = true;
            $_SESSION["username"] = $_POST["usern"];
           
        } else {
            
            echo "<p style='color:red;'><i class='bi bi-exclamation-circle-fill'></i> Nem megfelelő felhasználónév vagy jelszó! Kérem próbálja meg újra!</p>";
        }
        if($_POST["rem"] == "yes"){   
            setcookie('username',  $username, time()+3600*24*7);
            setcookie('password',  $pass, time()+3600*24*7);
            setcookie('loggedin',  '1', time()+3600*24*7);
            } else {
            setcookie('username', '', time()-3600);
            setcookie('password', '', time()-3600);
            }
            
    }catch (PDOException $e){
        echo "Adatbázis hiba: " .$e->getMessage();    
    } catch (Exception $e){
        echo "Egyéb hiba: " .$e->getMessage();
        die();
    } 
}

?>
