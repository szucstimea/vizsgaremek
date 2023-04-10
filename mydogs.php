<?php
require 'header.php';
if(isset($_SESSION["username"])){
        $username = $_SESSION["username"];
}
?>
<div class="alert alert-success alert-dismissible fade show" role="alert" id="toroluzenet" style="display: none;">
 <i class="bi bi-info-circle-fill"></i> A kutyát töröltük!
  <button type="button" class="btn-close" data-dismiss="alert" id="close2" aria-label="Close">
  </button>
</div>

<div class="alert alert-success alert-dismissible fade show" role="alert" id="hozzaaduzenet" style="display: none;">
 <i class="bi bi-info-circle-fill"></i> A kutyát hozzáadtuk a listához!
  <button type="button" class="btn-close" data-dismiss="alert" id="close3" aria-label="Close">
  </button>
</div>

<div id="settings" style="display: none;">

</div>

<section id="sectionprofile">
<div class="container text-justify p-3" >
    <div class="text-center">    
        <h1 id="titleprofile"><i class="bi bi-heart"></i> Kutyáim </a></h1>
        <p> A "Kutyáim" menüpont lehetővé teszi a felhasználók számára, hogy megtekintsék vagy szerkesszék a foglalások során a kutyákról megadott adatokat.</p><br>
    </div>
</div>
<!-- kutyák kiolvasása -->
<div class="text-center">  
<table class="table table-striped" id="datatable" style="width: 100%;">
<thead>
        <tr style="background-color: #498ffc; color: white;">
            <th scope="col">KUTYA NEVE</th>
            <th scope="col">KORA (HÓNAP)</th>
            <th scope="col">FAJTÁJA</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
</thead>
  <tbody id="table_data">

            <?php
            try{
                $sql = "SELECT * FROM lodinn.felhasznalok WHERE felhasznalok.felhNev LIKE :username ";
                $result = $conn->prepare($sql);
                $username = "%".$username."%";
                $result -> bindParam(':username',$username, PDO::PARAM_STR);
                $result->execute();
                if($result ->rowCount() !=0){
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $db_Id = $row['felhID'];
                    }   
                
                }
                $sql2 = "SELECT * FROM lodinn.vendegek WHERE vendegek.felh_ID = ?";
                $result = $conn->prepare($sql2);
                $result->bindParam(1, $db_Id, PDO::PARAM_INT);
                $result->execute();
                if($result ->rowCount() !=0){
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $db_vendegID= $row['vendegID'];            
                    }
                }      
                $sql3 = "SELECT * FROM lodinn.kutyak WHERE kutyak.vendeg_ID = ?";
                $result = $conn->prepare($sql3);
                $result->bindParam(1, $db_vendegID, PDO::PARAM_INT);
                $result->execute();
                if($result ->rowCount() !=0){
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $db_kutyaId= $row['kutyaID']; 
                        $db_kutyaNev = $row['kutyaNev']; 
                        $db_kutyaKor= $row['kor'];   
                        $db_kutyaFajta = $row['fajta'];
                        $db_timeStamp =  $row['rogzites'];   
                        $currenttime = date("Y-m-d H:i:s");
                        $ts1 = strtotime($db_timeStamp);
                        $ts2 = strtotime($currenttime);
                        $year1 = date('Y', $ts1);
                        $year2 = date('Y', $ts2);
                        $month1 = date('m', $ts1);
                        $month2 = date('m', $ts2);
                        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                        $currentage = $db_kutyaKor + $diff;

                        echo "<tr id='kuyta$db_kutyaId'>";

                        echo "<td >$db_kutyaNev</td>";
                        echo "<td>$currentage</td>";
                        echo "<td>$db_kutyaFajta</td>";
                        echo "<td><a href='updatedog.php?id=$db_kutyaId' type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Szerkesztés'><i class='bi bi-pen'></i></a></td>";
                        echo "<td><button onclick='deleteAjax($db_kutyaId)'type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Törlés'><i class='bi bi-trash3'></i></button></td>";
                        echo "</tr>";
                    }
                }  else {
                    echo "Nincs eredménye a lekérdezésnek!";
                }    
            } catch (PDOException $e){
                        echo "Adatbázis hiba: " .$e->getMessage();                 
            } catch (Exception $e){
                        echo "Egyéb hiba: " .$e->getMessage();
                        die();
                    } 
        ?> 
    </tbody>
 </table>
 </div>



 <!-- új kutya hozzáadása -->
 <div style=" padding: 5%; width: 100%;">
    <div class="separator">
            <h1><i class="bi bi-plus-circle";></i> Új kutya hozzáadása</h1>
    </div> 
        <!-- Űrlap -->
        <form method="" id="formdog" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <div class="form-group ">
                <input type="text" name="kutyaID" id="kutyaID" class="form-control" style="display:none;" value="<?php if(isset($uj_kutyaId)){echo $uj_kutyaId;};?>">
                <input type="text" name="vendegID" id="vendegID" class="form-control" style="display:none;" value="<?php if(isset($db_vendegID)){echo $db_vendegID;};?>">
                <label for="kutyanev"></label><br>
                <div class="">
                <input type="text" name="kutyanev" id="kutyanev" placeholder="Kutya neve" class="form-control">
                </div>
 
                <label for="kutyakor"></label><br>
                <div class="">
                <input type="number" name="kutyakor" id="kutyakor" placeholder="Kor (hónap)" class="form-control">
                </div>

                <label for="kutyafajta"></label><br>
                <div class="">
                <input type="text" name="kutyafajta" id="kutyafajta" placeholder="Fajta" class="form-control">
                </div>

                <div class="col-auto my-2">
                <input type="submit" value="Rögzítés" name="submit" id="submit" class="btn btn-primary">
                 </div>
                </div>
            </form>
    </div>
</section>

<script>

    //kutya törlése
function deleteAjax(id){

    if(confirm('Biztos benne, hogy véglegesen törölni szeretné a kuyust?')){
        $.ajax({
            type: 'POST',
            url:'deletedog.php',
            data:{id: id},
            success: function(data){
                $('#kutya'+id).remove();
                $("#toroluzenet").show('slow');
                // setTimeout("window.location.href='mydogs.php';",800);
                
            }

        });
    }
}
$(document).ready(function() {
    $("#close2").click(function bezar(){
        $("#toroluzenet").fadeOut('slow');
    })

});
 //kutya hozzáadása
$('#formdog').submit(function(e){

        $.ajax({
            type:"POST",
            url:"insertdog.php",
            data: $('#formdog').serialize(),
            success: function(data){
              $("#hozzaaduzenet").show('slow');
              $('#formdog')[0].reset();
                var array = $.parseJSON(data);          
                $('#table_data').append("<tr id='kutya"+array.id+"'><td>"+ array.kutyanev +"</td><td>"+array.kutyakor+"</td><td>"+array.kutyafajta+"</td><td><a href='updatedog.php?id="+array.id+"' type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Szerkesztés'><i class='bi bi-pen'></i></a></td><td><button onclick='deleteAjax("+array.id+")' type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' aria-label='Törlés' title='Törlés'><i class='bi bi-trash3'></i></button></td></tr>");     
            }
        })
       e.preventDefault();

     })

$(document).ready(function() {
$("#close3").click(function bezar(){
    $("#hozzaaduzenet").fadeOut('slow');
})

});

</script>


<script src="./jQuery/jquery-3.6.4.min.js"></script>
<?php 
require 'footer.php';
?>