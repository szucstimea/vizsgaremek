<?php
require 'header.php';

if (isset($_GET["id"])){
    $ID = $_GET["id"];
    
    try{
        $sql = "SELECT * FROM lodinn.kutyak WHERE kutyak.kutyaID = ?";
        $update = $conn->prepare($sql);
        $update->bindParam(1, $ID, PDO::PARAM_INT);  
        $update->execute();

        if($update ->rowCount() !=0){
            while($row = $update->fetch(PDO::FETCH_ASSOC)){
                $db_dogname = $row['kutyaNev'];
                $db_dogage = $row['kor'];
                $db_dogspecies = $row['fajta'];
            }
        } 
    }catch (PDOException $e){
        echo "Adatbázis hiba: " .$e->getMessage();    
    } catch (Exception $e){
        echo "Egyéb hiba: " .$e->getMessage();
    die();
    }
}
?>
<section id="sectionprofile">
<div class="container text-justify p-3" >
    <div class="text-center">    
        <h1 id="titleprofile"><i class="bi bi-heart"></i> <?php if(isset($db_dogname)){echo $db_dogname;};?> adatainak szerkesztése </a></h1>
        
    </div>
</div>
<div class="card" style="width: 100%; padding:1%">
<div class="card-header">
    Szerkesztés
  </div>
<div class="card-body">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="form_updatedog">
        <input type="hidden" value="<?php if(isset($ID)){echo $ID;};?>" name="dogID" id="dogID">
        <div class="row">
            <div class="col-md-12 mb -3">
                <label for="">Kutya neve</label>
                <input type="text" name="dogname" id="dogname" class="form-control" value="<?php if(isset($db_dogname)){echo $db_dogname;};?>">
            </div>
            <div class="col-md-12 mb -3">
                <label for="">Kutya kora</label>
                <input type="text" name="dogage" id="dogage" class="form-control" value="<?php if(isset($db_dogage)){echo $db_dogage;};?>">
            </div>
            <div class="col-md-12 mb -3">
                <label for="">Kutya fajtája</label>
                <input type="text" name="dogspecies" id="dogspecies" class="form-control" value="<?php if(isset($db_dogspecies)){echo $db_dogspecies;};?>">
            </div>
            <div class="col-md-12 mb -3">
                <button type="submit" class="btn btn-primary" name="submit" style="margin-top: 4%;margin-bottom: 2%;"><i class="bi bi-save"></i> Módosít</button>
            </div>
            
        </div>

    </form>
    <div class="" id="back" style="margin-top: 0%;margin-bottom: 2%;"> </div>  
</div>
</section>
<script>
//update
$(document).ready(function(){
$('#form_updatedog').submit(function(e){
        e.preventDefault();
        var id = $('#dogID').val();
        var dogname = $('#dogname').val();
        var dogage = $('#dogage').val();
        var dogspecies = $('#dogspecies').val();
       if(id !== null){
            $.ajax({
                url:"dogupdate_db.php",
                method:"post",   
                data:{
                  i: id,
                  dname: dogname,
                  dage: dogage,
                  dspecies: dogspecies
                },

                dataType: "text",
                success: function(data){
                  $('#back').html("<i class='bi bi-check' style='color:green;'></i> <h5 style='color:green;'>Módosítás mentve!");
                    setTimeout("window.location.href='mydogs.php';",800);
                    },
                  error : function(err){
                      alert(Error);
                  },

                })
            }
          
          })});
</script>

<script src="./jQuery/jquery-3.6.4.min.js"></script>           
<?php 
require 'footer.php';
?>