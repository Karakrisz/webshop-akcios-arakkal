<?php

  define("DOMAIN", "http://localhost/webshop/");
  define("TITLE", "Általános Webshop");
  define("ADMIN_EMAIL", "asztalos.peter.zsolt@gmail.com");
  define("CIKKAT_IMG_DIR", "cikkatimg");
  define("CIKKEK_IMG_DIR", "cikkekimg");

  // Menüpontok
  $menu = array(
    array("Webshop", "index"),
    array("Rólunk", "rolunk"),
    array("Kapcsolat", "kapcsolat")
  );

  require_once("control.php");

?>

<!doctype html>
<html lang="hu">

  <head>
    <title><?php print TITLE; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src='https://www.google.com/recaptcha/api.js'></script>
  </head>

  <body style="font-family: Tahoma; margin-top: 70px;">

    <header>
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span> 
            </button>
            <a class="navbar-brand" href="index.php"><?php print TITLE; ?></a>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
<?php
              foreach ($menu as $anyMenu) {
                $className = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == $anyMenu[1] ? "active" : "";
                print '<li class="'.$className.'"><a href="'.$anyMenu[1].'.php">'.$anyMenu[0].'</a></li>';
              }
?>
            </ul>
            <div class="nav navbar-right text-right" style="margin: 8px 0px 8px 0px;">
<?php
              if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "index" || pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "fizmod") {
?>
                <a class="btn btn-warning" data-toggle="modal" data-target="#kosarModal" onclick="kosarLista()" style="padding-top: 5px;"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="badge"></a></a>
<?php
              }
              if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "index" || pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "adataim") {
?>
                <a class="btn btn-warning" id="fizmodGomb" href="fizmod.php"><span class="glyphicon glyphicon-usd"></span></a>
<?php
              }
              if (!isset($_SESSION["uid"])) { // ha nincs belépve
?>
                <a class="btn btn-info" data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-log-in"></span> Bejelentkezés</a>
<?php
                if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) != "regisztracio") {
?>
                  <a class="btn btn-success" href="regisztracio.php"><span class="glyphicon glyphicon-user"></span> Regisztráció</a>
<?php
                }
              } else { // ha be van lépve
                if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) != "adataim") {
?>
                  <a class="btn btn-info" id="adataim" href="adataim.php" title="Adataim"><span class="glyphicon glyphicon-file"></span></a>
<?php
                }
?>
                <a class="btn btn-info" href="index.php?event=kilépés"><span class="glyphicon glyphicon-log-out"></span></a>
<?php
              }
?>
            </div>
          </div>
        </div>
      </nav>
    </header>

    <!-- Bejelentkezés Modal Form -->
    <div class="modal fade" id="loginModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Bejelentkezés</h4>
          </div>
          <div class="modal-body">
      			<form action="" method="post">
      				<div class="form-group">
      					<input type="email" class="form-control" name="email" id="email" placeholder="E-mail" autofocus required>
      				</div>
      				<div class="form-group">
      					<input type="password" class="form-control" name="jelszo" id="jelszo" placeholder="Jelszó" required>
      				</div>
      				<div class="form-group text-center">
                <input type="hidden" name="event" id="event" value="bejelentkezés">
      					<button type="submit" class="btn btn-info">Bejelentkezés</button>
      				</div>
      			</form>
          </div>
        </div>
      </div>
    </div>

    <!-- Kosár Modal Form -->
    <div class="modal fade" id="kosarModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content col-xs-12">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Kosár</h4>
          </div>
          <div class="modal-body kosarLista">
          </div>
        </div>
      </div>
    </div>

    <!-- Cikk Adatlap Modal Form (a writeDetails.js írja be az adatokat) -->
    <div class="modal fade" id="cikkModal" role="dialog">
      <div class="modal-lg modal-dialog">
        <div class="modal-content col-xs-12">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <div class="col-md-6 kep"></div>
            <div class="col-md-6 ar">
              <h2></h2>
         			<form class="form">
        				<div class="form-group">
                  <label for="mennyiseg">Mennyiség:</label>
        					<input type="number" class="form-control" name="mennyiseg" id="mennyiseg" placeholder="Mennyiség" value="1" min="1" max="10" required>
        				</div>
        				<div class="form-group">
        					<button type="button" class="btn btn-warning" name="gombKosarba" id="gombKosarba" onclick="" data-dismiss="modal">Kosárba teszem</button>
        				</div>
              </form>
            </div>
            <div class="col-md-12 leiras"></div>
          </div>
        </div>
      </div>
    </div>

<?php
    // Üzenet megjelenítése
    if (isset($uzenet)) {
?>
      <div>
        <p class="text-info text-center"><?php print $uzenet; ?></p>
      </div>
<?php
    }
?>
