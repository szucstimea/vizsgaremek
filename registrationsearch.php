<?php
include 'dbconnect.php';

class CheckUsername extends Database{

    public function check($username){
        $sql ="SELECT * FROM Felhasznalok WHERE felhNev = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $users = $stmt->fetchAll();

        foreach($users as $user){
            if($user == $username){
                echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="foglaltfelhasznalonev"">
                <i class="bi bi-info-circle-fill"></i> A megadott felhasználónévvel még nem regisztráltak! Kérem adjon meg másikat vagy regisztráljon itt!
                <button type="button" class="close" data-dismiss="alert" id="close3">
                    x
                </button>
                </div>
                ';
            }
        }
    }
}
?>