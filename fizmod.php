<?php
  require_once("header.php");

  if (!kosarUres()) {
?>
    <div class="container">
<?php
      if (!isset($_SESSION["uid"])) { // ha nincs belépve
?>
        <h1 class="text-center">Vásárló azonosítása</h1>
        <div class="col-xs-12 col-md-6">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h4>Bejelentkezés</h4>
            </div>
            <div class="panel-body">
              <p>Ha Ön már vásárolt nálunk korábban, akkor kérjük jelentkezzen be!</p>
              <div class="text-center">
                <a class="btn btn-info" data-toggle="modal" data-target="#loginModal">Bejelentkezés <span class="glyphicon glyphicon-log-in"></span></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-6">
          <div class="panel panel-success">
            <div class="panel-heading">
              <h4>Regisztráció</h4>
            </div>
            <div class="panel-body">
              <p>Ha Ön most vásárol nálunk először, akkor kérjük regisztráljon!</p>
              <div class="text-center">
                <a class="btn btn-success" href="regisztracio.php">Regisztráció <span class="glyphicon glyphicon-user"></span></a>
              </div>
            </div>
          </div>
        </div>
<?php
      } else { // ha be van lépve
?>
        <h1 class="text-center">Fizetési és szállítási mód választása</h1>
        <p class="text-center text-info">Válasszon egy lehetőséget!</p>
        <div class="list-group col-xs-12 col-md-6 col-md-push-3">
<?php
          while ($rekord = mysqli_fetch_assoc($fiztabla)) {
?>
            <a href="szumma.php?fid=<?php print $rekord["fid"]; ?>" class="list-group-item">
              <h4 class="list-group-item-heading"><?php print $rekord["fnev"]; ?></h4>
              <p class="list-group-item-text"><?php print $rekord["leiras"]; ?></p>
<?php
              if ($rekord["felar"] > 0) {
?>
                <p class="list-group-item-text"><b>Felár: <?php print $rekord["felar"]; ?> Ft</b></p>
<?php
              }
?>
            </a>
<?php
          }
?>
        </div>
<?php
      }
?>
    </div>
<?php
  }

  require_once("footer.php");
?>
