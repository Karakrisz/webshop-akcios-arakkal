<?php

  require_once("header.php");

  if (isset($_SESSION["auid"])) { // ha belépve

?>
    <div class="container">
      <h1 class="text-center">Rendelések</h1>
			<table width="100%">
				<tr style="font-weight: bold;">
					<td>Rendelésszám</td>
					<td>Dátum</td>
					<td>Fizetés</td>
					<td>Állapot</td>
					<td>&nbsp;</td>
				</tr>
<?php
				while ($rekord = mysqli_fetch_assoc($tabla)) {
					$allapot = $rekord["rfallapot"] == 0 ? "várakozik" : "kiszállítva";
					$ikon = $rekord["rfallapot"] == 0 ? "glyphicon-ok" : "glyphicon-time";
					$szin = $rekord["rfallapot"] == 0 ? "text-danger" : "";
?>
					<tr id="sor<?php print $rekord["rfid"]; ?>" class="<?php print $szin; ?>">
						<td><a class="btn btn-link" style="padding-left: 0px;" data-toggle="modal" data-target="#RendelesTetelekModal" onclick="RendelesTetelekLista(<?php print $rekord["rfid"]; ?>)"><?php print $rekord["rfrendelesszam"]; ?></a></td>
						<td><?php print $rekord["rfdatum"]; ?></td>
						<td><?php print $rekord["fnev"]; ?></td>
						<td id="allapotCella<?php print $rekord["rfid"]; ?>"><?php print $allapot; ?></td>
						<td><span id="ikon<?php print $rekord["rfid"]; ?>" onclick="ajaxRendelesAllapot(<?php print $rekord["rfid"]; ?>)" class="glyphicon <?php print $ikon; ?>"></span></td>
					</tr>
<?php
				}
?>
			</table>
		</div>
<?php

  }

  require_once("footer.php");

?>
