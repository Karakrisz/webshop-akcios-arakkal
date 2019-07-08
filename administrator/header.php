<?php

  define("TITLE", "Webshop Admin");
  define("ADMIN_EMAIL", "asztalos.peter.zsolt@gmail.com");
  define("CIKKAT_IMG_DIR", "../cikkatimg");
  define("CIKKEK_IMG_DIR", "../cikkekimg");

  // Menüpontok
  $menu = array(
    array("Rendelések", "index"),
    array("Kategóriák és cikkek", "cikkek"),
    array("Fiz. módok", "fizmodok"),
    array("Adminisztrátorok", "adminok")
  );

  require_once("control.php");

?>

<!doctype html>
<html lang="hu">

  <head>
    <title><?php print TITLE; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
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
              if (isset($_SESSION["auid"])) {
                foreach ($menu as $anyMenu) {
                  $className = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == $anyMenu[1] ? "active" : "";
                  print '<li class="'.$className.'"><a href="'.$anyMenu[1].'.php">'.$anyMenu[0].'</a></li>';
                }
              }
?>
            </ul>
            <div class="nav navbar-right text-right" style="margin: 8px 0px 8px 0px;">
<?php
              if (!isset($_SESSION["auid"])) { // ha nincs belépve
?>
                <a class="btn btn-info" data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-log-in"></span></a>
<?php
              } else { // ha be van lépve
                if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "cikkek") {
?>
                  <a class="btn btn-warning" href="kategoriak_uj.php?kid=<?php print $kid; ?>"><span class="glyphicon glyphicon-plus"></span> Új kategória...</a>
                  <a class="btn btn-warning" href="cikkek_uj.php?kid=<?php print $kid; ?>"><span class="glyphicon glyphicon-plus"></span> Új cikk...</a>
<?php
                } else
                if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "fizmodok") {
?>
                  <a class="btn btn-warning" href="fizmodok_uj.php"><span class="glyphicon glyphicon-plus"></span> Új fizetésmód...</a>
<?php
                } else
                if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "adminok" && $_SESSION["auid"] == 1) { // új admint csak az auid=1 user (főadmin) hozhat létre
?>
                  <a class="btn btn-warning" href="adminok_uj.php"><span class="glyphicon glyphicon-plus"></span> Új adminisztrátor...</a>
<?php
                }
                if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) != "adataim") {
?>
                  <a class="btn btn-info" href="adataim.php"><span class="glyphicon glyphicon-file"></span></a>
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

    <!-- RendelésTételek Modal Form -->
    <div class="modal fade" id="RendelesTetelekModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content" style="border: none;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body RendelesTetelekLista">
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
