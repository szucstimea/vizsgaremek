<?php
include 'dbconnect.php';

$output ="";
if(isset($_POST["user"])){
    try{
    $sql = "SELECT * FROM lodinn.felhasznalok WHERE felhasznalok.felhNev LIKE '%".$_POST["user"]."%'";
    $result = $conn->prepare($sql);
    $result->execute();
    if ($result ->rowCount()!=0){
        $output .='
        <p style="color:red;"> <i class="bi bi-hand-index-thumb"></i> A megadott felhaszálónév már foglalt!<br> Kérem adjon meg másikat!</p>
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