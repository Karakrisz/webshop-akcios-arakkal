<?php

  require_once("header.php");

  if (isset($_SESSION["auid"]) && $_SESSION["auid"] == 1) { // ha belépve a főadmin

?>

    <div class="container">
      <h1 class="text-center">Új adminisztrátor</h1>
      <form class="col-sm-6 col-sm-push-3" action="" method="post">
  			<div class="form-group">
          <label for="nev">Név:</label>
  				<input type="text" class="form-control" name="nev" id="nev" placeholder="Név" autofocus required>
  			</div>
  			<div class="form-group">
          <label for="email">E-mail:</label>
  				<input type="email" class="form-control" name="email" id="email" placeholder="E-mail" required>
  			</div>
        <div class="checkbox">
          <label><input type="checkbox" name="aktiv" id="aktiv" value="1" checked> Aktív</label>
        </div>
  
  			<div class="form-group text-center">
          <input type="hidden" name="event" id="event" value="adminok_uj_mentes">
  				<button type="submit" class="btn btn-success">Mentés</button>
  			</div>
      </form>
    </div>

<?php

  }

  require_once("footer.php");

?>
