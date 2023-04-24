<?php
require_once 'dbconnect.php';

if(!empty($_POST['uname'])){
    $uname = $_POST['uname'];

    try{
        $sql = "SELECT * FROM lodinn.vendegek INNER JOIN lodinn.felhasznalok ON vendegek.felh_ID=felhasznalok.felhID WHERE felhNev='$uname'";
        $felhAdat = $conn->prepare($sql);
        $felhAdat->execute();
        $data = $felhAdat->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }catch(Exception $e){
        echo $e;
    }
}

if(!empty($_POST['gazdaja'])){
    $gazdaja = $_POST['gazdaja'];

    try{
        $sql = "SELECT kutyaID,kutyaNev,kor,fajta FROM lodinn.kutyak INNER JOIN lodinn.vendegek ON kutyak.vendeg_ID=vendegek.vendegID INNER JOIN lodinn.felhasznalok ON vendegek.felh_ID=felhasznalok.felhID WHERE felhNev='$gazdaja'";
        $kutyai = $conn->prepare($sql);
        $kutyai->execute();
        $kutyak_data = $kutyai->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($kutyak_data);
    }catch(Exception $e){
        echo $e;
    }
}

?>