<?php
require_once 'dbconnect.php';
require './vendor/autoload.php';
require 'config/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


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
    $vegosszeg = $_POST["vegosszeg"];
    $timestamp = date("Y-m-d H:i:s");       
  
    try{
        $sql = "SELECT * FROM lodinn.vendegek";
        $vendegek = $conn->prepare($sql);
        $vendegek->bindColumn("vezNev",$gazdiVnev);
        $vendegek->bindColumn("kerNev",$gazdiKnev);
        $vendegek->bindColumn("email",$gazdimail);
        $vendegek->bindColumn("iranyitoszam",$DBirsz);
        $vendegek->bindColumn("megye",$DBmegye);
        $vendegek->bindColumn("varos",$DBvaros);
        $vendegek->bindColumn("utca",$DButca);
        $vendegek->bindColumn("hazszam",$DBhazszam);
        $vendegek->bindColumn("vendegID",$vendegID);
        $vendegek->execute();

        //ha már van ilyen felhasználó
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
        $sql5 = "INSERT INTO lodinn.foglalasok(panzio_ID,vegosszeg) VALUES('$panzio_DBId','$vegosszeg')";
        $insertBooking = $conn->prepare($sql5);
        $insertBooking->execute();
        $foglalasid = $conn->lastInsertId();

        //Alapár lekérése
        $sql9 = "SELECT ar FROM Arai INNER JOIN Arak ON kategoriaID=kategoria_ID WHERE kategoriaNev='alapár' AND panzio_ID=1";
        $alapar = $conn->prepare($sql9);
        $alapar -> bindColumn("ar",$alap);
        $alapar -> execute();
        $alapar->fetch(PDO::FETCH_BOUND);

        //Kutyák beszúrása
        for ($i = 0; $i < count($kutyak); $i++) {
            $kutyaneve = $kutyak[$i]["nev"];
            $fajta = $kutyak[$i]["fajta"];
            $kutyakor = $kutyak[$i]["kor"];
            $elsonap = $kutyak[$i]["kezdo"];
            $utolsonap = $kutyak[$i]["veg"];
            $specigeny = $kutyak[$i]["spec"];
            $szallitas = $kutyak[$i]["szallitas"];
            if(!empty($kutyak[$i]["szolg"])){
                $szolgaltatasok = $kutyak[$i]["szolg"];
            }
        
            $sql6 = "SELECT * FROM lodinn.kutyak";
            $kutya_sql = $conn->prepare($sql6);
            $kutya_sql->bindColumn("kutyaID",$kutyaID);
            $kutya_sql->bindColumn("kutyaNev",$kutyaNev);
            $kutya_sql->bindColumn("vendeg_ID",$vendeg_ID);
            $kutya_sql->execute();

            //vendég címének módosítása, ha az nem egyezik a korábban mentettel
            if($szallitas == 1 && ($DBirsz != $irsz || $DBmegye != $megye || $DBvaros != $varos || $DButca != $utca || $DBhazszam != $hazszam)){
                $sql7 = "UPDATE lodinn.vendegek SET iranyitoszam='$irsz',megye='$megye',varos='$telepules',utca='$utca',hazszam='$hazszam' WHERE vendegID='$gazdiid'";
                $insertAddress2 = $conn->prepare($sql7);
                $insertAddress2->execute();
            }

            if ($kutya_sql->rowCount()>0){
                while ($row = $kutya_sql->fetch(PDO::FETCH_BOUND)) {
                    if(strtolower($kutyaNev) == strtolower($kutyaneve) && $vendeg_ID == $gazdiid){
                        $uj_kutya = false;
                        $kutyaid = $kutyaID;
                        break;
                    }else{
                        $uj_kutya = true;
                    }
                }
            }else{
                $uj_kutya = true;
            }

            if($uj_kutya){
                $sql8 = "INSERT INTO lodinn.kutyak(kutyaNev,kor,fajta,vendeg_ID,rogzites) VALUES('$kutyaneve','$kutyakor','$fajta','$gazdiid','$timestamp')";
                $insertDog = $conn->prepare($sql8);
                $insertDog->execute();
                $kutyaid = $conn->lastInsertId();
            }

            //Tartozik táblába szúrás
            $sql8 = "INSERT INTO lodinn.tartozik(kezdoDatum,vegDatum,szallitas,specialisIgenyek,kutya_ID,fogl_ID) VALUES ('$elsonap','$utolsonap','$szallitas','$specigeny','$kutyaid','$foglalasid')";
            $insertTartozik = $conn->prepare($sql8);
            $insertTartozik->execute();

            // //Ar táblába szúrás
            if(!empty($szolgaltatasok)){
                for($m=0 ; $m < count($szolgaltatasok) ; $m++){
                    $szolg_nev = $szolgaltatasok[$m];
                    $sql10 = "SELECT kategoriaID FROM Arak WHERE kategoriaNev='$szolg_nev'";
                    $kategoria_ID = $conn->prepare($sql10);
                    $kategoria_ID -> bindColumn("kategoriaID",$kategoriaID);
                    $kategoria_ID -> execute();
                    $kategoria_ID->fetch(PDO::FETCH_BOUND);

                    $sql11 = "INSERT INTO lodinn.ar(kategoriaAr_ID,foglAr_ID,kutyaAr_ID) VALUES('$kategoriaID','$foglalasid','$kutyaid')";
                    $insertAr = $conn->prepare($sql11);
                    $insertAr->execute();
                }
            }

            if($szallitas==1){
                $szalligeny="igen";
            }else{
                $szalligeny="nem";
            }

            //email kiküldés a foglalásról
            $mail = new PHPMailer(true);
            $mail->CharSet = "UTF-8";
            $mail->IsSMTP();
            $mail->Mailer = "smtp";
            $mail->SMTPDebug  = 1;  
            $mail->SMTPAuth   = TRUE;
            $mail->SMTPSecure = "tls";
            $mail->Port       = 587;
            $mail->Host       = "smtp.gmail.com";
            $mail->Username   = "$smtpuser";
            $mail->Password   = "$smtppass";
            $mail->IsHTML(true);
            $mail->AddAddress("$email", "$user");
            $mail->AddEmbeddedImage('assets/images/dog3.png', 'logo_2u');
            $mail->AddEmbeddedImage('assets/images/kutyusokkicsi.png', 'logo_3u');
            $mail->SetFrom("lodinnkutyapanzio@gmail.com", "Lodinn Kutyapanzió");
            $mail->AddReplyTo("lodinnkutyapanzio@gmail.com", "Lodinn Kutyapanzió");
            $mail->Subject = "Sikeres foglalás!";
            $content = "
            <div style='background-color:#498ffc; border-radius: 10px; width: 100%; height: 100%; color:white; text-align: center'>  
            <img src='cid:logo_2u'><br> <b> <p style='color:white;'> Lodinn Kutyapanzió</p></b>
            <p>kutyusa második otthona<br></p>
            </div>
            <div>
            <h3>  Kedves $gazdiVnev $gazdiKnev és $kutyaNev!<br></h3>
            <h3><b>  Köszönjük, hogy megtiszteltél bizalmaddal és foglaltál a LodInn Kutyapanziónál!</b></h3>
            <p style='text-align: justify;'>Örülünk, hogy ügyfeleink között köszönthetünk! <br>
            Mindent megteszünk, hogy $kutyaNev otthonossan érezze magát panziónkban! <br><br> 
            A foglalásod főbb adatai:<br> 
            <b> Gazdi neve: </b>$veznev $kernev <br> 
            <b> Email cím: </b> $email <br>
            <b> Telefonszám: </b> $telefon <br>
            <b> Irányítószám: </b> $irsz <br>
            <b> Megye: </b> $megye <br>
            <b> Település: </b> $telepules <br>
            <b> Utca: </b> $utca <br>
            <b> Házszám: </b> $hazszam <br>
            <b> Kutya neve: </b> $kutyaNev <br>
            <b> Kutya kora: </b>  $kutyakor <br>
            <b> Kutya fajtája: </b> $fajta <br>
            <b> Foglalás első napja: </b> $elsonap <br>
            <b> Foglalás utolsó napja: </b> $utolsonap <br>
            <b> Szállítást kér: </b> $szalligeny <br>
            <b> Speciális igény: </b>  $specigeny <br>
            <b> Végösszeg: </b>  $vegosszeg ,-Ft <br>
            <b> Foglalás időpontja: </b> $timestamp <br><br>
           
            Mi egy olyan kutyapanziót üzemeltetünk, ahol négylábú barátodnak otthonos és biztonságos környezetet biztosítunk. Nálunk nem csak egy szobában vagy ketrecben tölti az időt kedvenced, hanem szabadon játszhat és futkározhat a nagy kertünkben, ahol más kutyusokkal is megismerkedhet. Ne feledd, hogy az elhelyezés mellett különböző szolgálatásainkkal is meglepheted kutyusod.</p><br>
            <p style='text-align: justify;'>Várjuk megkeresésed az alábbi elérhetőségeken:<br>
            Cím: 6782 Mórahalom Dosztig köz 3.<br>
            Email: lodinnkutyapanzio@gmail.com<br>
            Telefon: +36(30)123-4567<br>
            Web: www.lodinn.hu<br><br><br>
            </div>
            <div style='background-color:#498ffc; border-radius: 10px; width: 100%; height: 100%;'>      
            <img src='cid:logo_3u' style='display: block;margin-left: auto; margin-right: auto; width: 30%;'>
            </div>
            ";
            
            $mail->MsgHTML($content); 
            if(!$mail->Send()) {
            echo "Error while sending Email.";
            } else {
            echo "Email sent successfully";
            }



        }//kutyák beszúrása-vége

        echo "Köszönjük, foglalását! A megadott e-mail címre értesítést küldtünk a foglalás részleteiről.";


    }catch(Exception $e){
        echo $e;
    }
}
?>