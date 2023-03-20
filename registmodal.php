<?php

?>
<script src="./jQuery/jquery-3.6.4.min.js"></script>
<!-- The Modal -->
<div class="modal fade" id="registmodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="bi bi-person-add"></i>   REGISZTRÁCIÓ</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>


      <!-- Modal body -->
      <div class="modal-body">
      <form class="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post" autocomplete="off">
      <div class="separator">
           <b>ALAPADATOK</b>
          </div>
      <div class="row g-3"> 
          <div class="col">
            <label class="form-label fw-bold" for="veznev">Vezetéknév </label>
            <input type="text" class="form-control" id="veznev" name="veznev" required value="" placeholder="vezetékneve" autofocus><br>
          </div>
             
          <div class="col">
            <label class="form-label fw-bold" for="keresztnev">Keresztnév </label>
            <input type="text" class="form-control" id="keresztnev" name="keresztnev" required value="" placeholder="keresztneve"><br>
          </div>
        </div>

          <div class="row g-3">
                <div class="col">
                    <label class="form-label fw-bold" for="user"><i class="bi bi-person" style="color:#498ffc"></i> Felhasználónév </label>
                    <input type="text" class="form-control" id="user" name="user" required value="" placeholder="felhasználóneve"><br>
                </div>

                <div class="col">
                    <label class="form-label fw-bold" for="mail"><i class="bi bi-envelope-paper-heart" style="color:#498ffc"></i> Email cím </label>
                    <input type="text" class="form-control" id="mail" name="mail" required value="" placeholder="email címe"><br>
                </div>
          </div>
          <div class="row g-3">
              <div class="col" id="res1">  
              </div>
              <div class="col" id="res2"> 
              </div>
          </div>
          <div class="row g-3">
            <div class="col">
                  <label class="form-label fw-bold" for="phone"><i class="bi bi-telephone" style="color:#498ffc"></i> Telefonszám</label>
                  <input type="text" class="form-control" id="phone" name="phone" required value="" placeholder="telefonszáma"><br>
              </div>
              <div class="col" id=""> 
              </div>
          </div>

          <div class="separator">
           <b>LAKCÍM</b>
          </div>
          <div class="row g-3">
                <div class="col col-4">
                    <label class="form-label fw-bold" for="megye"> Megye </label>
                    <input type="text" class="form-control" id="megye" name="megye" required value="" placeholder="lakcím szerinti megye"><br>
                </div>

                <div class="col col-2">
                    <label class="form-label fw-bold" for="iranyitoszam">Irányítószám </label>
                    <input type="number" class="form-control" id="iranyitoszam" name="iranyitoszam" required value="" placeholder=""><br>
                </div>
                <div class="col col-6">
                    <label class="form-label fw-bold" for="telepules">Település </label>
                    <input type="text" class="form-control" id="telepules" name="telepules" required value="" placeholder="lakcím szerinti település"><br>
                </div>      
          </div>

          <div class="row g-3">
                <div class="col">
                    <label class="form-label fw-bold" for="utca"> Utca </label>
                    <input type="text" class="form-control" id="utca" name="utca" required value="" placeholder="utca megnevezése"><br>
                </div>

                <div class="col col-3">
                    <label class="form-label fw-bold" for="hazszam"> Házszám </label>
                    <input type="number" class="form-control" id="hazszam" name="hazszam" required value="" placeholder=""><br>
                </div>
          </div>
          <div class="separator">
           <b>JELSZÓ</b>
          </div>
          <div class="row g-3">
              <div class="col">
              <label class="form-label fw-bold" for="pass"><i class="bi bi-person-lock" style="color:#498ffc"></i> Jelszó  </label>
                  <div class="input-group" id="show_hide_password">
                      <input type="password" class="form-control" id="pswd" name="pass" required value="" placeholder="jelszava" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="A jelszónak tartalmaznia kell legalább egy számot, egy nagybetűt, egy kisbetűt és minimum 8 karakter hosszúnak kell lennie!" aria-describedby="passHelp">
                      <span class="input-group-text"><a href=""><i class="bi bi-eye"></i></a></span> 
                  
                </div>
              </div>
                <div id="passHelp" class="form-text">A jelszónak tartalmaznia kell legalább egy számot, egy nagybetűt, egy kisbetűt és minimum 8 karakter hosszúnak kell lennie!</div>
              </div> 
            <div class="col" id="pass1">
            <div id="message">
              <h5>Jelszó segítség:</h5>
              <p id="letter" class="invalid">Egy <b>kisbetű</b></p>
              <p id="capital" class="invalid">Egy <b>nagybetű</b> </p>
              <p id="number" class="invalid">Egy <b>szám</b></p>
              <p id="length" class="invalid">Minimum <b>8 karakter</b></p>
            </div>
            </div>


          <div class="row g-3">
            <input type="password" class="form-control" id="password2" name="pass2" required value="" placeholder="jelszó megerősítése">
            <div class="col" id="pass2"> 
            </div>
          </div>

           <div class="row g-3 align-items-center" style="margin-top: 0.1%;" >
            <button class="btn btn-primary" type="submit" name="submit" id="submit"><i class="bi bi-person-add"></i>  Regisztrálok</button>
          </div>    
    </form>     
  </div>
      <!-- Modal footer -->
        <div class="modal-footer">
          <a href="#" id="register3"><p><i class="bi bi-box-arrow-in-right"></i>  Már regisztált? Lépjen be fiókjába!</p></a>
        </div>
      </div>
    </div>
  </div>
<!-- felhasználónév ellenőrzés -->
<script>
$(document).ready(function(){
    $('#user').focusout(function(){
        var username = $('#user').val();
        $('#res1').html('');
        if (username.length >=3)
         {
        $.ajax({
            url: "regusercheck.php",
            method: "post",
            data: {user: username},
            dataType: "text",
            success: function(data){
                $('#res1').html("");
                if (data != 0){
                    $('#user').focus();
                    $('#user').val('');
                    $('#res1').html(username + data);
                } 
            },
            error : function(err){
                alert(Error);
            }
            
        });
     }
    });

});

// email ellenőrzés
function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}
$(document).ready(function(){
    $('#mail').focusout(function(){
        var email = $('#mail').val();
        $('#res2').html('');
        if(email.length >=3 && IsEmail(email)== false){
          $('#res2').html("<p style='color:red;'> Kérem, hogy email címet adjon meg!pl. info@valami.hu</p>");
          $('#mail').focus();
        }
        if(email.length >=3 && IsEmail(email)== true){
        $('#res2').html('');   
        $.ajax({
            url: "regemailcheck.php",
            method: "post",
            data: {mail: email},
            dataType: "text",
            success: function(data){   
                if (data !=0){
                    $('#mail').focus();
                    $('#mail').val('');
                    $('#res2').html(email + data);
                }
            },
            error : function(err){
                alert(Error);
            }
            
        });
      }
    });

});
// jelszó ellenőrzés
var myInput = document.getElementById("pswd");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
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

</script>