<?php
session_start();
session_unset();
session_destroy();

setcookie('veznev', '', time()-3600);
setcookie('kernev', '', time()-3600);
setcookie('username', '', time()-3600);
setcookie('password', '', time()-3600);
setcookie('loggedin', '', time()-3600);

header("location:index.php");
?>