<?php
include 'dbconnect.php';
// class CheckUsername extends Db{

//     public function check($username){
//         $sql ="SELECT * FROM Felhasznalok WHERE felhNev = ?";
//         $stmt = $this->connect()->prepare($sql);
//         $stmt->execute([$username]);
//         $users = $stmt->fetchAll();

//         foreach($users as $user){
//             if($user == $username){
//                 echo '
//                 <div class="alert alert-danger alert-dismissible fade show" role="alert" id="foglaltfelhasznalonev"">
//                 <i class="bi bi-info-circle-fill"></i> A megadott felhasználónévvel még nem regisztráltak! Kérem adjon meg másikat vagy regisztráljon itt!
//                 <button type="button" class="close" data-dismiss="alert" id="close3">
//                     x
//                 </button>
//                 </div>
//                 ';
//             }
//         }
//     }
// }

$output ="";
if(isset($_POST["search"])){
    try{
    $sql = "SELECT * FROM lodinn.felhasznalok WHERE felhasznalok.felhNev LIKE '%".$_POST["search"]."%'";
    $result = $conn->prepare($sql);
    $result->execute();
    if ($result ->rowCount()==0){
        $output .='
        <p style="color:red;"> <i class="bi bi-hand-index-thumb"></i> A megadott felhaszálónévvel még nem regisztráltak!<br> Kérem adjon meg másikat vagy regisztráljon!</p>
        ';
    } else {
        return 0;
    }
    echo $output;

    }catch (PDOException $e){
        echo "Adatbázis hiba: " .$e->getMessage();
        $conn->rollBack();
    } catch (Exception $e){
        echo "Egyéb hiba: " .$e->getMessage();
        die();
    }
}
?>