<?php
require 'dbconnect.php';
require 'headeradmin.php';
?>

<section id="sectionprofile">
<div class="container text-justify p-3" >
    <div class="text-center">    
        <h1 id="titleprofile"><i class="bi bi-person-vcard"></i>  Dolgozói felület </a></h1>
        <p> A dolgozói felület lehetővé teszi, hogy a panzió adatait, árait megtekintsék vagy szerkesszék, a foglalásokat kezeljék vagy akár híreket tegyenek közzé.</p><br>
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

<div class="container text-justify p-3" id="adatok">
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
            <button class="btn btn-primary" type="submit" name="submit_profile" id="submit_profile" style="margin-top: 4%;margin-bottom: 8%;"><i class="bi bi-save"></i>  Módosítások mentése</button>
          </div>  
            <div class="col" id="visszajelzes" style="margin-top: 0%;margin-bottom: 8%;"> 
            </div>  
    </form>     
  </div>

       
</div>
<!-- panzió adatok szerkesztéséhez űrlap vége-->
</section>




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


</script>
<?php 
require 'footer.php';
?>