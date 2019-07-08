<?php

  require_once("header.php");

  if (isset($_SESSION["auid"])) { // ha belépve

?>
    <div class="container">
      <h1 class="text-center">Fizetési és szállítási módok</h1>
      <div class="list-group col-xs-12 col-md-6 col-md-push-3">
<?php
        while ($rekord = mysqli_fetch_assoc($tabla)) {
?>
          <div class="list-group-item">
            <h4 class="list-group-item-heading"><?php print $rekord["fnev"]; ?></h4>
            <p class="list-group-item-text"><?php print $rekord["leiras"]; ?></p>
<?php
            if ($rekord["felar"] > 0) {
?>
              <p class="list-group-item-text"><b>Felár: <?php print $rekord["felar"]; ?> Ft</b></p>
<?php
            }
?>
            <p class="text-right"><a class="btn btn-warning" href="fizmodok_mod.php?fid=<?php print $rekord["fid"]; ?>"><span class="glyphicon glyphicon-pencil"></span></a></p>
          </div>
<?php
        }
?>
      </div>
    </div>
<?php

  }

  require_once("footer.php");

?>
