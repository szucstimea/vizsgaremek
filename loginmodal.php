<?php
include 'usernamesearch.php';
include 'login.php';

?>
<script src="./jQuery/jquery-3.6.4.min.js"></script>
<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="bi bi-box-arrow-in-right"></i>   BEJELENTKEZÉS</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form class="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post" autocomplete="off">
            <div class="row g-3 align-items-center">
                <label class="form-label fw-bold" for="username"><i class="bi bi-person" style="color:#498ffc"></i> Felhasználónév </label>
                    <input type="text" class="form-control" id="username" name="username" required value="<?php if(isset($_COOKIE ['username'])){echo $_COOKIE ['username'];};?>" placeholder="Kérem adja meg felhasználónevét" autofocus><br>
                <div id="result">
                </div>
            </div>
            <div class="row g-3 align-items-center" style="margin-top: 5%;">
                <label class="form-label fw-bold" for="pass"><i class="bi bi-person-lock" style="color:#498ffc"></i> Jelszó </label>

                <div class="input-group" id="show_hide_password">
                    <input type="password" class="form-control" id="password" name="password" required value="<?php if(isset($_COOKIE ['password'])){echo $_COOKIE ['password'];};?>" placeholder="Kérem adja meg jelszavát"><br><br>    
                <span class="input-group-text"><a href=""><i class="bi bi-eye"></i></a></span>
                </div>          
                <label>
                    <div id="result2">
                    </div>
                <label class="form-check-label" for="exampleCheck1" >Bejeletkezve maradok</label>
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <input type="text" class="form-check-input" id="textbox1" name="textbox1" style="display:none";>
                    <button type="button" class="btn" id="bovebben" data-toggle="tooltip" data-html="true" data-placement="top" title="Amenyiben a 'Bejelentkezve maradok' opciót választja, 30 napig bejelentkezett státuszban marad ügyfélfiókjába. Az ön biztonsága érdekében 30 nap után automatikusan kijelentkeztetjük, amennyiben időközben nem jeletkezik ki. Kijelentkezés után felhasználóneve és jelszava megadásával ismét be kell jelentkeznie."><i class="bi bi-question-circle"></i></button>
                    
                </label>
                <button class="btn btn-primary" type="submit" name="submit" id="submit"><i class="bi bi-box-arrow-in-right"></i>  Bejelentkezés</button>
            </div>      
        </form>     
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <a href="#" id="register2"><p><i class="bi bi-person-add" style="color: cornflowerblue;"></i>Még nem regisztált? Hozza létra fiókját itt.</p></a>
      </div>
    </div>
  </div>
</div>



<?php
//$usern = new CheckUsername();
//$usern->check($username);
?> 
<!-- felhasználónév ellenőrzés -->
<script>
$(document).ready(function(){
    $('#username').focusout(function(){
        var username = $('#username').val();
        $('#result').html('');
        if (username.length >=3)
         {
        $.ajax({
            url: "usernamesearch.php",
            method: "post",
            data: {search: username},
            dataType: "text",
            success: function(data){
                $('#result').html("");
                if (data != 0){
                    $('#username').focus();
                    $('#username').val('');
                    $('#result').html(username + data);
                } else {
                    $('#result').html("<i class='bi bi-check' style='color:green;'></i>"+ username +", üdvözlünk újra!");
                }
    
            },
            error : function(err){
                alert(Error);
            }
            
        });
     }
    });

});
// felhasználónév és jelszó ellenőrzés 
$(document).ready(function(){

    $('#remember').click(function() {
        if ($("#remember").is(":checked") == true) {
            $('#textbox1').val('yes');
        } else {
            $('#textbox1').val('no');
            }
        });

    $('#submit').click(function(e){
        e.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();
        var remember = $('#textbox1').val();
        
        $('#result2').html('');
        if (password.length >=0)
         {
        $.ajax({
            url: "login.php",
            method: "post",
            data: {usern: username,
                   pswrd: password,
                   rem: remember,
                  },
            dataType: "text",
            success: function(data){
                $('#result2').html("");
                if (data != 0){
                    $(location).attr('href', 'index.php');
                }else {
                    $('#password').focus();
                    $('#password').val('');
                    $('#result2').html("<p style='color:red;'><i class='bi bi-exclamation-circle-fill'></i> Nem megfelelő felhasználónév vagy jelszó! Kérem próbálja meg újra!</p>");
                }
            },
            error : function(err){
                alert(Error);
            }
            
        });
     }
    });

});
// jelszó mutatása, elrejtése 
$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "bi-eye" );
            $('#show_hide_password i').removeClass( "bi-eye-slash" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "bi-eye" );
            $('#show_hide_password i').addClass( "bi-eye-slash" );
        }
    });
});


$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="tooltip"]').on('shown.bs.tooltip', function () {
        $('.tooltip').addClass('animated');
    })
})
</script>