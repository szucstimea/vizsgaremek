<?php
include 'dbconnect.php';

$output ="";
if(isset($_POST["search"])){
    $user = $_POST["search"];
    try{
    $sql = "SELECT * FROM lodinn.felhasznalok WHERE felhasznalok.felhNev = ?";
    $result = $conn->prepare($sql);
    $result->bindParam(1, $user, PDO::PARAM_STR);
    $result->execute();
    if ($result ->rowCount()==0){
        $output .='
        <p style="color:red;"> <i class="bi bi-hand-index-thumb"></i> A megadott felhaszálónévvel még nem regisztráltak!<br> Kérem adjon meg másikat vagy regisztráljon!</p>
        ';
    } else {
        return 0;
    }
    echo $output;

    }catch (PDOException $e){
        echo "Adatbázis hiba: " .$e->getMessage();
        $conn->rollBack();
    } catch (Exception $e){
        echo "Egyéb hiba: " .$e->getMessage();
        die();
    }
}
?>