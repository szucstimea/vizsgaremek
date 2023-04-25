<style>
<?php include 'style.css'; 
include 'inndata.php';
?>
</style>

<section style="color: #000; background-color: #f3f2f2;" id="customers" data-aos="fade-up">
  <div class="container py-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-10 col-xl-8 text-center">
        <h3 class="fw-bold mb-4">Ügyfeleink visszajelzései</h3>
        <p class="mb-4 pb-2 mb-md-5 pb-md-0">
            Ügyfeleink visszajelzései nagyon fontos számunkra. Legyen az pozitív vagy negatív, minden esetben meghallgatjuk és átgondoljuk annak lehetőségét hogyan tudjuk a szolgáltatásaink minőségét javítani és ügyfeleink elégedettségét növelni. 
        </p>
      </div>
    </div>

    <div class="row text-center">
      <div class="col-md-4 mb-4 mb-md-0">
        <div class="card">
          <div class="card-body py-4 mt-2">
            <div class="d-flex justify-content-center mb-4">
              <img src="<?php echo $kepek["customer1"]?>"
                class="rounded-circle shadow-1-strong" width="90" height="100" />
            </div>
            <h5 class="font-weight-bold">Nagy Eszter</h5>
            <h6 class="font-weight-bold my-3" style="color:#63f1bbd2;">Labrador gazdi</h6>
            <p class="mb-2">
              "A Lodinn kutyapanzió a legjobb hely kutyusom számára ha nem tudom magammal vinni. Köszönöm, hogy gondját viselitek a családunk kis kedvencének!"
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4 mb-md-0">
        <div class="card">
          <div class="card-body py-4 mt-2">
            <div class="d-flex justify-content-center mb-4">
              <img src="<?php echo $kepek["customer2"]?>"
                class="rounded-circle shadow-1-strong" width="100" height="100" />
            </div>
            <h5 class="font-weight-bold">Kis István</h5>
             <h6 class="font-weight-bold my-3"style="color:#63f1bbd2;" >Husky gazdi</h6>
            <p class="mb-2">
              "A kutyám imád a panzióban lenni, ezt mindenki láthatja rajta amikor odaérünk."
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-0">
        <div class="card">
          <div class="card-body py-4 mt-2">
            <div class="d-flex justify-content-center mb-4">
              <img src="<?php echo $kepek["customer3"]?>"
                class="rounded-circle shadow-1-strong" width="80" height="100" />
            </div>
            <h5 class="font-weight-bold">Kovács Alexa</h5>
            <h6 class="font-weight-bold my-3" style="color:#63f1bbd2;">Vizsla gazdi</h6>
            <p class="mb-2">
              "Először féltem, hogy nem tud megfelelően viselkedni egy idegen környezetben, de nagyon hamar feloldódott a kutyánk. Értenek ahhoz, amit csinálnak..."
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>