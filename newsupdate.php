<?php
require 'header.php';

if (isset($_GET["id"])){
    $ID = $_GET["id"];
    
    try{

        $sql = "SELECT * FROM lodinn.hirek WHERE hirek.hirID LIKE :id";
            $result = $conn->prepare($sql);
            $result -> bindParam(':id',$ID, PDO::PARAM_STR);
            $result->execute();
            
            if($result ->rowCount() !=0){
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $db_cim = $row['cim'];
                    $db_leiras = $row['leiras'];
                    $db_datum = $row['datum'];
                }}

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
        <h1 id="titleprofile"><i class="bi bi-newspaper"></i> <?php if(isset($db_cim)){echo $db_cim;};?> hír szerkesztése </a></h1>
    </div>
</div>
<div class="card" style="width: 100%; padding:1%">
<div class="card-header">
    Szerkesztés
  </div>
<div class="card-body">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="news_update">
        <input type="hidden" value="<?php if(isset($ID)){echo $ID;};?>" name="newsID" id="newsID">
        <div class="row">
            <div class="col-md-6 mb -3">
                <label for="">Cím</label>
                <input type="text" name="newstitle" id="newstitle" class="form-control" value="<?php if(isset($db_cim)){echo $db_cim;};?>">
            </div>
            <div class="col-md-12 mb -3">
                <label for="">Leírás</label>
                <textarea rows="4" name="newsdesc" id="newsdesc" class="form-control" ><?php if(isset($db_leiras)){echo $db_leiras;};?></textarea>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary" name="submit" style="margin-top: 18%;margin-bottom: 2%;"><i class="bi bi-save"></i> Módosít</button>
            </div>
            <div class="col-md-1">
            <a href='adminloggedin.php#hirek' type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Vissza' style="margin-top: 18%;margin-bottom: 2%;"><i class="bi bi-arrow-left-circle"></i>  Vissza </a>
            </div>
            
        </div>

    </form>
    <div class="" id="back" style="margin-top: 0%;margin-bottom: 2%;"> </div>  
</div>
</section>
<script>
//update
$(document).ready(function(){
$('#news_update').submit(function(e){
        e.preventDefault();
        var id = $('#newsID').val();
        var newstitle = $('#newstitle').val();
        var newsdesc = $('#newsdesc').val();
       if(id !== null){
            $.ajax({
                method:"post",   
                data:{
                  i: id,
                  title: newstitle,
                  desc: newsdesc,
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
if (isset($_POST["i"])){
    try{
    $Id = trim($_POST["i"]);
    $title = trim($_POST["title"]);
    $desc = trim($_POST["desc"]);



    $sql = "UPDATE lodinn.hirek SET cim = ?, leiras = ? WHERE hirID = ?";
    
    $queryUpdate = $conn->prepare($sql);
    $queryUpdate->bindParam(1, $title, PDO::PARAM_STR);
    $queryUpdate->bindParam(2, $desc, PDO::PARAM_STR);
    $queryUpdate->bindParam(3, $Id, PDO::PARAM_INT);
    $queryUpdate->execute();


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