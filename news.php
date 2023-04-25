<?php
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
  try{ 
            $id = 1;
            $sql = "SELECT * FROM lodinn.hirek WHERE hirek.panzio_ID LIKE :id";
            $result = $conn->prepare($sql);
            $result -> bindParam(':id',$id, PDO::PARAM_STR);
            $result->execute();
            
            if($result ->rowCount() !=0){
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $db_hirID = $row['hirID'];
                    $db_cim = $row['cim'];
                    $db_leiras = $row['leiras'];
                    $db_datum = $row['datum'];

                    $db_leiras = strip_tags($db_leiras);
                    if (strlen($db_leiras) > 100) {

                        // truncate string
                        $stringCut = substr($db_leiras, 0, 500);
                        $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                        $db_leiras = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                        $db_leiras .= '... <button type="button" class="btn btn-primary" style="margin-top:5%;"><a style ="text-decoration: none; color:white" href="newslist.php?id='.$db_hirID.'">Bővebben</a></button>';
                    }
                    echo '
                   
                    <div class="col-sm-6 col-md-4 mb-4 mb-md-0">
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
                        </div>
                        </div>
                    </div>

                    ';
                }
            }

    } catch (PDOException $e){
        echo "Adatbázis hiba: " .$e->getMessage();    
    } catch (Exception $e){
        echo "Egyéb hiba: " .$e->getMessage();
        die();
    } 
?>
</div>
</div>
</section>
