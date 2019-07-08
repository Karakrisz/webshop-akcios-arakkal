<?php

  require_once("header.php");

  if (isset($_SESSION["auid"])) { // ha belépve

?>
    <div class="container">
      <h1 class="text-center">Adminisztrátorok</h1>
      <div class="list-group col-xs-12 col-md-6 col-md-push-3">
<?php
        while ($rekord = mysqli_fetch_assoc($tabla)) {
          if ($rekord["aktiv"] == 1) {
            $glyphicon = "glyphicon-ok";
            $color = "success";
          } else {
            $glyphicon = "glyphicon-remove";
            $color = "danger";
          }
?>
          <div class="list-group-item">
            <h4 class="list-group-item-heading"><?php print $rekord["nev"]; ?></h4>
            <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
              <p class="list-group-item-text"><?php print $rekord["email"]; ?></p>
              <p class="list-group-item-text">Aktív: <span class="text-<?php print $color; ?> glyphicon <?php print $glyphicon; ?>"></span></p>
            </div>
<?php
            if ($_SESSION["auid"] == 1) { // ha a főadmin van bejelentkezve
?>
              <p class="text-right"><a class="btn btn-warning" href="adminok_mod.php?auid=<?php print $rekord["auid"]; ?>"><span class="glyphicon glyphicon-pencil"></span></a></p>
<?php
            }
?>
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
