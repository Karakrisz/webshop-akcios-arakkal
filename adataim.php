<?php

  require_once("header.php");

  if (isset($_SESSION["uid"])) { // ha belépve

?>

  <div class="container">
    <h1 class="text-center">Adataim</h1>
    <form class="col-sm-6 col-sm-push-3" action="" method="post">
			<div class="form-group">
        <label for="nev">Név:</label>
				<input type="text" class="form-control" name="nev" id="nev" placeholder="Név" value="<?php print $nev; ?>" required>
			</div>
			<div class="form-group">
        <label for="email">E-mail:</label>
				<input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="<?php print $email; ?>" required>
			</div>
			<div class="form-group">
        <label for="jelszo1">Jelszó:</label>
				<input type="password" class="form-control" name="jelszo1" id="jelszo1" placeholder="Jelszó" value="<?php print $jelszo1; ?>" required>
			</div>
			<div class="form-group">
        <label for="jelszo2">Jelszó ismét:</label>
				<input type="password" class="form-control" name="jelszo2" id="jelszo2" placeholder="Jelszó ismét" value="<?php print $jelszo2; ?>" required>
			</div>
			<div class="form-group">
        <label for="telefon">Telefonszám:</label>
				<input type="text" class="form-control" name="telefon" id="telefon" placeholder="Telefonszám" value="<?php print $telefon; ?>" required>
			</div>

      <h3>Számlázási cím</h3>
			<div class="form-group">
        <label for="szla_nev">Számázási név / cégnév:</label>
				<input type="text" class="form-control" name="szla_nev" id="szla_nev" placeholder="Számázási név / cégnév" value="<?php print $szla_nev; ?>" required>
			</div>
			<div class="form-group col-md-3" style="padding: 0px;">
        <label for="szla_irszam">Irányítószám:</label>
				<input type="text" class="form-control" name="szla_irszam" id="szla_irszam" placeholder="Irányítószám" value="<?php print $szla_irszam; ?>" required>
			</div>
			<div class="form-group col-md-8 col-md-push-1" style="padding: 0px;">
        <label for="szla_varos">Település:</label>
				<input type="text" class="form-control" name="szla_varos" id="szla_varos" placeholder="Település" value="<?php print $szla_varos; ?>" required>
			</div>
			<div class="form-group">
        <label for="szla_utcahaz">Közterület és házszám:</label>
				<input type="text" class="form-control" name="szla_utcahaz" id="szla_utcahaz" placeholder="Közterület és házszám" value="<?php print $szla_utcahaz; ?>" required>
			</div>

      <h3>Szállítási cím</h3>
      <p>Csak akkor kell kitölteni, ha különbözik a számlázási címtől.</p>
			<div class="form-group">
        <label for="szall_nev">Szállítási név / cégnév:</label>
				<input type="text" class="form-control" name="szall_nev" id="szall_nev" placeholder="Szállítási név / cégnév" value="<?php print $szall_nev; ?>">
			</div>
			<div class="form-group col-md-3" style="padding: 0px;">
        <label for="szall_irszam">Irányítószám:</label>
				<input type="text" class="form-control" name="szall_irszam" id="szall_irszam" placeholder="Irányítószám" value="<?php print $szall_irszam; ?>">
			</div>
			<div class="form-group col-md-8 col-md-push-1" style="padding: 0px;">
        <label for="szall_varos">Település:</label>
				<input type="text" class="form-control" name="szall_varos" id="szall_varos" placeholder="Település" value="<?php print $szall_varos; ?>">
			</div>
			<div class="form-group">
        <label for="szall_utcahaz">Közterület és házszám:</label>
				<input type="text" class="form-control" name="szall_utcahaz" id="szall_utcahaz" placeholder="Közterület és házszám" value="<?php print $szall_utcahaz; ?>">
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
