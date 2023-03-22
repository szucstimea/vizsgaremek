<?php
session_start();
require_once 'dbconnect.php';
$output ="";

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
            if($username == $db_username && $verify == $db_password)
            {   
                $output .='
                    <h5 style="color:green;"><i class="bi bi-box-arrow-in-right"></i> Sikeres bejelentkezés!</h5>
                ';
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $_POST["usern"];
               
            } else {
                return 0;
            }  

        } echo $output;

        if($_POST["rem"] == "yes"){   
            setcookie('username',  $username, time()+3600*24*7);
            setcookie('password',  $pass, time()+3600*24*7);
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
