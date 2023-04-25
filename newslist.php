<?php
require 'header.php';
include 'inndata.php';
?>
<div class="container-fluid" id="news" data-aos="fade-up">
    <div class="text-center">
        <h1 style="padding:2%;"><i class="bi bi-newspaper"></i>  Hírek</h1>
    </div>
<div>
<section id="customers">
<div class="container py-5">
<div class="row text-center">
<?php
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


                    echo '
                   
                    
                        <div class="card col-12">
                        <div class="card-body py-4 mt-2">
                            <div class="justify-content-center mb-4">
                                <img src="'.$kepek["logo"].'"
                                    class="rounded-circle shadow-1-strong" width="80" height="80" />
                            </div>
                            <p class="font-weight">'.$db_datum.'</p>
                            <h6 class="font-weight-bold my-3">'.$db_cim.'</h6>
                            <p class="mb-2 text-muted justify">
                            '.$db_leiras.'
                            </p>
                            <div class="col-md-1">
                            <a href="index.php#news" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Vissza" style="margin-top: 18%;margin-bottom: 2%;"><i class="bi bi-arrow-left-circle"></i>  Vissza </a>
                            </div>
                        </div>
                        </div>
   
                    
                    ';
                }}

    } catch (PDOException $e){
        echo "Adatbázis hiba: " .$e->getMessage();    
    } catch (Exception $e){
        echo "Egyéb hiba: " .$e->getMessage();
    die();
    }
}
?>
</div>
</div>
</section>
<script src="./jQuery/jquery-3.6.4.min.js"></script>
<?php 
require 'footer.php';
?>
