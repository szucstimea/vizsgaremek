<?php
session_start();
?>
<!DOCTYPE html>
<html lang="hu">
<head class="">
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/dog2.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/dog3fav.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bookingform.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="./jQuery/jquery-3.6.4.min.js"></script>
    <title>LodInn kutyapanzió dolgozói felület</title>
</head>


<nav class="nav navbar navbar-dark fixed-top" style="background-color: #498ffc;">

<a class="navbar" href="index.php" id="cim">
    <img src="assets/images/dog3.png" alt="Logo" class="" id="logo">
    <h2>LODINN KUTYAPANZIÓ</h2><br>
    </a>
  <div class="container">
  <div id="cim" class="fw-light" style="margin-left: 28%;"><h5></h5></div>
    
    
    <ul class=" navbar-nav flex-row">
            <!-- felhaszáló létezésének ellenőrzése adatbázisban arra az esetre ha sütiben tárolja az adatait, de közbe törlése kerülne az adatbázisból -->
            <?php
            $username = "";
            if(isset($_COOKIE ['usernameadmin'])){
                $usernamequery = $_COOKIE["usernameadmin"];
                try {
                    $sql = "SELECT felhID,felhNev,jelszo FROM lodinn.felhasznalok WHERE felhNev=:felhNev";
                    $queryLogin = $conn->prepare($sql);
                    $queryLogin->bindParam(":felhNev",$usernamequery,PDO::PARAM_STR);
                    $queryLogin->execute();
                    if ($queryLogin->rowCount() != 1){
                        echo "<script> window.location.href ='logout.php'</script>";     
                    }
                    }catch (PDOException $e){
                        echo "Adatbázis hiba: " .$e->getMessage();    
                    } catch (Exception $e){
                        echo "Egyéb hiba: " .$e->getMessage();
                        die();
                    } 
                    $usernamequery = "";
                };

            
            if(isset($_SESSION["usernameadmin"]))
            {
                $username = $_SESSION["usernameadmin"];
            }

            if(isset($_COOKIE ['usernameadmin']))
            {
                $username = $_COOKIE ['usernameadmin'];
            }
        
            if($username !=""){
                echo '<h5 id="welcome">Üdvözlünk '.$username.'!</h5>';
                
            ?>
            <li class="nav-item-icons">
                <a class="nav-link pr-2"><i class="bi bi-person"></i></a></li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id=""role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                    <ul class="dropdown-menu position-absolute dropdown-menu-right ">
                        <li><a class="dropdown-item" href="adminloggedin.php#adatok" id=""><i class="bi bi-person"></i> Panzió adatai</a></li>
                        <li><a class="dropdown-item" href="adminloggedin.php#arak" id=""><i class="bi bi-tag"></i> Árak</a></li>
                        <li><a class="dropdown-item" href="adminloggedin.php#foglal" id=""><i class="bi bi-heart"></i> Foglalások</a></li>
                        <li><a class="dropdown-item" href="adminloggedin.php#hirek" id=""><i class="bi bi-newspaper"></i> Hírek</a></li>
                        <li><a class="dropdown-item" href="logout.php" id=""><i class="bi bi-box-arrow-left"></i> Kijelentkezés</a></li>
                    </ul>
            </li>
            <?php 
            }
                else {
            ?>
           
            <li class="nav-item-icons">
                <a class="nav-link pr-2"><i class="bi bi-person"></i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id=""role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                    <ul class="dropdown-menu position-absolute dropdown-menu-right">
                        <li><a class="dropdown-item" href="#" id="login"><i class="bi bi-box-arrow-in-right"></i> Bejelentkezés</a></li>
                        <li><a class="dropdown-item" href="#" id="register"><i class="bi bi-person-add"></i> Regisztráció</a></li>
                        <li><a class="dropdown-item" href="admin.php" id="admin"><i class="bi bi-person-vcard"></i> Bejelentkezés dolgozóként</a></li>
                    </ul>
            </li>
            <?php
                }
            ?>
            <li class="nav-item-icons">
                <a class="nav-link pr-2" href="tel:+36301234567"><i class="bi bi-telephone"></i></a>
            </li>
           
            <li class="nav-item-icons">
                <a class="nav-link pr-2" href="https://www.facebook.com/profile.php?id=100091656457423" target="_blank"><i class="bi bi-facebook"></i></a>
            </li>
            
            <li class="nav-item-icons">
                <a class="nav-link pr-2" href="https://www.instagram.com/lodinnkutyapanzio/" target="_blank"><i class="bi bi-instagram"></i></a>
            </li>
            <li class="nav-item-icons">
                <a class="nav-link pr-2"  href="mailto:lodinn@lodinn.hu"><i class="bi bi-envelope"></i></a>
            </li>
            <li class="nav-item-icons">
                 <a class="nav-link pr-2" id ="search" onclick="openSearch()"><i class="bi bi-search"></i></a>
            </li>
           
                <div id="myOverlay" class="overlay">
                    <span class="closebtn" onclick="closeSearch()" title="Close Overlay">x</span>
                    <div class="overlay-content">
                    
                        <form method="" id="" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <input type="text" placeholder="Keresés.." name="keresmezo" id="keresmezo">
                             <button id="keres" type="button" name="keres"><i class="bi bi-search"></i></button> 
                               
                        </form>  
                        
                    </div>
                    <div class='overlay-content'id='ered' style="margin-top:65px; "></div> 
                </div>
                
        </ul>
        
  </div>
 
</nav>
<script> 
$('#login').click(function(){
    $('#myModal').modal('show');
})
$('#login2').click(function(){
    $('#offcanvasNavbar').toggle('slow');
    $('#myModal').modal('show');
})
$('#register').click(function(){
    $('#registmodal').modal('show');
})
$('#register2').click(function(){
    $('#myModal').modal('toggle');
    $('#registmodal').modal('show');
})
$('#register3').click(function(){
    $('#registmodal').modal('toggle');
    $('#myModal').modal('show');
})
$('.modal').on('shown.bs.modal', function() {
  $(this).find('[autofocus]').focus();
});

// Open the full screen search box
function openSearch() {
  document.getElementById("myOverlay").style.display = "block";
}

// Close the full screen search box
function closeSearch() {
  document.getElementById("myOverlay").style.display = "none";
}
//Searching
$(document).ready(function(){
$('#keres').click(function(){
    var search = $('#keresmezo').val();
        $.ajax({
            type:"POST",
            url:"search.php",
            data: {
                sea: search
            },
            success: function(data){
                if (data !=0){
                    $('#ered').html(data);
                    $('#keresmezo').focus();
                }
            } 
        })
        
    })
})
var input = document.getElementById("keresmezo");
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
    document.getElementById("keres").click();
  }
});

</script>
<?php
   
    if(isset($_GET["modal"])){ ?>
        <script>
                 $(function(){                   
                     $('#myModal').modal('show');
                 });
        </script>
<?php         
    }
?>