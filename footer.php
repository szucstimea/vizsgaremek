<?php require_once ("inndata.php"); ?>

<div class="ratio ratio-21x9">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2760.575560759822!2d19.887092015931895!3d46.218897779117164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x474483f623bef64b%3A0xeabcc793bc22e06c!2zU3plZ2VkaSBTWkMgVMOzdGggSsOhbm9zIFN6YWtrw6lwesWRIElza29sYSDDqXMgU3ppbMOhZ3lpIE1paMOhbHkgS29sbMOpZ2l1bQ!5e0!3m2!1shu!2shu!4v1678217806892!5m2!1shu!2shu" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<footer class="text-center text-lg-start bg-dark text-white footer-background" id=footer>
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block fw-bold justify-content-center justify-conten">
      <span><i class="bi bi-balloon-heart"></i> VEGYE FEL VELÜNK A KAPCSOLATOT</span>
    
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="" class="me-4 text-white"><i class="bi bi-facebook"></i></a>
      <a href="" class="me-4 text-white"><i class="bi bi-twitter"></i></a>
      <a href="" class="me-4 text-white"><i class="bi bi-google"></i></a>
      <a href="" class="me-4 text-white"><i class="bi bi-instagram"></i></a>
      <a href="" class="me-4 text-white"><i class="bi bi-github"></i></a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
          <i class="bi bi-clipboard-data"></i> Vállalkozásunk adatai
          </h6>
          <p>
            Székhely: <?php echo $panzioirsz." ".$panziovaros ?>, <br><?php echo $panzioutca." ".$panziohazszam?><br><br>
            Adószám: <?php echo $panzioadoszam ?> <br><br>
            Cégjegyzékszám: <?php echo $panziocegjegyzek ?><br><br>
            Engedély: <?php echo $panzioengedely ?>
          </p>
        </div>
        <!-- Grid column -->



        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4"> <i class="bi bi-telephone"></i> Kapcsolat</h6>
          <p><i class="bi bi-house-door"></i><?php echo $panzioirsz." ".$panziovaros." ".$panzioutca." ".$panziohazszam?> </p>
          <p>
          <i class="bi bi-envelope-at"></i></i>
          <?php echo "<a class=\"text-white ref-nostyle \" href=\"mailto:".$panzioemail."\">".$panzioemail."</a>" ?>
            <!-- lodinn@lodinn.hu -->
          </p>
          <p><i class="bi bi-phone-vibrate"></i><?php echo "<a class=\"text-white ref-nostyle \" href=\"tel:".$panziotel."\">".$panziotel."</a>" ?></p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © <span id="spanYear"></span> Copyright:
    <a class="text-reset fw-bold" href="index.php"><?php echo $panzionev ?> kutyapanzió</a>
  </div>
  <!-- Copyright -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</footer>
<!-- Footer -->
<script>    
$('#spanYear').html(new Date().getFullYear());
</script>