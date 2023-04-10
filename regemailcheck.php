<?php
include 'dbconnect.php';

$output2 ="";
$letezik=false;

if(isset($_POST["mail"])){
    $mail = strtolower(trim($_POST["mail"]));
    $user = strtolower(trim($_POST["user"]));
    try{
    $sql = "SELECT * FROM lodinn.vendegek WHERE vendegek.email LIKE :mail";
    $result = $conn->prepare($sql);
    $result -> bindParam(':mail',$mail);
    $result->execute();
    if ($result ->rowCount()!=0){
        $letezik = true;
    
    }
    if($letezik){
    $sql2 = "SELECT * FROM lodinn.felhasznalok WHERE felhasznalok.felhNev LIKE :user";
    $result2 = $conn->prepare($sql2);
    $result2 -> bindParam(':user',$user);
    $result2->execute();
    if ($result2 ->rowCount()!=0){
        $output2 .='
        <p style="color:red;"> <i class="bi bi-hand-index-thumb"></i> A megadott felhasználónévvel és email címmel már regisztráltak!<br> Kérem adjon meg másikat!</p>
        ';
        } else {
            return 0;
        }
        echo $output2;

        }
    }catch (PDOException $e){
        echo "Adatbázis hiba: " .$e->getMessage();
        $conn->rollBack();
    } catch (Exception $e){
        echo "Egyéb hiba: " .$e->getMessage();
        die();
    }
}
?>