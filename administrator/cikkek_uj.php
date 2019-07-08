<?php

  require_once("header.php");

  if (isset($_SESSION["auid"])) { // ha belépve

?>

  <div class="container">
    <h1 class="text-center">Új cikk</h1>
    <form class="col-sm-6 col-sm-push-3" action="cikkek.php?kid=<?php print $kid; ?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
        <label for="cszam">Cikkszám:</label>
				<input type="text" class="form-control" name="cszam" id="cszam" placeholder="Cikkszám" value="<?php print $cszam; ?>" autofocus>
			</div>
			<div class="form-group">
        <label for="cnev">Cikk megnevezése:</label>
				<input type="text" class="form-control" name="cnev" id="cnev" placeholder="Cikk megnevezése" value="<?php print $cnev; ?>" required>
			</div>
			<div class="form-group">
        <label for="szkid">Szülő kategória:</label>
				<select class="form-control" name="szkid" id="szkid">
          <option value="0" disabled selected>Válasszon kategóriát!</option>
<?php
          while ($rekord = mysqli_fetch_assoc($kattabla)) {
            $sel = $rekord["kid"] == $kid ? " selected" : "";
?>
            <option value="<?php print $rekord["kid"]; ?>"<?php print $sel; ?>><?php print $rekord["knev"]; ?></option>
<?php
          }
?>
        </select>
			</div>
			<div class="form-group">
        <label for="kep" id="likeUpload">Kép kiválasztása:</label><br>
        <img name="kep" id="kep" src="<?php print $kep; ?>" width="100%">
			</div>
			<div class="form-group">
        <label for="car">Eladási ár:</label>
				<input type="number" class="form-control" name="car" id="car" placeholder="Eladási ár" value="<?php print $car; ?>" required>
			</div>
			<div class="form-group">
        <label for="car">Akcios ár:</label>
				<input type="number" class="form-control" name="akciosar" id="akciosar" placeholder="Akcios ár" value="<?php print $akciosar; ?>" required>
			</div>
      <div class="form-group">
        <label for="cinfo">Leírás:</label>
        <textarea class="form-control" style="resize: none;" rows="5" name="cinfo" id="cinfo" placeholder="Leírás"><?php print $cinfo; ?></textarea>
      </div>
      <div class="checkbox">
        <label><input type="checkbox" name="akcios" id="akcios" value="1"> Akcios</label>
      </div>
      <div class="checkbox">
        <label><input type="checkbox" name="aktiv" id="aktiv" value="1" checked> Aktív</label>
      </div>

			<div class="form-group text-center">
        <input type="hidden" name="event" id="event" value="cikkek_uj_mentes">
				<button type="submit" class="btn btn-success">Mentés</button>
			</div>
    </form>
  </div>

<?php

  }

  require_once("footer.php");

?>
