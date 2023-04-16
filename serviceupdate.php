<?php
require 'header.php';

if (isset($_GET["id"])){
    $ID = $_GET["id"];
    
    try{

        $sql4 = "SELECT * FROM lodinn.arak INNER JOIN lodinn.arai ON arak.kategoriaID = arai.kategoria_ID WHERE kategoriaID=?";
        $result4 = $conn->prepare($sql4);
        $result4->bindParam(1, $ID, PDO::PARAM_INT);
        $result4->execute();
        if($result4 ->rowCount() !=0){
            while($row = $result4->fetch(PDO::FETCH_ASSOC)){
                $db_szolgID = $row['kategoriaID'];
                $db_szolg = $row['kategoriaNev'];
                $db_ar = $row['ar'];
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
<section id="sectionprofile" style="margin-top: 10%;">
<div class="container text-justify p-3" >
    <div class="text-center">    
        <h1 id="titleprofile"><i class="bi bi-tag"></i> <?php if(isset($db_szolg)){echo $db_szolg;};?> szolgáltatás adatainak szerkesztése </a></h1>
    </div>
</div>
<div class="card" style="width: 100%; padding:1%">
<div class="card-header">
    Szerkesztés
  </div>
<div class="card-body">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="service_update">
        <input type="hidden" value="<?php if(isset($ID)){echo $ID;};?>" name="serviceID" id="serviceID">
        <div class="row">
            <div class="col-md-6 mb -3">
                <label for="">Szolgáltatás neve</label>
                <input type="text" name="servicename" id="servicename" class="form-control" value="<?php if(isset($db_szolg)){echo $db_szolg;};?>">
            </div>
            <div class="col-md-6 mb -3">
                <label for="">Szolgáltatás ára</label>
                <input type="text" name="serviceprice" id="serviceprice" class="form-control" value="<?php if(isset($db_ar)){echo $db_ar;};?>">
            </div>
            <div class="col-md-6 mb -3">
                <button type="submit" class="btn btn-primary" name="submit" style="margin-top: 4%;margin-bottom: 2%;"><i class="bi bi-save"></i> Módosít</button>
            </div>
            <div class="col-md-6 mb -3">
            <a href='adminloggedin.php#arak' type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Vissza' style="margin-top: 4%;margin-bottom: 2%;"><i class="bi bi-arrow-left-circle"></i>  Vissza </a>
            </div>
            
        </div>

    </form>
    <div class="" id="back" style="margin-top: 0%;margin-bottom: 2%;"> </div>  
</div>
</section>
<script>
//update
$(document).ready(function(){
$('#service_update').submit(function(e){
        e.preventDefault();
        var id = $('#serviceID').val();
        var servicename = $('#servicename').val();
        var serviceprice = $('#serviceprice').val();
       if(id !== null){
            $.ajax({
                method:"post",   
                data:{
                  i: id,
                  name: servicename,
                  price: serviceprice,
                },

                dataType: "text",
                success: function(data){
                  $('#back').html("<i class='bi bi-check' style='color:green;'></i> <h5 style='color:green;'>Módosítás mentve!");
                    setTimeout("window.location.href='adminloggedin.php';",800);
                    },
                  error : function(err){
                      alert(Error);
                  },

                })
            }
          })});
</script>
<?php
if (isset($_POST["name"])){
    try{
    $ID = trim($_POST["i"]);
    $name = trim($_POST["name"]);
    $price = trim($_POST["price"]);

    // SELECT * FROM lodinn.arak INNER JOIN lodinn.ar ON arak.kategoriaID = ar.kategoriaAr_ID INNER JOIN lodinn.arai ON arak.kategoriaID = arai.kategoria_ID WHERE kategoria_ID=?

    $sql = "UPDATE lodinn.arak SET kategoriaNev = ? WHERE kategoriaID = ?";
    
    $queryUpdate = $conn->prepare($sql);
    $queryUpdate->bindParam(1, $name, PDO::PARAM_STR);
    $queryUpdate->bindParam(2, $ID, PDO::PARAM_INT);
    $queryUpdate->execute();

    $sql2 = "UPDATE lodinn.arai SET ar = ? WHERE kategoria_ID = ?";
    
    $queryUpdate2 = $conn->prepare($sql2);
    $queryUpdate2->bindParam(1, $price, PDO::PARAM_INT);
    $queryUpdate2->bindParam(2, $ID, PDO::PARAM_INT);
    $queryUpdate2->execute();

    }   catch (PDOException $e){
            echo "Adatbázis hiba: " .$e->getMessage();    
        } catch (Exception $e){
            echo "Egyéb hiba: " .$e->getMessage();
        die();
        }
} 
?>
<script src="./jQuery/jquery-3.6.4.min.js"></script>           
<?php 
require 'footer.php';
?>