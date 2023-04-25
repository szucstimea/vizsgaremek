<style>
<?php include 'prices.css'; 
include 'inndata.php';
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
                $seta = $szolg["ara"];
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

<div id="prices" data-aos="fade-up" data-aos-duration="1000">
    <div class="text-center">
        <h1 style="padding:2%;"><i class="bi bi-credit-card"></i>  Áraink</h1>
    </div>
    <div class="container osszes">
        <div class="row container text-center elem">
            <div class="col container szolg">
                <h5 id="alapar" class="nev">Alapár<h3 class="ar"><?php echo $alap ?> Ft</h3> </h5>
                <div class="leiras">Az alapár <b>1 napra</b> értendő. A foglalás kezdőnapján 15:00-tól várjuk a kutyusok érkezését 
                    és a foglalás utolsó napján 15:00-ig kell értük megérkezni.
                    Amennyiben igénybe veszi <b>ingyenes</b> szállítási szolgáltatásunkat, az ebeket egyeztetés alapján 
                    14:00 és 15:00 óra között vesszük fel/szállítjuk haza. Az alapár a kutyák prémium minőségű
                    táppal történő <b>etetését tartalmazza</b>. Kérésre saját táppal etetés is megoldható.
                </div>
            </div>
            <div class="col container szolg">
                <h5 id="furdetes" class="nev">Fürdetés<h3 class="ar"><?php echo $furd ?> Ft</h3> </h5>
                <div class="leiras">Amennyiben a foglalásnál a szolgáltatások közül a fürdetés kiválasztásra kerül,
                    panziónk biztosítja a napi egyszeri fürdetést <b>szakképzett kutyakozmetikus</b> által. Ezzel garantáljuk, hogy
                    a kutyusok teljes tisztasággal és ápoltsággal kerülhetnek vissza a gazdikhoz.
                </div>
                <img src="<?php echo $kepek["furdetes"]?>" alt="fürdetés" width="160" height="160">
                </div>
            <div class="col container szolg">
                <h5 id="seta" class="nev">Sétáltatás<h3 class="ar"><?php echo $seta ?> Ft</h3> </h5>
                <div class="leiras">A sétáltatás magában foglalja a napi egyszeri sétáltatást a panzió területén kívül, 
                    esetleg csoportban. Garantáltan <b>biztonságos környéken</b> a kutyusok új ingerekkel találkozhatnak
                    és kikapcsolódhatnak, mint amikor a gazdival teszik meg a napi rutint.                        
                </div>
                <img src="<?php echo $kepek["setaltatas"]?>" style="padding-top: 1rem" alt="sétáltatás" width="160" height="120">
            </div>
        </div>
        <div class="row container text-center elem2">
            <div class="col container szolg sor2">
                <h5 id="tanitas" class="nev">Tanítás<h3 class="ar"><?php echo $tan ?> Ft</h3> </h5>
                <div class="leiras">Ha szeretné, hogy kutyusa a panzióban töltött idő alatt fejlődjön, akkor foglalása
                    mellé kérje a tanítás szolgáltatásunkat! <b>Szakképzett oktatóink</b> a kutyusa tudásának megfelelő
                    szintű 1 órás egyéni vagy csoportos kiképzést biztosítanak. Az sem gond, ha az alapokkal kell kezdeni!                      
                </div>
                <img src="<?php echo $kepek["tanitas"]?>" style="padding: 1rem" alt="tanítás" width="160" height="120">
            </div>
            <div class="col szolg container sor2">
                <h5 id="kozmetika" class="nev">Kozmetika<h3 class="ar"><?php echo $koz ?> Ft</h3> </h5>
                <div class="leiras">Kis kedvence a panzió szolgáltatásai közül kozmetikánkat is élvezheti, így egybe is 
                    kötheti az ápolásra fordított időt a megőrzés idejével. <b>Szaktudással rendelkező kollegáink</b> 
                    minden kutyafajtának a megfelelő kozmetikai kezelést tudják biztosítani és garantáltan ápoltan 
                    térhetnek haza a négylábúak.                      
                </div>
                <img src="<?php echo $kepek["kozmetika"]?>" style="padding: 1rem" alt="tanítás" width="160" height="120">
            </div>
        </div>
    </div>
</div>