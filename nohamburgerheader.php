<?php
require 'loginmodal.php';
include 'inndata.php';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <title>LodInn kutyapanzió</title>
</head>

<nav class="navbar navbar-dark" style="background-color: #498ffc;">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php" id="cim">
    <img src="<?php echo $kepek["logo"]?>" alt="Logo" class="d-inline-block align-text-top" id="logo">
    LODINN KUTYAPANZIÓ<br>
    <div id="alcim" class="fw-light">kutyusa a legjobb kezekben</div>
    </a>
    <ul class="navbar-nav flex-row mr-lg-0" style="margin-right: 15%;">
            <li class="nav-item-icons">
                <a class="nav-link pr-2" href="tel:+36301234567"><i class="bi bi-telephone"></i></a>
            </li>
            <li class="nav-item-icons">
                <a class="nav-link pr-2" id="login"><i class="bi bi-person"></i></a>
            </li>
            <li class="nav-item-icons">
                <a class="nav-link pr-2" href="<?php echo $linkek["facebook"]?>" target="_blank"><i class="bi bi-facebook"></i></a>
            </li>
            <li class="nav-item-icons">
                <a class="nav-link pr-2" href="<?php echo $linkek["instagram"]?>" target="_blank"><i class="bi bi-instagram"></i></a>
            </li>
            <li class="nav-item-icons">
                <a class="nav-link pr-2"  href="mailto:lodinn@lodinn.hu"><i class="bi bi-envelope"></i></a>
            </li>
            <li class="nav-item-icons">
                 <a class="nav-link pr-2"><i class="bi bi-search"></i></a>
            </li>
        </ul>
  </div>
</nav>