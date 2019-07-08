<?php

  require_once("header.php");

  if (isset($_SESSION["auid"])) { // ha belépve

?>

  <div class="container">
    <h1 class="text-center">Adataim</h1>
    <form class="col-sm-6 col-sm-push-3" action="" method="post">
			<div class="form-group">
        <label for="nev">Név:</label>
				<input type="text" class="form-control" name="nev" id="nev" placeholder="Név" value="<?php print $_SESSION["nev"]; ?>" autofocus required>
			</div>
			<div class="form-group">
        <label for="email">E-mail:</label>
				<input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="<?php print $_SESSION["email"]; ?>" required>
			</div>
			<div class="form-group">
        <label for="jelszo1">Jelszó:</label>
				<input type="password" class="form-control" name="jelszo1" id="jelszo1" placeholder="Jelszó" value="<?php print $jelszo1; ?>" required>
			</div>
			<div class="form-group">
        <label for="jelszo2">Jelszó ismét:</label>
				<input type="password" class="form-control" name="jelszo2" id="jelszo2" placeholder="Jelszó ismét" value="<?php print $jelszo2; ?>" required>
			</div>

			<div class="form-group text-center">
        <input type="hidden" name="event" id="event" value="adatlap_mod">
				<button type="submit" class="btn btn-success">Mentés</button>
			</div>
    </form>
  </div>

<?php

  }

  require_once("footer.php");

?>
