<?php
require 'header.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<div id="mybookings">

    <div class="container text-justify p-3 leiras">
        <div class="text-center">    
            <h1><i class="bi bi-calendar-heart-fill"></i> Foglalásaim </a></h1>
            <p> A "Foglalásaim" menüpont lehetővé teszi <br> a felhasználók számára, hogy <br> megtekintsék a rendszerünkben szereplő aktív foglalásaikat.</p><br>
        </div>
    </div>

    <!-- foglalások kiolvasása -->
    <div class="text-center" id="foglalasok">  
    <table class="table table-striped" style="width: 100%;">
        <thead>
                <tr style="background-color: #498ffc; color: white;">
                    <th scope="col">KUTYA NEVE</th>
                    <th scope="col">FOGLALÁS KEZDŐ NAPJA</th>
                    <th scope="col">FOGLALÁS UTOLSÓ NAPJA</th>
                    <th scope="col">SZÁLLÍTÁS</th>
                    <th scope="col">SPECIÁLIS IGÉNY</th>
                    <th scope="col">SZOLGÁLTATÁSOK</th>
                    <th scope="col">VÉGÖSSZEG</th>
                </tr>
        </thead>
        <tbody>            
        </tbody>
    </table>
    </div>
</div>

<script>

<?php   if((isset($_SESSION["login"]) && $_SESSION["login"]==true)){$uname=$_SESSION['username'];?>
    uname = "<?php echo $uname ?>";
<?php }elseif((isset($_COOKIE["loggedin"]) && ($_COOKIE["loggedin"]=='1'))){$uname=$_COOKIE['username'];?>
    uname = "<?php echo $uname ?>";   
<?php }?>

    $.ajax({
            url:"bookingdata.php",
            method:"post",   
            data:{ uname : uname
            },
            contentType: "application/x-www-form-urlencoded",
            success: function(response){
                var foglalasok = JSON.parse(response);
                if(foglalasok.length>0){
                    for(var i = 0 ; i < foglalasok.length ; i++){
                        if(foglalasok[i]["szallitas"]==1){
                            szallitast = "kérek";
                        }else{
                            szallitast = "nem kérek"
                        }
                        var sor = "<tr><td>"+foglalasok[i]["kutyaNev"]+"</td><td>"+foglalasok[i]["kezdoDatum"]+"</td><td>"+foglalasok[i]["vegDatum"]+"</td><td>"+szallitast+"</td><td>"+foglalasok[i]["specialisIgenyek"]+"</td><td>"+foglalasok[i]["szolgaltatasok"]+"</td><td>"+foglalasok[i]["vegosszeg"]+"</td></tr>";
                        $('tbody').append(sor);
                    };
                }else{
                    var elem = "<p>Még nincs foglalás.</p>";
                    $('#foglalasok').append(elem);
                }                                                          
            },
            error : function(err){
                alert(err);
            }
        });
</script> 

<?php 
require 'footer.php';
?>