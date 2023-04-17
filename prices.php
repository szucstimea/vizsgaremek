<style>
<?php include 'prices.css'; 
require_once ("inndata.php");
?>
</style>

<?php
    foreach ($szolgaltatas as $szolg){
        switch($szolg["kategoria"]){
            case "alapár":
                $alap = $szolg["ara"];
                break;
            case "fürdetés":
                $furd = $szolg["ara"];
                break;
            case "sétáltatás":
                $set = $szolg["ara"];
                break;
            case "tanítás":
                $tan = $szolg["ara"];
                break;
            case "kozmetika":
                $koz = $szolg["ara"];
                break;
        }
    }
?>

<div class="container-fluid" id="prices">
    <div class="text-center">
        <h1 h1 style="padding:2%;"><i class="bi bi-credit-card"></i>  Áraink</h1>
    </div>
    <div class="container-fluid">
        <div class="row container-fluid text-center elem">
            <div class="col szolg">
                <h5 id="alapar">Alapár<h3 class="ar"><?php echo $alap ?> Ft</h3> </h5>
                <div class="leiras">Az alapár <b>1 napra</b> értendő. A foglalás kezdőnapján 15:00-tól várjuk a kutyusok érkezését 
                    és a foglalás utolsó napján 15:00-ig kell értük megérkezni.
                    Amennyiben igénybe veszik <b>ingyenes</b> szállítási szolgáltatásunkat, az ebeket egyeztetés alapján 
                    14:00 és 15:00 óra között vesszük fel/szállítjuk haza. Az alapár a kutyák prémium minőségű
                    táppal történő <b>etetését tartalmazza</b>. Kérésre saját táppal etetés is megoldott.
                </div>
            </div>
            <div class="col szolg">
                <h5 id="alapar">Fürdetés<h3 class="ar"><?php echo $furd ?> Ft</h3> </h5>
                    <div class="leiras">Amennyiben a foglalásnál a szolgáltatások közül a fürdetés kiválasztásra kerül,
                        panziónk biztosítja a napi egyszeri fürdetést <b>szakképzett kutyakozmetikus</b> által. Ezzel garantáljuk, hogy
                        a kutyusok teljes tisztasággal és ápoltsággal kerülhetnek vissza a gazdikhoz.
                    </div>
                    <img src="assets/images/furdetes.jpg" alt="fürdetés" width="160" height="160">
                </div>
            <div class="col szolg">
                <h5 id="alapar">Sétáltatás<h3 class="ar"><?php echo $set ?> Ft</h3> </h5>
                    <div class="leiras">
                    </div>
                    <img src="assets/images/setaltatas.jpg" alt="sétáltatás" width="160" height="120">
                </div></div>
        </div>
        <div class="row container-fluid text-center">
            <div class="col szolg">Tanítás</div>
            <div class="col szolg">Kozmetika</div>
        </div>
    </div>
</div>