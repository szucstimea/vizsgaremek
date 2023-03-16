<?php
include 'usernamesearch.php';
include 'registmodal.php';
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
                <label class="form-label fw-bold" for="username">Felhasználónév </label>
                    <input type="text" class="form-control" id="username" name="username" required value="" placeholder="Kérem adja meg felhasználónevét"><br>
                <div id="result">
                </div>
            </div>
            <div class="row g-3 align-items-center" style="margin-top: 5%;">
                <label class="form-label fw-bold" for="pass">Jelszó </label>
                    <input type="password" class="form-control" id="password" name="pass" required value="" placeholder="Kérem adja meg jelszavát"><br><br>
                <label>
                    <div id="result2">
                    </div>
                <label class="form-check-label" for="exampleCheck1">Megjegyez</label>
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
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
    $('#submit').click(function(e){
        e.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();
        $('#result2').html('');
        if (password.length >=0)
         {
        $.ajax({
            url: "login.php",
            method: "post",
            data: {usern: username,
                   pswrd: password
                  },
            dataType: "text",
            success: function(data){
                $('#result2').html("");
                if (data != 0){
                    // $('#result2').html(data); 
                    // $('#myModal').modal('toggle');
                    location.reload();
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

</script>