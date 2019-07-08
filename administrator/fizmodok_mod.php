<?php

  require_once("header.php");

  if (isset($_SESSION["auid"])) { // ha belépve

?>

    <div class="container">
      <h1 class="text-center">Szállítási és fizetésmód módosítása</h1>
      <form class="col-sm-6 col-sm-push-3" action="fizmodok.php" method="post">
  			<div class="form-group">
          <label for="fnev">Fizetésmód megnevezése:</label>
  				<input type="text" class="form-control" name="fnev" id="fnev" placeholder="Fizetésmód megnevezése" value="<?php print $fnev; ?>" required autofocus>
  			</div>
        <div class="form-group">
          <label for="leiras">Leírás:</label>
          <textarea class="form-control" style="resize: none;" rows="5" name="leiras" id="leiras" placeholder="Leírás" required><?php print $leiras; ?></textarea>
        </div>
  			<div class="form-group">
          <label for="felar">Felár:</label>
  				<input type="number" class="form-control" name="felar" id="felar" placeholder="Felár" value="<?php print $felar; ?>" required>
  			</div>
        <div class="checkbox">
<?php
          $sel = $aktiv == 1 ? " checked" : "";
?>
          <label><input type="checkbox" name="aktiv" id="aktiv" value="1" <?php print $sel; ?>> Aktív</label>
        </div>
  
  			<div class="form-group text-center">
          <input type="hidden" name="fid" id="fid" value="<?php print $fid; ?>">
          <input type="hidden" name="event" id="event" value="fizmodok_mod_mentes">
  				<button type="submit" class="btn btn-success">Mentés</button>
  			</div>
      </form>
    </div>

<?php

  }

  require_once("footer.php");

?>
