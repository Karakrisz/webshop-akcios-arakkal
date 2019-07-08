<?php

  require_once("header.php");

  if (isset($_SESSION["auid"]) && $_SESSION["auid"] == 1) { // ha belépve a supervisor

?>

    <div class="container">
      <h1 class="text-center">Adminisztrátor módosítása</h1>
      <form class="col-sm-6 col-sm-push-3" action="adminok.php" method="post">
  			<div class="form-group">
          <label for="nev">Név:</label>
  				<input type="text" class="form-control" name="nev" id="nev" placeholder="Név" value="<?php print $nev; ?>" autofocus required>
  			</div>
  			<div class="form-group">
          <label for="email">E-mail:</label>
  				<input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="<?php print $email; ?>" required>
  			</div>
        <div class="checkbox">
<?php
          $sel = $aktiv == 1 ? " checked" : "";
          $statusz = $auid == 1 ? " disabled" : "";
?>
          <label><input type="checkbox" name="aktiv" id="aktiv"<?php print $statusz; ?> value="1" <?php print $sel; ?>> Aktív</label>
        </div>
  
  			<div class="form-group text-center">
          <input type="hidden" name="auid" id="auid" value="<?php print $auid; ?>">
          <input type="hidden" name="event" id="event" value="adminok_mod_mentes">
  				<button type="submit" class="btn btn-success">Mentés</button>
  			</div>
      </form>
    </div>

<?php

  }

  require_once("footer.php");

?>
