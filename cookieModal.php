
<script src="./jQuery/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>

<!-- Modal -->
<?php
if(isset($_GET["cookie"]) || isset($_COOKIE["cookieSet"])){
    ?>
    <style type="text/css">#cookieModal{
    display:none;
    }</style>
<?php
}

?>

<div class="cookie-consent animated animatedFadeInUp fadeInUp" id="cookieModal">
   <div class="row">
      <div class="col d-sm-none d-md-block d-none d-sm-block text-center">
          <img src="assets/images/bone.png" width="60%" height="60%" style="padding-top: 5%;" id="cookieimage" class="">
       </div>
    <div class="col-xl-10 col-lg-10 col-md-10 col-12 col-sm-12 col-xs-12">
       <p class="text-muted h6">🍪 Az oldalunk sütiket használ a lehető legjobb felhasználói élmény érdekében. A sütik segítenek nekünk megjegyezni a beállításaidat, javítani a teljesítményünket és személyre szabni az ajánlatainkat.
        <a href="cookiepolicy.php">Sütikezelési szabályzatunkban</a> tájékozódhatsz arról, hogy milyen sütiket használunk, vagy a <a>beállításokban</a> személyre is szabhatod a használatukat.</p>
    </div>
    </div>
    <div class="row">
      <div class="col">    
        <button type="button" class="btn btn-primary me-2" data-bs-dismiss="modal" id="accept"><i class="bi bi-plus-circle"></i> Elfogadom</button>
          </div>
            <div class="col">
              <button type="button" class="btn btn-secondary" id="dismiss"><i class="bi bi-dash-circle"></i> Elutasítom</button>
            </div>
            <div class="col">
            <button type="button" class="btn btn-dark" id="settings"><i class="bi bi-gear" ></i> Beállítások</button>
            </div>
    </div>
</div>

<?php
if(isset($_GET["cookiesettings"])){
    ?>
    <script>
        $(document).ready(function() {
        $('#cookieSettings').show();
        });
    </script>
<?php
}
?>
<div class="cookie-consent animated animatedFadeInUp fadeInUp" id="cookieSettings">
   <div class="row">
    <div class="col">
       <p class="text-muted h6">🍪 SÜTI BEÁLLÍTÁSOK</p>
       <button type="button" class="btn-close btn-close" id="close" style="position:absolute; right:5%;"></button>
    </div>
    </div>
    <div class="row">
      <div class="col"> 
        <h5>Preferencia alapú sütik</h5> 
        <p><b>Süti neve: username</b></p>
        <p>Célja: A felhasználónév tárolása. Enélkül nem használható a "Bejelenetkezve" maradok funkció.</p>
        <p><b>Süti neve: password</b></p>
        <p>Célja: A jelszó tárolása. Enélkül nem használható a "Bejelenetkezve" maradok funkció.</p>
        <p><b>Süti neve: loggedin</b></p>
        <p>Célja: A bejelentkezési státusz tárolása. Enélkül nem használható a "Bejelenetkezve" maradok funkció.</p>
        <p><b>Süti neve: cookieSet</b></p>
        <p>Célja: A felhasználói hozzájárulás tárolása. Ezzel tudatjuk a böngészővel, hogy Ön általános hozzájárulást adott-e a sütik használatával kapcsolatban.</p>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
            <label class="form-check-label" for="flexSwitchCheckChecked">Preferencia alapú sütik engedélyezése</label>
        </div>  

          </div>
            <div class="col">
            <h5>Statisztikai sütik</h5>
            <p><b>Süti neve: count</b></p>
            <p>Célja: Látogatói statisztika mérése. A mérés anonim módon történik, nem tárol adatokata látogatóról. Kizárólag statisztikai adatokba látjuk, hogy hányan látogatták meg az odalunkat.</p>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked2" checked>
                <label class="form-check-label" for="flexSwitchCheckChecked2">Statisztikai sütik engedélyezés</label>
            </div>
            <a href="cookiepolicy.php">Sütikezelési szabályzatunk</a>
            </div>
            
            <button type="button" class="btn btn-primary" style="padding-top: 5px;" id="saveCookie"><i class="bi bi-save"></i> Mentés</button> 
    </div>
</div>


<script>
$(document).ready(function() {
    $("#accept").on('click', function() {
        Cookies.set('cookieSet', 'yes', { expires: 365});
        Cookies.set('count',1);
        $('#cookieModal').slideUp();
    });
    $("#dismiss").on('click', function() {
        Cookies.set('cookieSet', 'no', { expires: 1});
        Cookies.remove('username');
        Cookies.remove('password');
        Cookies.remove('loggedin');
        Cookies.remove('count');
        $('#cookieModal').slideUp();
        $(location).attr('href', 'index.php?cookie=0');
    });
    $("#settings").on('click', function() {
        $('#cookieModal').slideUp();
        $('#cookieSettings').show();
    });
    $("#close").on('click', function() {
        $('#cookieSettings').slideUp();
    });
    $("#saveCookie").click(function() {

        if ($("#flexSwitchCheckChecked").is(":checked") == true){

        Cookies.set('cookieSet', 'yes', { expires: 365});

        } else {
            Cookies.set('cookieSet', 'no', { expires: 1});
            $(location).attr('href', 'index.php?cookie=0');
        };

        if ($("#flexSwitchCheckChecked2").is(":checked") == true){
            
            Cookies.set('count',1);

        } else {
            Cookies.remove('count');
        };
    
        $('#cookieSettings').slideUp();
    });

});
</script>