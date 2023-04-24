<?php
require 'dbconnect.php';
require 'headeradmin.php';
?>
<div class="position-fixed top-50 start-50">
<div class="alert alert-success alert-dismissible fade show" role="alert" id="toroluzenet" style="display: none;">
 <i class="bi bi-info-circle-fill"></i> Törölés sikeres!
  <button type="button" class="btn-close" data-dismiss="alert" id="close2" aria-label="Close">
  </button>
</div>
</div>

<div class="alert alert-success alert-dismissible fade show" role="alert" id="hozzaaduzenet" style="display: none;">
 <i class="bi bi-info-circle-fill"></i> Hozzáadás sikeres!
  <button type="button" class="btn-close" data-dismiss="alert" id="close3" aria-label="Close">
  </button>
</div>


<section >
<div id="sectionback"> 
<div class="container p-3" id="sectionprofile">
    <div class="text-center" id="sectionprofile2">    
        <h1 id="titleprofile" style="margin-top: 10%; text-shadow: 1px 1px 2px black;"><i class="bi bi-person-vcard"></i>  Dolgozói felület </a></h1>
        <p> A dolgozói felület lehetővé teszi, hogy a panzió adatait,<br> árait megtekintsék vagy szerkesszék, <br> a foglalásokat kezeljék vagy akár híreket tegyenek közzé.</p><br>
    </div>
</div>
<!-- panzió adatainak lekérése -->
<?php
if(isset($_SESSION["usernameadmin"])){

        try{ 
            
            $sql = "SELECT * FROM lodinn.felhasznalok WHERE felhasznalok.felhNev LIKE :fel";
            $result = $conn->prepare($sql);
            $felcheck = "%".$username."%";
            $result -> bindParam(':fel',$username, PDO::PARAM_STR);
            $result->execute();
            
            if($result ->rowCount() !=0){
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $db_felhID = $row['felhID'];
                    
                }
            }

            $sql2 = "SELECT * FROM lodinn.dolgozok WHERE dolgozok.felh_ID = ?";
            $result2 = $conn->prepare($sql2);
            $result2->bindParam(1, $db_felhID, PDO::PARAM_INT);
            $result2->execute(); 
            
            if($result2 ->rowCount() !=0){
                while($row = $result2->fetch(PDO::FETCH_ASSOC)){
                    $db_panzioID = $row['panzio_ID'];
                }
            }

            $sql3 = "SELECT * FROM lodinn.panziok WHERE panziok.panzioID = ?";
            $result3 = $conn->prepare($sql3);
            $result3->bindParam(1, $db_panzioID, PDO::PARAM_INT);
            $result3->execute(); 
            
            if($result2 ->rowCount() !=0){
                while($row = $result3->fetch(PDO::FETCH_ASSOC)){
                    $db_panzioNev = $row['nev'];  //
                    $db_panzioTel = $row['telszam']; // 
                    $db_panzioEmail = $row['email']; //
                    $db_panzioKapac = $row['kapacitas'];//
                    $db_panzioIrszam = $row['iranyitoszam'];//
                    $db_panzioMegye = $row['megye'];//
                    $db_panzioVaros = $row['varos'];//
                    $db_panzioUtca = $row['utca'];//
                    $db_panzioAdo = $row['adoszam'];//
                    $db_panzioCegj = $row['cegjegyzek'];//
                    $db_panzioEng = $row['engedely'];//
                    $db_panzioHazsz = $row['hazszam'];//
                    $db_panzioBemut = $row['bemutatkozas'];          
                }
            }

    } catch (PDOException $e){
        echo "Adatbázis hiba: " .$e->getMessage();    
    } catch (Exception $e){
        echo "Egyéb hiba: " .$e->getMessage();
        die();
    } 
}

?>
<!-- panzió adatainak lekérésének vége -->
<!-- panzió adatok szerkesztéséhez űrlap-->

<div class="container-lg text-justify p-3" id="adatok">
        <div class="text-center">    
        <h1 id="titleprofile"><i class="bi bi-house"></i> Panzióm </a></h1>
        
        </div>
        <form id="form_panzio" class="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post" autocomplete="off">
      <div class="separator">
           <b> <i class="bi bi-clipboard2-data"></i> ALAPADATOK</b>
          </div>
      <div class="row g-3"> 
          <div class="col">
            <label class="form-label fw-bold" for="panzionev"><i class="bi bi-house" style="color:#498ffc"></i>  Panzió elnevezése </label>
            <input type="text" class="form-control" id="id_panzio" name="id_panzio" required value="<?php if(isset($db_panzioID)) {echo $db_panzioID;};?>" placeholder="panzió id" autofocus style="display:none;">
            <input type="text" class="form-control" id="panzionev" name="panzionev" required value="<?php if(isset($db_panzioNev)) {echo $db_panzioNev;};?>" placeholder="panzió neve" autofocus><br>
          </div>
             
          <div class="col">
            <label class="form-label fw-bold" for="panziotel"> <i class="bi bi-telephone" style="color:#498ffc"></i> Telefonszám </label>
            <input type="text" class="form-control" id="panziotel" name="panziotel" required value="<?php if(isset($db_panzioTel)){echo $db_panzioTel;};?>" placeholder="telefonszám  - formátum: +36(körzetszám)123-4567"><br>
            <label class="form-sub-label"></label>
          </div>
        </div>

          <div class="row g-3">
                <div class="col">
                    <label class="form-label fw-bold" for="panzioemail"><i class="bi bi-envelope-paper-heart" style="color:#498ffc"></i> Email cím</label>
                    <input type="text" class="form-control" id="panzioemail" name="panzioemail" required value="<?php if(isset($db_panzioEmail)){echo $db_panzioEmail;};?>" placeholder="email cím"><br>
                </div>

                <div class="col">
                    <label class="form-label fw-bold" for="kapacitas"> <i class="bi bi-battery-full" style="color:#498ffc"></i> Kapacitás </label>
                    <input type="text" class="form-control" id="kapacitas" name="kapacitas" required value="<?php if(isset($db_panzioKapac)){echo $db_panzioKapac;};?>" placeholder="kapacitás "><br>
                </div>
          </div>
          

          <div class="separator">
           <b> <i class="bi bi-geo-alt-fill"></i> CÍM ADATOK</b>
          </div> 
            <div class="row">
                  <div class="col col-sm-5">
                      <label class="form-label fw-bold " for="megye"> Megye </label>
                      <input type="text" class="form-control large" id="megye" name="megye" required value="<?php if(isset($db_panzioMegye)){echo $db_panzioMegye;};?>" placeholder="megye"><br>
                  </div>

                  <div class="col col-sm-2">
                      <label class="form-label fw-bold" for="iranyitoszam">Irányítószám </label>
                      <input type="number" class="form-control large" id="iranyitoszam" name="iranyitoszam" required value="<?php if(isset($db_panzioIrszam)){echo $db_panzioIrszam;};?>" placeholder="irányítószám" autocomplete="off"><br>
                      <datalist id="iranyitoszamok"></datalist>
                  </div>
                  <div class="col col-sm-5">
                      <label class="form-label fw-bold" for="telepules">Település </label>
                      <input type="text" class="form-control large" id="telepules" name="telepules" required value="<?php if(isset($db_panzioVaros)){echo $db_panzioVaros;};?>" placeholder="település"><br>
                  </div>      
            </div>

            <div class="row">
                  <div class="col col-sm-5">
                      <label class="form-label fw-bold" for="utca"> Utca </label>
                      <input type="text" class="form-control large" id="utca" name="utca" required value="<?php if(isset($db_panzioUtca)){echo $db_panzioUtca;};?>" placeholder="utca"><br>
                  </div>

                  <div class="col col-sm-2">
                      <label class="form-label fw-bold" for="hazszam"> Házszám </label>
                      <input type="text" class="form-control large" id="hazszam" name="hazszam" required value="<?php if(isset($db_panzioHazsz)){echo $db_panzioHazsz;};?>" placeholder="házszám"><br>
                  </div>
                  <div class="col col-sm-5">
                  </div>
            </div>
         
          <div class="separator">
           <b>EGYÉB</b>
          </div>
          <div class="row">
                  <div class="col col-sm-6">
                      <label class="form-label fw-bold " for="adoszam"> Adószám </label>
                      <input type="text" class="form-control large" id="adoszam" name="adoszam" required value="<?php if(isset($db_panzioAdo)){echo $db_panzioAdo;};?>" placeholder="adószám"><br>
                  </div>

                  <div class="col col-sm-6">
                      <label class="form-label fw-bold" for="cegjegyzek"> Cégjegyzék szám</label>
                      <input type="number" class="form-control large" id="cegjegyzek" name="cegjegyzek" required value="<?php if(isset($db_panzioCegj)){echo $db_panzioCegj;};?>" placeholder="cégjegyzékszám" autocomplete="off"><br>
                  </div>
            </div>
            <div class="row">
                  <div class="col col-sm-6">
                      <label class="form-label fw-bold " for="engedely"> Engedély szám </label>
                      <input type="text" class="form-control large" id="engedely" name="engedely" required value="<?php if(isset($db_panzioEng)){echo $db_panzioEng;};?>" placeholder="engedély száma"><br>
                  </div>
             </div>

             <div class="row">
                  <div class="col col-sm-12">
                      <p><label class="form-label fw-bold " for="bemutat">Bemutatkozás</label></p>
                      <textarea class="form-control" id="bemutat" name="bemutat" rows="4" maxlength="1000"><?php if(isset($db_panzioBemut)){echo $db_panzioBemut;};?></textarea>
                      <div id="the-count">
                        <span id="current">0</span>
                        <span id="maximum">/ 1000</span>
                    </div>
                  </div>
             </div>
                      
           <div class="col">
            <button class="btn btn-primary" type="submit" name="submit_profile" id="submit_profile" style="margin-top: 4%;margin-bottom: 2%;"><i class="bi bi-save"></i>  Módosítások mentése</button>
          </div>  
            <div class="col" id="visszajelzes" style="margin-top: 0%;margin-bottom: 1%;"> 
            </div>  
    </form>     
  </div>

       
</div>
<!-- panzió adatok szerkesztéséhez űrlap vége-->
</section>
<!-- panzió árai-->
<section id="arak">
<div class="container text-justify p-3" id="ar">
        <div class="text-center"><div class="separator">    
        <h1 id="titleprofile"><i class="bi bi-tag"></i> Árak </a></h1>    
    </div></div>
</div>

<!-- szolgáltatások kiolvasása -->
 <div class="text-center">  
<table class="table table-striped" id="datatable" style="width: 100%;">
<thead>
        <tr style="background-color: #498ffc; color: white;">
            <th scope="col">SZOLGÁLTATÁS</th>
            <th scope="col">ÁR</th>
            <th scope="col">SZERKESZTÉS</th>
            <th scope="col">TÖRLÉS</th>
        </tr>
</thead>
  <tbody id="table_data"> 

            <?php
            try{

                $sql4 = "SELECT * FROM lodinn.arak INNER JOIN lodinn.arai ON arak.kategoriaID = arai.kategoria_ID WHERE panzio_ID=?";
                $result4 = $conn->prepare($sql4);
                $result4->bindParam(1, $db_panzioID, PDO::PARAM_INT);
                $result4->execute();
                if($result4 ->rowCount() !=0){
                    while($row = $result4->fetch(PDO::FETCH_ASSOC)){
                        $db_szolgID = $row['kategoriaID'];
                        $db_szolg = $row['kategoriaNev'];
                        $db_ar = $row['ar'];
                        echo "<tr id='szolgaltatas$db_szolgID'>";
                        echo "<td >$db_szolg</td>";
                        echo "<td>$db_ar ,-Ft</td>";
                        echo "<td><a href='serviceupdate.php?id=$db_szolgID' type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Szerkesztés'><i class='bi bi-pen'></i></a></td>";
                        echo "<td><button onclick='szolgtorlAjax($db_szolgID)'type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Törlés'><i class='bi bi-trash3'></i></button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Nincs eredménye a lekérdezésnek!";
                }    
            } catch (PDOException $e){
                        echo "Adatbázis hiba: " .$e->getMessage();                 
            } catch (Exception $e){
                        echo "Egyéb hiba: " .$e->getMessage();
                        die();
                    } 
        ?>   
    </tbody>
 </table>
 <button id="ujszolggomb" style="margin-top: 2%;margin-bottom: 2%;" onclick='ujszolgAjax()'type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Új szolgáltatás rögzítése'><i class="bi bi-plus-circle"></i> ÚJ SZOLGÁLTATÁS RÖGZÍTÉSE</button>
 </div>
<!-- Új szolgáltatás rögzítése -->
 <div style=" padding: 2%; width: 100%; display:none;" id="ujszolgdiv">
    <div class="separator">
            <h1><i class="bi bi-plus-circle";></i> Új szolgáltatás hozzáadása</h1>
    </div> 
        <!-- Űrlap -->
        <form method="" id="ujszolg" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <div class="form-group ">
                <label for="szolgneve"></label><br>
                <div class="">
                <input type="text" class="form-control" id="id_panzio" name="id_panzio" required value="<?php if(isset($db_panzioID)) {echo $db_panzioID;};?>" placeholder="panzió id" autofocus style="display:none;">
                <input type="text" name="szolgneve" id="szolgneve" placeholder="Szolgáltatás neve" class="form-control">
                </div>
 
                <label for="ar"></label><br>
                <div class="">
                <input type="text" name="ar" id="ar" placeholder="Szolgáltatás ára" class="form-control">
                </div>

                <div class="col-auto my-2">
                <input type="submit" value="Rögzítés" name="submit" id="submit" class="btn btn-primary">
                 </div>
                 <div class="col" id="visszajelzes2" style="margin-top: 0%;margin-bottom: 1%;"> 
                </div>  
                </div>
            </form>
    </div>
    </div>
</section>
<!-- panzió árainak vége-->
<!-- panzió foglalásai-->

<section id="foglalasok">
<div class="container text-justify p-3" id="foglal">
        <div class="text-center">  <div class="separator">  
        <h1 id="titleprofile"><i class="bi bi-heart"></i> Foglalások </a></h1>
        </div>
    </div>
</div>

<div class="table-responsive text-center">  
<table class="table table-striped" id="datatable" style="overflow-x:auto;">

<thead>
        <tr style="background-color: #498ffc; color: white;">
            <th scope="col">FOGLALÁS IDŐPONTJA</th>
            <th scope="col">VEZETÉKNÉV</th>
            <th scope="col">KERESZTNÉV</th>
            <th scope="col">FOGLALÁS KEZDŐ NAPJA</th>
            <th scope="col">FOGLALÁS UTOLSÓ NAPJA</th>
            <th scope="col">KUTYA NEVE</th>
            <th scope="col">BŐVEBBEN</th>
            <th scope="col">TÖRLÉS</th>
        </tr>
</thead>
  <tbody id="table_data">

<?php
if(!empty($db_panzioID)){
    try{ 
        $sql5 = "SELECT * FROM lodinn.foglalasok WHERE foglalasok.panzio_ID = ?";
        $result5 = $conn->prepare($sql5);
        $result5->bindParam(1, $db_panzioID, PDO::PARAM_INT);
        $result5->execute();

        if($result5 ->rowCount() !=0){
            while($row = $result5->fetch(PDO::FETCH_ASSOC)){
                $db_rogzites = $row['rogzites'];  
                $db_foglalID = $row['foglID'];
                $db_vegosszeg = $row['vegosszeg'];
                
                $sql6 = "SELECT * FROM lodinn.tartozik WHERE tartozik.fogl_ID = ?";
                $result6 = $conn->prepare($sql6);
                $result6->bindParam(1, $db_foglalID, PDO::PARAM_INT);
                $result6->execute();
        
                if($result6 ->rowCount() !=0){
                    while($row = $result6->fetch(PDO::FETCH_ASSOC)){
                        $db_kezdoDatum = $row['kezdoDatum'];  
                        $db_vegDatum = $row['vegDatum']; 
                        $db_szallitas = $row['szallitas'];
                        $db_specialisIgenyek = $row['specialisIgenyek'];
                        $db_kutyaID = $row['kutya_ID'];
                        if($db_szallitas == 2){
                            $szallitastker = "nem kér";
                        }else{
                            $szallitastker = "kér";
                        }
    
                        $sql7 = "SELECT * FROM lodinn.kutyak WHERE kutyak.kutyaID = ?";
                        $result7 = $conn->prepare($sql7);
                        $result7->bindParam(1, $db_kutyaID, PDO::PARAM_INT);
                        $result7->execute();

                        if($result7 ->rowCount() !=0){
                            while($row = $result7->fetch(PDO::FETCH_ASSOC)){
                                $db_kutyaNev = $row['kutyaNev'];  
                                $db_kor = $row['kor']; 
                                $db_fajta = $row['fajta'];
                                $db_vendeg_ID = $row['vendeg_ID'];
                                $db_timeStamp =  $row['rogzites'];   
                                $currenttime = date("Y-m-d H:i:s");
                                $ts1 = strtotime($db_timeStamp);
                                $ts2 = strtotime($currenttime);
                                $year1 = date('Y', $ts1);
                                $year2 = date('Y', $ts2);
                                $month1 = date('m', $ts1);
                                $month2 = date('m', $ts2);
                                $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                                $currentage = $db_kor + $diff;

                                $sql9 = "SELECT * FROM lodinn.vendegek WHERE vendegek.vendegID = ?";
                                $result9 = $conn->prepare($sql9);
                                $result9->bindParam(1, $db_vendeg_ID, PDO::PARAM_INT);
                                $result9->execute();
                            
                                if($result9 ->rowCount() !=0){
                                    while($row = $result9->fetch(PDO::FETCH_ASSOC)){
                                        $db_vezNev = $row['vezNev'];
                                        $db_kerNev = $row['kerNev'];
                                        $db_email = $row['email'];
                                        $db_telszam = $row['telszam'];
                                        $db_iranyitoszam = $row['iranyitoszam'];
                                        $db_megye = $row['megye'];
                                        $db_varos = $row['varos'];
                                        $db_utca = $row['utca'];
                                        $db_hazszam = $row['hazszam']; 

                                            echo "<tr id='foglalas$db_foglalID'>";
                                            echo "<td >$db_rogzites</td>";
                                            echo "<td>$db_vezNev</td>";
                                            echo "<td>$db_kerNev</td>";
                                            echo "<td>$db_kezdoDatum</td>";
                                            echo "<td>$db_vegDatum</td>";
                                            echo "<td>$db_kutyaNev</td>";
                                            echo "<td><button onclick='modalAjax($db_foglalID)'id='bovebben' type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Bővebben'> <i class='bi bi-three-dots-vertical'></i></a></td>";
                                            echo "<td><button onclick='deleteAjax($db_foglalID)'type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Törlés'><i class='bi bi-trash3'></i></button></td>";
                                            echo "</tr>";
                                            echo "
                                            <tr id='legordulo$db_foglalID' style='display: none;'><th> FOGLALÁS TOVÁBBI RÉSZLETEI: </th><br><td><b>Foglaló email címe:</b> <br> $db_email <br><b>Foglaló telefonszáma:</b> <br> $db_telszam </td><td> <b>Irányítószám:</b> $db_iranyitoszam <br> <b>Megye:</b> $db_megye <br> <b>Település:</b> $db_varos <br> <b>Utca:</b> $db_utca <br> <b>Házszám: </b> $db_hazszam</td><td> <b>Szállítási igény:</b> $szallitastker <br> <b>Speciális igények:</b> <br> $db_specialisIgenyek </td><td> <b>Kutya fajtája:</b> $db_fajta <br> <b>Kora:</b> $currentage hónapos</td><td><b>Végösszeg:</b> $db_vegosszeg ,-Ft <br> <b>Igényelt szolgáltatások:<br></b>
                                            ";

                                            $sql8 = " SELECT kategoriaNev FROM lodinn.arak INNER JOIN lodinn.ar ON ar.kategoriaAr_ID = arak.kategoriaID WHERE ar.kutyaAr_ID = ? AND ar.foglAr_ID = ?;";
                                            $result8 = $conn->prepare($sql8);
                                            $result8->bindParam(1, $db_kutyaID, PDO::PARAM_INT);
                                            $result8->bindParam(2, $db_foglalID, PDO::PARAM_INT);
                                            $result8->execute();
    
                                            if($result8 ->rowCount() !=0){
                                            while($row = $result8->fetch(PDO::FETCH_ASSOC)){
                                                 foreach ($row as $kategoria){
                                                    echo " -$kategoria <br>";
                                                }
                                        } 

                                        echo " </td><td><button onclick='hide($db_foglalID)' type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Elrejt'>Elrejt</button></td>
                                        </tr>
                                        ";    
                                    }  else {
                                        echo "A foglalásoz nincs egyéb szolgáltatás igénylés";
                                    }    

                            }    
                        }
                    }
                }
            }
        }
    } 
 
} }catch (PDOException $e){
        echo "Adatbázis hiba: " .$e->getMessage();    
    } catch (Exception $e){
        echo "Egyéb hiba: " .$e->getMessage();
        die();
    } 
}
?>
</tbody>
 </table>
 </div>



</section>
<!-- panzió foglalásainak vége-->

<!-- hírek -->
<section id="hirek">
<div class="container text-justify p-3" id="hirek">
        <div class="text-center">  <div class="separator">  
        <h1 id="titleprofile"><i class="bi bi-newspaper"></i> Hírek </a></h1>
        </div>
    </div>
</div>
<div class="container py-5">
<div class="row text-center">
<?php
  try{ 
            $sql = "SELECT * FROM lodinn.hirek WHERE hirek.panzio_ID LIKE :id";
            $result = $conn->prepare($sql);
            $result -> bindParam(':id',$db_panzioID, PDO::PARAM_STR);
            $result->execute();
            
            if($result ->rowCount() !=0){
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $db_hirID = $row['hirID'];
                    $db_cim = $row['cim'];
                    $db_leiras = $row['leiras'];
                    $db_datum = $row['datum'];

                    $db_leiras = strip_tags($db_leiras);
                    if (strlen($db_leiras) > 100) {

                        // truncate string
                        $stringCut = substr($db_leiras, 0, 500);
                        $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                        $db_leiras = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                        $db_leiras .= '...';
                    }
                    echo '
                   
                    <div class="col-sm-6 col-md-4 mb-4 mb-md-0" id="hir'.$db_hirID.'">
                        <div class="card col-12">
                        <div class="card-body py-4 mt-2">
                            <div class="justify-content-center mb-4">
                                <img src="assets/images/dog3.png"
                                    class="rounded-circle shadow-1-strong" width="80" height="80" />
                            </div>
                            <p class="font-weight">'.$db_datum.'</p>
                            <h6 class="font-weight-bold my-3">'.$db_cim.'</h6>
                            <p class="mb-2 text-muted justify">
                            '.$db_leiras.'
                            </p>
                            <button type="button" class="btn btn-primary" style="margin-top:5%;"><a style ="text-decoration: none; color:white" href="newsupdate.php?id='.$db_hirID.'"> <i class="bi bi-pen"></i> Szerkesztés</a></button> 
                            <button onclick="deleteNews('.$db_hirID.')" type="button" class="btn btn-primary" style="margin-top:5%;"><i class="bi bi-trash3"></i> Törlés</a></button>
                        </div>
                        </div>
                    </div>

                    ';
                }
            }

    } catch (PDOException $e){
        echo "Adatbázis hiba: " .$e->getMessage();    
    } catch (Exception $e){
        echo "Egyéb hiba: " .$e->getMessage();
        die();
    } 
?>
</div>

<div class="text-center">
<button id="ujhirgomb" style="margin-top: 2%;margin-bottom: 2%;" onclick='ujhir()'type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Új hír rögzítése'><i class="bi bi-plus-circle"></i> ÚJ HÍR RÖGZÍTÉSE</button>
 </div>
<!-- Új hír rögzítése -->
 <div style=" padding: 2%; width: 100%; display:none;" id="ujhirdiv">
    <div class="separator">
            <h1><i class="bi bi-plus-circle";></i> Új hír hozzáadása</h1>
    </div> 
        <!-- Űrlap -->
        <form method="" id="ujhir" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <div class="form-group ">
                <label for="hircime"></label><br>
                <div class="">
                <input type="text" class="form-control" id="id_panzio" name="id_panzio" required value="<?php if(isset($db_panzioID)) {echo $db_panzioID;};?>" placeholder="panzió id" autofocus style="display:none;">
                <input type="text" name="hircime" id="hircime" placeholder="Hír címe" class="form-control">
                </div>
 
                <label for="hirleiras"></label><br>
                <div class="">
                <textarea rows="4" name="hirleiras" id="hirleiras" class="form-control" placeholder="Hír leírása"></textarea>
                </div>

                <div class="col-auto my-2">
                <input type="submit" value="Rögzítés" name="submit" id="submit" class="btn btn-primary">
                 </div>
                 <div class="col" id="visszajelzes3" style="margin-top: 0%;margin-bottom: 1%;"> 
                </div>  
                </div>
            </form>
    </div>
    </div>
    </div>
<!-- hírek vége -->

<script src="./jQuery/jquery-3.6.4.min.js"></script>
<script>

 



    //bemutatkozás karaktereinek számolása
    $('textarea').keyup(function() {
    
    var characterCount = $(this).val().length,
        current = $('#current'),
        maximum = $('#maximum'),
        theCount = $('#the-count');
      
    current.text(characterCount);

    if (characterCount > 900 && characterCount < 1000) {
    current.css('color', '#8f0001');
  }
    });


//panzió adatainak frissítése

$(document).ready(function() {
  $('#form_panzio').on("submit",(function(e){
        e.preventDefault();
        var Id = $('#id_panzio').val();
        var panzionev = $('#panzionev').val();
        var panziotel = $('#panziotel').val();
        var panzioemail = $('#panzioemail').val();
        var kapacitas = $('#kapacitas').val();
        var megye = $('#megye').val();
        var iranyitoszam = $('#iranyitoszam').val();
        var telepules = $('#telepules').val();
        var utca = $('#utca').val();
        var hazszam = $('#hazszam').val();
        var adoszam = $('#adoszam').val();
        var cegjegyzek = $('#cegjegyzek').val();
        var engedely = $('#engedely').val();
        var bemutat = $('#bemutat').val();
        if(Id !=""){
            $.ajax({
                url:"panzioupdate.php",
                method:"post",   
                data:{
                  id: Id,
                  pn: panzionev,
                  pt: panziotel,
                  pe: panzioemail,
                  ka: kapacitas,
                  me: megye,
                  ir: iranyitoszam,
                  te: telepules,
                  ut: utca,
                  ha: hazszam,
                  ad: adoszam,
                  ce: cegjegyzek,
                  en: engedely,
                  be: bemutat
                },

                dataType: "text",
                success: function(data){
                  $('#visszajelzes').html("<i class='bi bi-check' style='color:green;'></i> <h5 style='color:green;'>Módosítás elmentve!");
                    },
                  error : function(err){
                      alert(Error);
                  },

                })

            }
          
          }))});


function deleteAjax(id){
if(confirm('Biztos benne, hogy véglegesen törölni szeretné a foglalást?')){
    $.ajax({
        type: 'POST',
        url:'deletereservation.php',
        data:{id: id},
        success: function(data){
            $('#foglalas'+id).remove();
            $("#toroluzenet").show('slow');
        }

    });
}
}
function modalAjax(id){
    $("#legordulo"+id).show('slow');
    
}
function hide(id){
$("#legordulo"+id).hide('slow');
}

function szolgszerkAjax(id){
    if(id!==null){
    $.ajax({
        type: 'POST',
        url:'serviceupdate.php',
        data:{id: id},
        success: function(data){
        }

    });
}

}

$(document).ready(function() {
$("#close2").click(function bezar(){
    $("#toroluzenet").fadeOut('slow');
})
});

function szolgtorlAjax(id){
if(confirm('Biztos benne, hogy véglegesen törölni szeretné a szolgáltatást?')){
    $.ajax({
        type: 'POST',
        url:'deleteservice.php',
        data:{id: id},
        success: function(data){
            $('#szolgaltatas'+id).remove();
            $("#toroluzenet").show('slow');
            
        }
    });
}
}
$(document).ready(function() {
$("#close2").click(function bezar(){
    $("#toroluzenet").fadeOut('slow');
})

});
function ujszolgAjax(){
    $("#ujszolgdiv").show('slow');
    
}
function ujhir(){
    $("#ujhirdiv").show('slow');
    
}

$('#ujszolg').submit(function(e){

$.ajax({
    type:"POST",
    url:"insertservice.php",
    data: $('#ujszolg').serialize(),
    success: function(data){
        $('#visszajelzes2').html("<i class='bi bi-check' style='color:green;'></i> <h5 style='color:green;'>Szolgáltatás hozzáadva!");  
        setTimeout("window.location.href='adminloggedin.php';",800); 
    }
})
e.preventDefault();
})

$(document).ready(function() {
$("#close3").click(function bezar(){
$("#hozzaaduzenet").fadeOut('slow');
})

});


function deleteNews(id){

if(confirm('Biztos benne, hogy véglegesen törölni szeretné a hírt?')){
    $.ajax({
        type: 'POST',
        url:'deletenews.php',
        data:{id: id},
        success: function(data){
            $('#hir'+id).remove();
            $("#toroluzenet").show('slow');
            
            
        }

    });
}
}
// Új hír rögzítése
$('#ujhir').submit(function(e){

$.ajax({
    type:"POST",
    url:"insertnews.php",
    data: $('#ujhir').serialize(),
    success: function(data){
        $('#visszajelzes3').html("<i class='bi bi-check' style='color:green;'></i> <h5 style='color:green;'>Hír hozzáadva!");
        $('#ujhir')[0].reset();
        location.href = 'adminloggedin.php#hirek';
        location.reload()
    }
})
e.preventDefault();
})

$(document).ready(function() {
$("#close3").click(function bezar(){
$("#hozzaaduzenet").fadeOut('slow');
})

});
</script>
<?php 
require 'footer.php';
?>
