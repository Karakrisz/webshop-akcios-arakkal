<?php

  require_once("header.php");

  if (isset($_SESSION["uid"]) && !kosarUres() && $fid > 0 && mysqli_num_rows($fiztabla) > 0) { // ha be van lépve és nem üres a kosár és létező fizetésmód lett választva 
    $szla_cim = $szla_irszam." ".$szla_varos.", ".$szla_utcahaz;
    $szall_nev = $szall_nev != "" ? $szall_nev : $szla_nev;
    $szall_cim = $szall_irszam != "" ? $szall_irszam." ".$szall_varos.", ".$szall_utcahaz : $szla_cim;

?>

    <div class="container">
      <h1 class="text-center">Rendelés ellenőrzése</h1>
      <h2 class="text-center">Közvetlen adatok</h2>
      <div class="row">
        <div class="col-xs-6 text-right"><b>Megrendelő neve: </b></div>
        <div class="col-xs-6"><?php print $nev; ?></div>
      </div>
      <div class="row">
        <div class="col-xs-6 text-right"><b>E-mail címe: </b></div>
        <div class="col-xs-6"><?php print $email; ?></div>
      </div>
      <div class="row">
        <div class="col-xs-6 text-right"><b>Telefonszáma: </b></div>
        <div class="col-xs-6"><?php print $telefon; ?></div>
      </div>
      <h2 class="text-center">Számlázási adatok</h2>
      <div class="row">
        <div class="col-xs-6 text-right"><b>Számázási név / cégnév: </b></div>
        <div class="col-xs-6"><?php print $szla_nev; ?></div>
      </div>
      <div class="row">
        <div class="col-xs-6 text-right"><b>Cím: </b></div>
        <div class="col-xs-6"><?php print $szla_cim; ?></div>
      </div>
      <h2 class="text-center">Szállítási adatok</h2>
      <div class="row">
        <div class="col-xs-6 text-right"><b>Szállítási név / cégnév: </b></div>
        <div class="col-xs-6"><?php print $szall_nev; ?></div>
      </div>
      <div class="row">
        <div class="col-xs-6 text-right"><b>Cím: </b></div>
        <div class="col-xs-6"><?php print $szall_cim; ?></div>
      </div>
      <h2 class="text-center">Rendelési adatok</h2>
      <div class="kosarLista"></div>
    </div>

<?php

  }

  require_once("footer.php");

?>
