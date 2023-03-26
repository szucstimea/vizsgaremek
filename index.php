<?php
require 'header.php';
require 'cookieModal.php';
require 'carousel.php';
require 'aboutus.php';
require 'booking.php';
require 'prices.php';
require 'news.php';
require 'footer.php';
require_once("dbconnect.php");
?>
<!-- látógatók számának mérése sütivel, fájlbaírással -->
<?php
$file='counter.txt';
if(file_exists($file)){
    
   
    if(isset($_COOKIE['count'])){
        $fopen = fopen($file, "r+");
        $content = (int)file_get_contents($file);
        $val = ++$content; 
        $put = file_put_contents($file,$val);
        fwrite($fopen, $val);

    
     }else {
        echo [$_COOKIE['count']];
     }

     fclose($fopen);
    
}



?>
