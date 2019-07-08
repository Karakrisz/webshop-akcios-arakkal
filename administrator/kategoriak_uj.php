<?php

  require_once("header.php");

  if (isset($_SESSION["auid"])) { // ha belépve

?>

  <div class="container">
    <h1 class="text-center">Új kategória</h1>
    <form class="col-sm-6 col-sm-push-3" action="cikkek.php?kid=<?php print $kid; ?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
        <label for="knev">Kategória megnevezése:</label>
				<input type="text" class="form-control" name="knev" id="knev" placeholder="Kategória megnevezése" value="<?php print $knev; ?>" autofocus required>
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
      <div class="checkbox">
        <label><input type="checkbox" name="aktiv" id="aktiv" value="1" checked> Aktív</label>
      </div>

			<div class="form-group text-center">
        <input type="hidden" name="event" id="event" value="kategoriak_uj_mentes">
				<button type="submit" class="btn btn-success">Mentés</button>
			</div>
    </form>
  </div>

<?php

  }

  require_once("footer.php");

?>
