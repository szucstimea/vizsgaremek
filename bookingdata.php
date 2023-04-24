<?php
require_once 'dbconnect.php';

if(!empty($_POST['uname'])){

    $user = $_POST['uname'];

    try{
        $sql = "SELECT vendegID FROM lodinn.vendegek INNER JOIN lodinn.felhasznalok ON felhasznalok.felhID=vendegek.felh_ID WHERE felhasznalok.felhNev=?";
        $felh = $conn -> prepare($sql);
        $felh -> bindParam(1,$user);
        $felh -> execute();
        $vendegID = $felh->fetch(PDO::FETCH_BOUND);

        $sql2 = "SELECT * FROM lodinn.tartozik INNER JOIN lodinn.kutyak ON tartozik.kutya_ID=kutyak.kutyaID INNER JOIN lodinn.foglalasok ON tartozik.fogl_ID=foglalasok.foglID WHERE vendeg_ID=?";
        $fogl = $conn -> prepare($sql2);
        $fogl -> bindParam(1,$vendegID);
        $fogl -> execute();
        $foglalas = $fogl -> fetchAll(PDO::FETCH_ASSOC);

        if($fogl -> rowCount()>0){
            for ( $i = 0; $i < count($foglalas); $i++ ) {
                $kutyaid = $foglalas[$i]["kutyaID"];
                $foglid = $foglalas[$i]["foglID"];
                $foglalas[$i] += ["szolgaltatasok" => array()];
                $sql3 = "SELECT kategoriaNev FROM lodinn.arak INNER JOIN lodinn.ar ON ar.kategoriaAr_ID=arak.kategoriaID WHERE ar.kutyaAr_ID='$kutyaid' AND ar.foglAr_ID='$foglid'";
                $szolg = $conn -> prepare($sql3);
                $szolg -> execute();
                if ($szolg->rowCount()>0){
                    $sz = $szolg->fetchAll(PDO::FETCH_ASSOC);
                    foreach($sz as $kat){
                        array_push($foglalas[$i]["szolgaltatasok"],$kat["kategoriaNev"]);
                    }
                }
            }
        }

        echo json_encode($foglalas);

    }catch(Exception $e){
        echo $e;
    }
}

?>