<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'dbconnect.php';
require './vendor/autoload.php';
require 'config/config.php';


if (isset($_POST["ve"])){
    var_dump($_POST["ve"]);
    $veznev = trim($_POST["ve"]);
    $keresztnev = trim($_POST["ke"]);
    $user = trim($_POST["us"]);
    $email = trim($_POST["ma"]);
    $phone = trim($_POST["ph"]);
    $megye = trim($_POST["me"]);
    $iranyitoszam = trim($_POST["ir"]);
    $telepules = trim($_POST["te"]);
    $utca = trim($_POST["ut"]);
    $hazszam = trim($_POST["ha"]);
    $pass = trim($_POST["pa"]);
    $pwhash = password_hash($pass,PASSWORD_DEFAULT);
   

    if (!empty($user)){
        try {
        $sql = "INSERT INTO lodinn.felhasznalok (felhNev,jelszo) VALUES (:felhNev,:jelszo) ";
        $queryReg = $conn->prepare($sql);
        $queryReg->bindParam(':felhNev',$user,PDO::PARAM_STR);
        $queryReg->bindParam(':jelszo',$pwhash,PDO::PARAM_STR);
        $queryReg->execute();

        $sql2 = "INSERT INTO lodinn.vendegek (felh_ID,vezNev,kerNev,email,telszam,megye,iranyitoszam,varos,utca,hazszam) VALUES (:felh_ID,:vezNev,:kerNev,:email,:telszam,:megye,:iranyitoszam,:varos,:utca,:hazszam) "; 
        $lastId = $conn->lastInsertId();
        $queryReg2 = $conn->prepare($sql2); 
        $queryReg2->bindParam(":felh_ID",$lastId,PDO::PARAM_INT);    
        $queryReg2->bindParam(":vezNev",$veznev,PDO::PARAM_STR);
        $queryReg2->bindParam(":kerNev",$keresztnev,PDO::PARAM_STR);
        $queryReg2->bindParam(":email",$email,PDO::PARAM_STR);
        $queryReg2->bindParam(":telszam",$phone,PDO::PARAM_STR);
        $queryReg2->bindParam(":megye",$megye,PDO::PARAM_STR);
        $queryReg2->bindParam(":iranyitoszam",$iranyitoszam,PDO::PARAM_INT);
        $queryReg2->bindParam(":varos",$telepules,PDO::PARAM_STR);
        $queryReg2->bindParam(":utca",$utca,PDO::PARAM_STR);
        $queryReg2->bindParam(":hazszam",$hazszam,PDO::PARAM_INT);
        $queryReg2->execute();
        $_SESSION["loggedin"] = true;

        //email kiküldés a regisztrációról
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
        $mail->Subject = "Sikeres regisztráció!";
        $content = "
        <div style='background-color:#498ffc; border-radius: 10px; width: 100%; height: 100%; color:white; text-align: center'>  
        <img src='cid:logo_2u'><br> <b> <p style='color:white;'> Lodinn Kutyapanzió</p></b>
        <p>kutyusa második otthona,<br></p>
        </div>
        <div>
        <h3>  Kedves $veznev $keresztnev!<br></h3>
        <h3><b>  Köszöjük, hogy regisztráltál a Lodinn Kutyapanzió rendszerébe!</b></h3><br>
        <p style='text-align: justify;'>Örülünk, hogy ügyfeleink között köszönthetünk! Mi egy olyan kutyapanziót üzemeltetünk, ahol négylábú barátodnak otthonos és biztonságos környezetet biztosítunk. Nálunk nem csak egy szobában vagy ketrecben tölti az időt kedvenced, hanem szabadon játszhat és futkározhat a nagy kertünkben, ahol más kutyusokkal is megismerkedhet. Ne feledd, hogy az elhelyezés mellett különböző szolgálatásainkkal is meglepheted kutyusod.</p><br>
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
        var_dump($mail);
        } else {
        echo "Email sent successfully";
        }


            
        } catch (PDOException $e){
        $error = "Adatbázis hiba: ".$e->getMessage();
        } catch (Exception $e) {
        $error = "Hiba: ".$e->getMessage();
        }
    } else {
        $error = "Hibás adatok";
    }

}




?>