<?php
require 'dbconnect.php';

//Vendég beszúrása
if(!empty($_POST['gazdivez'])){ //
    $veznev = $_POST["gazdivez"];
    $kernev = $_POST["gazdiker"];
    $email = $_POST["gazdiemail"];
    $telefon = $_POST["gazditel"];
    $irsz = $_POST["gazdiirsz"];
    $megye = $_POST["gazdimegye"];
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
        $vendegek->bindColumn("iranyitoszam",$DBirsz);
        $vendegek->bindColumn("vendegID",$vendegID);
        $vendegek->execute();

        if ($vendegek->rowCount()>0){
            while ($row = $vendegek->fetch(PDO::FETCH_BOUND)) {
                if(strtolower($gazdiVnev) == strtolower($veznev) && strtolower($gazdiKnev) == strtolower($kernev) & strtolower($gazdimail) == strtolower($email)){
                    $gazdiid = $vendegID;
                    //Ha a meglévő vendég címe üres, vagy eltér a korábban mentettől
                    if(empty($DBirsz)){ //user oldalon nem engedi, hogy bármely mező üres legyen, ezért elég az egyiket ellenőrizni üres-e
                        $sql2 = "UPDATE lodinn.vendegek SET iranyitoszam='$irsz',megye='$megye',varos='$telepules',utca='$utca',hazszam='$hazszam' WHERE vendegID='$gazdiid'";
                        $insertAddress = $conn->prepare($sql2);
                        $insertAddress->execute();
                    }
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
            $sql3 = "INSERT INTO lodinn.vendegek (vezNev,kerNev,email,telszam,iranyitoszam,megye,varos,utca,hazszam) VALUES ('$veznev','$kernev','$email','$telefon','$irsz','$megye','$telepules','$utca','$hazszam')";
            $insertGuest = $conn->prepare($sql3);
            $insertGuest->execute();
            $gazdiid = $conn->lastInsertId();
        }

        //Foglalások táblába szúrás - PanzióID lekérdezés
        $sql4 = "SELECT panzioID FROM lodinn.panziok WHERE nev = 'LodInn'";
        $panzio_fromDb = $conn->prepare($sql4);
        $panzio_fromDb->bindColumn("panzioID",$panzio_DBId);
        $panzio_fromDb->execute();
        $panzio_fromDb->fetch(PDO::FETCH_BOUND);

        //Foglalások táblába szúrás
        $sql5 = "INSERT INTO lodinn.foglalasok(panzio_ID) VALUES('$panzio_DBId')";
        $insertBooking = $conn->prepare($sql5);
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
        
            $sql6 = "SELECT * FROM lodinn.kutyak";
            $kutya_sql = $conn->prepare($sql6);
            $kutya_sql->bindColumn("kutyaID",$kutyaID);
            $kutya_sql->bindColumn("kutyaNev",$kutyaNev);
            $kutya_sql->bindColumn("vendeg_ID",$vendeg_ID);
            $kutya_sql->execute();

            //vendég címének módosítása, ha az nem egyezik a korábban mentettel
            if($szallitas == 1 && ($DBirsz != $irsz)){
                $sql7 = "UPDATE lodinn.vendegek SET iranyitoszam='$irsz',megye='$megye',varos='$telepules',utca='$utca',hazszam='$hazszam' WHERE vendegID='$gazdiid'";
                $insertAddress2 = $conn->prepare($sql7);
                $insertAddress2->execute();
            }

            if ($kutya_sql->rowCount()>0){
                while ($row = $kutya_sql->fetch(PDO::FETCH_BOUND)) {
                    if(strtolower($kutyaNev) == strtolower($kutyaneve) && $vendeg_ID == $gazdiid){
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
                $sql8 = "INSERT INTO lodinn.kutyak(kutyaNev,kor,fajta,vendeg_ID) VALUES('$kutyaneve','$kutyakor','$fajta','$gazdiid')";
                $insertDog = $conn->prepare($sql8);
                $insertDog->execute();
                $kutyaid = $conn->lastInsertId();
                echo "új kutya rögzítve";
            }

            //Tartozik táblába szúrás
            $sql8 = "INSERT INTO lodinn.tartozik(kezdoDatum,vegDatum,szallitas,specialisIgenyek,kutya_ID,fogl_ID) VALUES ('$elsonap','$utolsonap','$szallitas','$specigeny','$kutyaid','$foglalasid')";
            $insertTartozik = $conn->prepare($sql8);
            $insertTartozik->execute();
            // for($j = 0; $j < count($kutyak[$i]["szolg"]); $j++){
            //     $kutyak[$i]["szolg"][$j];
            // }
        }

    }catch(Exception $e){
        echo $e;
    }
}
?>