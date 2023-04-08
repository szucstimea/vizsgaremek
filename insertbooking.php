<?php
require 'dbconnect.php';

//Vendég beszúrása
if(!empty($_POST['gazdivez']) && !empty($_POST['gazdiker']) && !empty($_POST['gazdiemail']) && !empty($_POST['gazditel']) && !empty($_POST['kutyak'])){
    
    $veznev = $_POST["gazdivez"];
    $kernev = $_POST["gazdiker"];
    $email = $_POST["gazdiemail"];
    $telefon = $_POST["gazditel"];
    $gazdiirsz = $_POST["gazdiirsz"];
    $telepules = $_POST["gazditelepules"];
    $utca = $_POST["gazdiutca"];
    $hazszam= $_POST["gazdihazszam"];
    $kutyak = $_POST["kutyak"];          
  
    try{
        $sql = "SELECT * FROM lodinn.vendegek";
        $vendegek = $conn->prepare($sql);
        $vendegek->bindColumn("vezNev",$gazdiVnev);
        $vendegek->bindColumn("kerNev",$gazdiKnev);
        $vendegek->bindColumn("email",$gazdimail);
        $vendegek->bindColumn("vendegID",$vendegID);
        $vendegek->execute();

        if ($vendegek->rowCount()>0){
            while ($row = $vendegek->fetch(PDO::FETCH_BOUND)) {
                if($gazdiVnev == $veznev && $gazdiKnev == $kernev & $gazdimail == $email){
                    $gazdiid = $vendegID;
                    $letezik=true;
                    break;
                }else{
                    $letezik=false;
                }
            }
        }else{
            $letezik = false;
        }

        if(!$letezik){
            $sql2 = "INSERT INTO lodinn.vendegek (vezNev,kerNev,email,telszam,irsz,megye,varos,utca) VALUES ('$veznev','$kernev','$email','$telefon','$irsz','$telepules','$utca','$hazszam')";
            $insertGuest = $conn->prepare($sql2);
            $insertGuest->execute();
            $gazdiid = $conn->lastInsertId();
        }

        //Foglalások táblába szúrás - PanzióID lekérdezés
        $sql5 = "SELECT panzioID FROM lodinn.panziok WHERE nev = 'LodInn'";
        $panzio_fromDb = $conn->prepare($sql5);
        $panzio_fromDb->bindColumn("panzioID",$panzio_DBId);
        $panzio_fromDb->execute();
        $panzio_fromDb->fetch(PDO::FETCH_BOUND);

        //Foglalások táblába szúrás
        $sql6 = "INSERT INTO lodinn.foglalasok(panzio_ID) VALUES('$panzio_DBId')";
        $insertBooking = $conn->prepare($sql6);
        $insertBooking->execute();
        $foglalasid = $conn->lastInsertId();

        //Kutyák beszúrása
        for ($i = 0; $i < count($kutyak); $i++) {
            $kutyaneve = $kutyak[$i]["nev"];
            $fajta = $kutyak[$i]["fajta"];
            $kutyakor = $kutyak[$i]["kor"];
            $elsonap = $kutyak[$i]["kezdo"];
            $utolsonap = $kutyak[$i]["veg"];
            $specigeny = $kutyak[$i]["spec"];
            $szallitas = $kutyak[$i]["szallitas"];
        
            $sql3 = "SELECT * FROM lodinn.kutyak";
            $kutya_sql = $conn->prepare($sql3);
            $kutya_sql->bindColumn("kutyaID",$kutyaID);
            $kutya_sql->bindColumn("kutyaNev",$kutyaNev);
            $kutya_sql->bindColumn("vendeg_ID",$vendeg_ID);
            $kutya_sql->execute();

            if ($kutya_sql->rowCount()>0){
                while ($row = $kutya_sql->fetch(PDO::FETCH_BOUND)) {
                    if($kutyaNev == $kutyaneve && $vendeg_ID == $gazdiid){
                        $uj_kutya = false;
                        $kutyaid = $kutyaID;
                        echo "Köszönjük, hogy újra foglalt {$kutyaneve} kutyusának!";
                        break;
                    }else{
                        $uj_kutya = true;
                    }
                }
            }else{
                $uj_kutya = true;
            }

            if($uj_kutya){
                $sql4 = "INSERT INTO lodinn.kutyak(kutyaNev,kor,fajta,vendeg_ID) VALUES('$kutyaneve','$kutyakor','$fajta','$gazdiid')";
                $insertDog = $conn->prepare($sql4);
                $insertDog->execute();
                $kutyaid = $conn->lastInsertId();
                echo "új kutya rögzítve";
            }

            //Tartozik táblába szúrás
            $sql7 = "INSERT INTO lodinn.tartozik(kezdoDatum,vegDatum,szallitas,specialisIgenyek,kutya_ID,fogl_ID) VALUES ('$elsonap','$utolsonap','$szallitas','$specigeny','$kutyaid','$foglalasid')";
            $insertTartozik = $conn->prepare($sql7);
            $insertTartozik->execute();
            // for($j = 0; $j < count($kutyak[$i]["szolg"]); $j++){
            //     $kutyak[$i]["szolg"][$j];
            // }
        }

    }catch(Exception $e){
        echo $e;
    }
}else{
    echo "A foglaláshoz kötelező megadni a gazdi teljes nevét, e-mail címét és telefonszámát, illetve a kutya nevét!";
}
?>