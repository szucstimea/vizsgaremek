
<!DOCTYPE html>
<html lang="hu">
<head class="">
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bookingform.css">
    <link rel="stylesheet" href="confirmbooking.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="./jQuery/jquery-3.6.4.min.js"></script>
    <title>LodInn kutyapanzió</title>
</head>

<?php
require 'loginmodal.php';
require 'registmodal.php';
include 'inndata.php';

?>

<nav class="nav navbar navbar-dark fixed-top" style="background-color: #498ffc;">
<div id="alcim" class="fw-light" >kutyusa második otthona</div>
  <div class="container-fluid">
    <a class="navbar" href="index.php" id="cim">
    <img src="<?php echo $kepek["logo"]?>" alt="Logo" class="" id="logo">
    <h2>LODINN KUTYAPANZIÓ</h2><br>
    </a>
    
    
    <ul class=" navbar-nav flex-row">
            <!-- felhaszáló létezésének ellenőrzése adatbázisban arra az esetre ha sütiben tárolja az adatait, de közbe törlése kerülne az adatbázisból -->
            <?php
            $username = "";
            if(isset($_COOKIE ['username'])){
                $usernamequery = $_COOKIE["username"];
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

            
            if(isset($_SESSION["username"]))
            {
                $username = $_SESSION["username"];
            }

            if(isset($_COOKIE ['username']))
            {
                $username = $_COOKIE ['username'];
            }
        
            if($username !=""){
                echo '<h5 id="welcome">Üdvözlünk '.$username.'!</h5>';
                
            ?>
            <li class="nav-item-icons" >
                <a class="nav-link pr-2"><i class="bi bi-person"></i></a></li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id=""role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                    <ul class="dropdown-menu position-absolute dropdown-menu-right ">
                        <li><a class="dropdown-item" href="profile.php" id="login"><i class="bi bi-person"></i> Profilom</a></li>
                        <li><a class="dropdown-item" href="mybookings.php" id="register"><i class="bi bi-calendar-check"></i> Foglalásaim</a></li>
                        <li><a class="dropdown-item" href="mydogs.php" id="register"><i class="bi bi-heart"></i> Kutyáim</a></li>
                        <li><a class="dropdown-item" href="logout.php" id="register"><i class="bi bi-box-arrow-left"></i> Kijelentkezés</a></li>
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
                <a class="nav-link dropdown-toggle " id=""role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                    <ul class="dropdown-menu position-absolute dropdown-menu-right fade-up">
                        <li><a class="dropdown-item" href="#" id="login"><i class="bi bi-box-arrow-in-right"></i> Bejelentkezés</a></li>
                        <li><a class="dropdown-item" href="#" id="register"><i class="bi bi-person-add"></i> Regisztráció</a></li>
                        <li><a class="dropdown-item" href="admin.php" id="admin"><i class="bi bi-person-vcard"></i> Dolgozói felület</a></li>
                    </ul>
            </li>
            <?php
                }
            ?>
            <li class="nav-item-icons">
                <a class="nav-link pr-2" href="tel:+36301234567"><i class="bi bi-telephone"></i></a>
            </li>
           
            <li class="nav-item-icons">
                <a class="nav-link pr-2" href="<?php echo $linkek["facebook"]?>" target="_blank"><i class="bi bi-facebook"></i></a>
            </li>
            
            <li class="nav-item-icons">
                <a class="nav-link pr-2" href="<?php echo $linkek["instagram"]?>" target="_blank"><i class="bi bi-instagram"></i></a>
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
        
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end nav-background" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header" style="margin-top: 5%;">
            <img src="<?php echo $kepek["logo"]?>" alt="Logo" id="logo2"><br>
            <h5 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel"> LODINN KUTYAPANZIÓ</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-relative text-center" >
            <ul class="navbar-nav">
                <li class="nav-item" id="lenyilo_menu">
                    <a class="nav-link active text-dark hover-effect" aria-current="page" href="index.php" ><i class="bi bi-house-heart" ></i> Kezdőlap</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark hover-effect" href="index.php#aboutus"><i class="bi bi-justify"></i> Rólunk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark hover-effect" href="index.php#booking"><i class="bi bi-calendar2-check"></i> Foglalás</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark hover-effect" href="index.php#prices"><i class="bi bi-credit-card"></i> Áraink</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark hover-effect" href="index.php#news"><i class="bi bi-newspaper"></i> Hírek</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark hover-effect" href="index.php#customers"><i class="bi bi-star"></i> Vélemények</a>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark hover-effect" href="index.php#footer"><i class="bi bi-envelope-paper"></i> Kapcsolat</a>
                </li>
                <li class="nav-item">
                    <img src="<?php echo $kepek["dog-pow"]?>" style="width:90%;  transform: rotate(20deg); margin-top:15%;" id="mancs">
                </li>
            </ul>
            <div class="socialoffcanvas">
                <a class="" href="?modal=1" id="login2"><i class="bi bi-person"></i></a>
                <a class="" href="tel:+36301234567"><i class="bi bi-telephone"></i></a>
                <a class=""><i class="bi bi-facebook"></i></a>
                <a class=""><i class="bi bi-messenger"></i></a>
                <a class=""><i class="bi bi-instagram"></i></a>
                <a class=""  href="mailto:lodinn@lodinn.hu"><i class="bi bi-envelope"></i></a>
            </div>
        </div>
    </div>
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