<?php
require 'header.php';
if(isset($_SESSION["username"])){
        $username = $_SESSION["username"];
        
        
        try{
        $sql = "SELECT * FROM lodinn.felhasznalok WHERE felhasznalok.felhNev LIKE '%".$username."%'";
        $result = $conn->prepare($sql);
        $result->execute();
        if($result ->rowCount() !=0){
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $db_Id = $row['felhID'];
                $db_username = $row['felhNev'];
                $db_password = $row['jelszo'];  
                
            }   
           
        }

        $sql2 = "SELECT * FROM lodinn.vendegek WHERE vendegek.felh_ID = $db_Id";
        $result = $conn->prepare($sql2);
        $result->execute();
        if($result ->rowCount() !=0){
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $db_vezNev = $row['vezNev'];
                $db_kerNev = $row['kerNev'];
                $db_email = $row['email'];
                $db_telszam = $row['telszam'];
                $db_iranyitoszam = $row['iranyitoszam'];
                $db_megye = $row['megye'];
                $db_varos = $row['varos'];
                $db_utca = $row['utca'];
                $db_hazszam = $row['hazszam'];            
            }
           
        }        
    }catch (PDOException $e){
        echo "Adatbázis hiba: " .$e->getMessage();    
    } catch (Exception $e){
        echo "Egyéb hiba: " .$e->getMessage();
        die();
    } 
}

?>

<script src="./jQuery/jquery-3.6.4.min.js"></script>
<section id="sectionprofile">
<div class="container text-justify p-3" >
        <div class="text-center">    
        <h1 id="titleprofile"><i class="bi bi-person"></i> Profilom</a></h1>
        <p> A profilom menüpont lehetővé teszi a felhasználók számára, hogy megtekintsék vagy szerkesszék a regisztráció során megadott adataikat.</p><br>
        </div>
        <form id="form_profile" class="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post" autocomplete="off">
      <div class="separator">
           <b>ALAPADATOK</b>
          </div>
      <div class="row g-3"> 
          <div class="col">
            <label class="form-label fw-bold" for="veznev_profile">Vezetéknév </label>
            <input type="text" class="form-control" id="id_profile" name="id_profile" required value="<?php if(isset($db_Id)) {echo $db_Id;};?>" placeholder="vezetékneve" autofocus style="display:none;">
            <input type="text" class="form-control" id="veznev_profile" name="veznev_profile" required value="<?php if(isset($db_vezNev)) {echo $db_vezNev;};?>" placeholder="vezetékneve" autofocus><br>
          </div>
             
          <div class="col">
            <label class="form-label fw-bold" for="keresztnev_profile">Keresztnév </label>
            <input type="text" class="form-control" id="keresztnev_profile" name="keresztnev_profile" required value="<?php if(isset($db_kerNev)){echo $db_kerNev;};?>" placeholder="keresztneve"><br>
          </div>
        </div>

          <div class="row g-3">
                <div class="col">
                    <label class="form-label fw-bold" for="user_profile"><i class="bi bi-person" style="color:#498ffc"></i> Felhasználónév </label>
                    <input type="text" class="form-control" id="user_profile" name="user_profile" required value="<?php if(isset($db_username)){echo $db_username;};?>" placeholder="felhasználóneve"><br>
                </div>

                <div class="col">
                    <label class="form-label fw-bold" for="mail_profile"><i class="bi bi-envelope-paper-heart" style="color:#498ffc"></i> Email cím </label>
                    <input type="text" class="form-control" id="mail_profile" name="mail_profile" required value="<?php if(isset($db_email)){echo $db_email;};?>" placeholder="email címe"><br>
                </div>
          </div>
          <div class="row g-3">
            <div class="col">
                  <label class="form-label fw-bold" for="phone_profile"><i class="bi bi-telephone" style="color:#498ffc"></i> Telefonszám</label>
                  <label class="form-sub-label">Formátum: +36(körzetszám)123-4567</label>
                  <input type="text" class="form-control" id="phone_profile" name="phone_profile" required value="<?php if(isset($db_telszam)){echo $db_telszam;};?>" placeholder="telefonszáma" pattern="[\+]36[\(]\d{1,2}[\)]\d{3}[\-]\d{3,4}" title="Formátum: +36(körzetszám)123-4567. Kérjük ügyeljen a zárójelekre és a kötőjelekre is!"><br>
              </div>
              <div class="col" id=""> 
              </div>
          </div>

          <div class="separator">
           <b>LAKCÍM</b>
          </div> 
            <div class="row">
                  <div class="col col-sm-5">
                      <label class="form-label fw-bold " for="megye_profile"> Megye </label>
                      <input type="text" class="form-control large" id="megye_profile" name="megye_profile" required value="<?php if(isset($db_megye)){echo $db_megye;};?>" placeholder="lakcím szerinti megye"><br>
                  </div>

                  <div class="col col-sm-2">
                      <label class="form-label fw-bold" for="iranyitoszam_profile">Irányítószám </label>
                      <input type="number" class="form-control large" id="iranyitoszam_profile" name="iranyitoszam_profile" required value="<?php if(isset($db_iranyitoszam)){echo $db_iranyitoszam;};?>" placeholder="" autocomplete="off"><br>
                      <datalist id="iranyitoszamok"></datalist>
                  </div>
                  <div class="col col-sm-5">
                      <label class="form-label fw-bold" for="telepules_profile">Település </label>
                      <input type="text" class="form-control large" id="telepules_profile" name="telepules_profile" required value="<?php if(isset($db_varos)){echo $db_varos;};?>" placeholder="lakcím szerinti település"><br>
                  </div>      
            </div>

            <div class="row">
                  <div class="col col-sm-5">
                      <label class="form-label fw-bold" for="utca_profile"> Utca </label>
                      <input type="text" class="form-control large" id="utca_profile" name="utca_profile" required value="<?php if(isset($db_utca)){echo $db_utca;};?>" placeholder="utca megnevezése"><br>
                  </div>

                  <div class="col col-sm-2">
                      <label class="form-label fw-bold" for="hazszam_profile"> Házszám </label>
                      <input type="number" class="form-control large" id="hazszam_profile" name="hazszam_profile" required value="<?php if(isset($db_hazszam)){echo $db_hazszam;};?>" placeholder=""><br>
                  </div>
                  <div class="col col-sm-5">
                  </div>
            </div>
         
          <div class="separator">
           <b>JELSZÓ</b>
          </div>
          <button type="button" class="btn btn-danger" onclick="mutat()"><i class="bi bi-person-lock"></i>Jelszó módosítása</button>
          <div class="row g-3" id="jelszovaltozas" style="display:none;">
              <div class="col" style="margin-top: 2%;">
                  <label class="form-label fw-bold" for="pass_profile"><i class="bi bi-person-lock" style="color:#498ffc"></i>  Jelszó megváltoztatása  </label>
                  <div class="input-group" id="show_hide_password">
                      <input type="password" class="form-control" id="pswd_profile" name="pass_profile" value="" placeholder="régi jelszó">
                  </div>
                  <div class="col" id="resultpass"> 
                  </div>
                  <div class="input-group">
                  <input type="password" class="form-control" id="pswdnew_profile" name="pswdnew_profile"  value="" placeholder="új jelszó" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="A jelszónak tartalmaznia kell legalább egy számot, egy nagybetűt, egy kisbetűt és minimum 8 karakter hosszúnak kell lennie!" aria-describedby="passHelp" style="margin-top:2%; display:none;">
                  </div>             
                </div>
                <p id="passHelp" class="form-text">Az új jelszónak tartalmaznia kell legalább egy számot, egy nagybetűt, egy kisbetűt és minimum 8 karakter hosszúnak kell lennie!</p>
              
            <div class="col" id="pass1_profile">
              <div id="message_profile" style="display:none;">
                <h5>Jelszó segítség:</h5>
                <p id="letter_profile" class="invalid">Egy <b>kisbetű</b></p>
                <p id="capital_profile" class="invalid">Egy <b>nagybetű</b> </p>
                <p id="number_profile" class="invalid">Egy <b>szám</b></p>
                <p id="length_profile" class="invalid">Minimum <b>8 karakter</b></p>
              </div>
            </div>
 


              <input type="password" class="form-control" id="password2_profile" name="password2_profile" value="" placeholder="új jelszó megerősítése" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="A jelszónak tartalmaznia kell legalább egy számot, egy nagybetűt, egy kisbetűt és minimum 8 karakter hosszúnak kell lennie!" aria-describedby="passHelp" style="display:none;">


            <div class="col" id="ellenorzes_profile"> 
            </div>
            </div>
           <div class="col">
            <button class="btn btn-primary" type="submit" name="submit_profile" id="submit_profile" style="margin-top: 4%;margin-bottom: 8%;"><i class="bi bi-save"></i>  Módosítások mentése</button>
          </div>  
            <div class="col" id="visszajelzes_profile" style="margin-top: 0%;margin-bottom: 8%;"> 
            </div>  
    </form>     
  </div>

       
</div>
</section>

<script>
  // jelszó ellenőrzés
var myInput = document.getElementById("pswdnew_profile");
var letter = document.getElementById("letter_profile");
var capital = document.getElementById("capital_profile");
var number = document.getElementById("number_profile");
var length = document.getElementById("length_profile");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message_profile").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message_profile").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}

// jelszo és jelszo ellenőrzés mezők ellenőrzése
$(document).ready(function(){
    $('#password2_profile').keyup(function(){
        var passw = $('#pswdnew_profile').val();
        var passw2 = $('#password2_profile').val();
        if(passw2.length >= 3)
        {
          if(passw != passw2){
            $('#ellenorzes_profile').html('<p style ="color: red;"><i class="bi bi-exclamation-circle"></i> A jelszó és a jelszó megerősítés mezők nem egyeznek meg!</p>');
            $(':input[type="submit"]').prop('disabled', true);
          }else{
            $('#ellenorzes_profile').html("<i class='bi bi-check' style='color:green;'></i>A jelszó és a jelszó megerősítés mezők megegyeznek");
            $(':input[type="submit"]').prop('disabled', false);
          } 
        }
        });
     });

//régi jelszó ellenőrzése
$(document).ready(function(){
    $('#pswd_profile').keyup(function(){
        var passw = $('#pswd_profile').val();
        var username = $('#user_profile').val();
        $('#resultpass').html('');
        if (passw.length >=0)
         {
        $.ajax({
            url: "pswdcheck.php",
            method: "post",
            data: {
                   pswrd: passw,
                   usern: username,
                  },
            dataType: "text",
            success: function(data){
                
                if (data == ""){
                  $('#resultpass').html("<p style='color:green;'><i class='bi bi-check' style='color:green;'></i> A megadott jelszó helyes!</p>");
                  $('#pswdnew_profile').show();
                  $('#password2_profile').show();
                    ;
                }else {
                    $('#pswd_profile').focus();
                    $('#resultpass').html("<p style='color:red;'><i class='bi bi-exclamation-circle-fill'></i> Nem megfelelő a jelszó! Kérem próbálja meg újra!</p>");
                }
            },
            error : function(err){
                alert(Error);
            }
        });
      }
        });
     });



//update

$(document).ready(function() {
  $('#form_profile').on("submit",(function(e){
        e.preventDefault();
        var Id = $('#id_profile').val();
        var veznev = $('#veznev_profile').val();
        var keresztnev = $('#keresztnev_profile').val();
        var user = $('#user_profile').val();
        var mail = $('#mail_profile').val();
        var phone = $('#phone_profile').val();
        var megye = $('#megye_profile').val();
        var iranyitoszam = $('#iranyitoszam_profile').val();
        var telepules = $('#telepules_profile').val();
        var utca = $('#utca_profile').val();
        var hazszam = $('#hazszam_profile').val();
        var passw = $('#pswdnew_profile').val();
        if(Id !=""){
            $.ajax({
                url:"profileupdate.php",
                method:"post",   
                data:{
                  id: Id,
                  ve: veznev,
                  ke: keresztnev,
                  us: user,
                  ma: mail,
                  ph: phone,
                  me : megye,
                  ir: iranyitoszam,
                  te: telepules,
                  ut:utca,
                  ha:hazszam,
                  pa:passw
                },

                dataType: "text",
                success: function(data){
                  $('#visszajelzes_profile').html("<i class='bi bi-check' style='color:green;'></i> <h5 style='color:green;'>Módosítás elmentve!");
                    },
                  error : function(err){
                      alert(Error);
                  },

                })

            }
          
          }))});


function mutat() {
  $('#jelszovaltozas').show();

};

</script>


<?php 
require 'footer.php';
?>