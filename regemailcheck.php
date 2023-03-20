<?php
include 'dbconnect.php';

$output2 ="";
if(isset($_POST["mail"])){
    try{
    $sql = "SELECT * FROM lodinn.vendegek WHERE vendegek.email LIKE '%".$_POST["mail"]."%'";
    $result = $conn->prepare($sql);
    $result->execute();
    if ($result ->rowCount()!=0){
        $output2 .='
        <p style="color:red;"> <i class="bi bi-hand-index-thumb"></i> A megadott email cím már foglalt!<br> Kérem adjon meg másikat!</p>
        ';
    } else {
        return 0;
    }
    echo $output2;

    }catch (PDOException $e){
        echo "Adatbázis hiba: " .$e->getMessage();
        $conn->rollBack();
    } catch (Exception $e){
        echo "Egyéb hiba: " .$e->getMessage();
        die();
    }
}
?>