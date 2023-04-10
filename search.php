<?php
require 'dbconnect.php';
$output="";
if(isset($_POST['sea'])){
         $search = trim($_POST["sea"]);
         try{  
         $sql="SELECT * FROM lodinn.hirek WHERE cim LIKE  '%".$search."%' OR leiras LIKE '%".$search."%'";
         $search = $conn->prepare($sql);
        //  $search_db = "%".$search."%";
        //  $search -> bindParam(':search',$search_db, PDO::PARAM_STR);
         $search->bindColumn("cim",$cim);
         $search->bindColumn("leiras",$leiras);
         $search->execute();
         
         if ($search->rowCount()>0){

            while ($row = $search->fetch(PDO::FETCH_BOUND)) {
            }
            $output .='
                <div style="background-color: white; border: none; border-radius: 20px 20px 20px 20px;">
                <h3 style="color:black;">'.$cim.'</h3><br>
                <p>'.$leiras.'</p>
                </div>
                ';
         } else {
            $output .='
                <p style="color:white;">A keresett tartalom nem található</p>
                ';
        } echo $output;

    } catch (PDOException $e){
            echo "Adatbázis hiba: " .$e->getMessage();    
    } catch (Exception $e){
            echo "Egyéb hiba: " .$e->getMessage();
            die();
    }
          
    } 
?>