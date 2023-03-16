<?php
session_start();
include 'dbconnect.php';
$output ="";
if(isset($_POST["usern"]) && isset($_POST["pswrd"])){
        $username = $_POST["usern"];
        $pass = $_POST["pswrd"];

        try{
        $sql = "SELECT * FROM lodinn.felhasznalok WHERE felhasznalok.felhNev LIKE '%".$username."%'";
        $result = $conn->prepare($sql);
        $result->execute();
        if($result ->rowCount() !=0){
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $db_username = $row['felhNev'];
                $db_password = $row['jelszo'];
            }
            if($username == $db_username && $pass == $db_password)
            {   
                $output .='
                    <h5 style="color:green;"><i class="bi bi-box-arrow-in-right"></i> Sikeres bejelentkezés!</h5>
                ';
                $_SESSION["username"] = $_POST["usern"];
                // header("Location: index.php");

            } else {
                return 0;
            }
        } echo $output;
    }catch (PDOException $e){
        echo "Adatbázis hiba: " .$e->getMessage();    
    } catch (Exception $e){
        echo "Egyéb hiba: " .$e->getMessage();
        die();
    } 
}
?>
