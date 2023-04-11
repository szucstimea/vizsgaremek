<?php
require 'header.php';
require 'cookieModal.php';
?>
<script src="./jQuery/jquery-3.6.4.min.js"></script>
<section id="sectionprofile">

<div class="container text-justify p-3" >
    <div class="text-center">    
        <h3 id="titleprofile"><i class="bi bi-person-vcard"></i> BEJELENTKEZÉS DOLGOZÓKÉNT </a></h3>
    </div>
</div>
<div class="container p-3" >
    <div class="text-center">
        <form class="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method ="post" autocomplete="off">
        <div class="form-group-row">
                    <label class="form-label fw-bold" for="felh"><i class="bi bi-person" style="color:#498ffc"></i> Felhasználónév </label>
                        <input type="text" class="form-control" id="felh" name="felh" required value="<?php if(isset($_COOKIE ['veznev'])){echo $_COOKIE ['veznev'];};?>" placeholder="Kérem adja meg felhasználónevét" autofocus><br>
                    <div id="result">
                </div>
            </div>
            <div class="form-group" style="margin-top: 5%;">
                <label class="form-label fw-bold" for="pass"><i class="bi bi-person-lock" style="color:#498ffc"></i> Jelszó </label>

                <div class="input-group" id="show_hide_password">
                    <input type="password" class="form-control" id="pas" name="pas" required value="<?php if(isset($_COOKIE ['password'])){echo $_COOKIE ['password'];};?>" placeholder="Kérem adja meg jelszavát"><br><br>    
                    <span class="input-group-text"><a href=""><i class="bi bi-eye"></i></a></span>
                    </div>          
                <label>
                    <div class="input-group" id="res" style="margin-bottom:50px; margin-top:20px;">
                    </div>
                    <?php 
                    $disabled ="";
                    $_COOKIE["cookieSet"] ='';
                        if(isset($_GET["cookie"]) || ($_COOKIE["cookieSet"]) =='no'){
                            $disabled = "disabled='disabled'";
                            echo "<p style='color:red;'> <i class='bi bi-exclamation-circle'></i> A sütik használatának elutasítása esetén a 'Bejeletkezve maradok' funkció nem használható. Amennyiben  használni szeretné a funkciót, kérjük, hogy <a href='index.php?cookiesettings=1'>kattintson ide az oldal újratöltéséhez</a>és fogadja el a sütik használatát.</p>";     
                        }
                    ?>
                    <div class="form-inline" style="margin-top:20px;">  
                        <label class="form-check-label" for="exampleCheck1" >Bejeletkezve maradok</label>
                            <input type="checkbox" class="form-check-input" id="rem" name="rem" <?php echo $disabled; ?>>
                            <input type="text" class="form-check-input" id="textbox1" name="textbox1" style="display:none";>
                        <button type="button" class="btn" id="bovebben" data-toggle="tooltip" data-html="true" data-placement="top" title="Amenyiben a 'Bejelentkezve maradok' opciót választja, 7 napig bejelentkezett státuszban marad ügyfélfiókjába. Az ön biztonsága érdekében 7 nap után automatikusan kijelentkeztetjük, amennyiben időközben nem jeletkezik ki. Kijelentkezés után felhasználóneve és jelszava megadásával ismét be kell jelentkeznie."><i class="bi bi-question-circle"></i></button>
                        
                        </label>
                    </div> 
                    <div class="form-group row" style="margin-bottom:50px; margin-top:20px;">
                        <button class="btn btn-primary" type="submit" name="subm" id="subm"><i class="bi bi-box-arrow-in-right"></i>  Bejelentkezés</button>
                    </div>
                </div> 
            </div>      
        </form>     
      </div>
    </div>
  </div>

</section>
<script>
$(document).ready(function(){
    $('#subm').click(function(e){
        e.preventDefault();
        var felh = $('#felh').val();
        var password = $('#pas').val();
        var remember = $('#rem').val();
        
        $('#res').html('');
        $.ajax({
            url: "loginadmin.php",
            method: "post",
            data: {fel: felh,
                   pswrd: password,
                   rem: remember,
                  },
            dataType: "text",
            success: function(data){
                $('#res').append(data);
                if (data == ""){
                    $(location).attr('href', 'adminloggedin.php');
                }else {
                    $('#pas').focus();
                    $('#pas').val('');
                }
            },
            error : function(err){
                alert(Error);
            }
            
        });
     
    })
});
</script>

<?php 
require 'footer.php';
?>