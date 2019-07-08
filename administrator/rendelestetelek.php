<?php

  session_start();

  // Adatbázis csatlakozás
	require_once("../db-connect.php");

  $event = filter_input(INPUT_POST, "event", FILTER_SANITIZE_SPECIAL_CHARS);
  $rfid = filter_input(INPUT_POST, "rfid", FILTER_SANITIZE_SPECIAL_CHARS);
  settype($rfid, "integer");

  if ($event == "lekerdez" && isset($_SESSION["auid"])) {
		// rendelésszám lekérése
		$sql = "select rfrendelesszam, rfuid from rfej where rfid = $rfid";
		$tabla = mysqli_query($dbc, $sql);
		list($rendelesszam, $rfuid) = mysqli_fetch_row($tabla);
		// vevő lekérése
		$sql = "select nev, email, szla_nev, szla_irszam, szla_varos, szla_utcahaz, szall_nev, szall_irszam, szall_varos, szall_utcahaz, telefon from userek where uid = ".$rfuid;
		$tabla = mysqli_query($dbc, $sql);
		list($nev, $email, $szla_nev, $szla_irszam, $szla_varos, $szla_utcahaz, $szall_nev, $szall_irszam, $szall_varos, $szall_utcahaz, $telefon) = mysqli_fetch_row($tabla);
    $szla_cim = $szla_irszam." ".$szla_varos.", ".$szla_utcahaz;
    $szall_nev = $szall_nev != "" ? $szall_nev : $szla_nev;
    $szall_cim = $szall_irszam != "" ? $szall_irszam." ".$szall_varos.", ".$szall_utcahaz : $szla_cim;
		// tételek lekérése
		$sql = "select cnev, rtar as egysegar, rtmenny from rtetel, cikkek where rtetel.rtcid = cikkek.cid and rtrfid = $rfid";
		$tabla = mysqli_query($dbc, $sql);
		$osszAr = 0;
		$vissza = '
			<style>
				@media print {
					body * {
						visibility: hidden;
					}
					.modal-content, .modal-content * {
						visibility: visible;
					}
					.modal-content {
						position: absolute;
						left: 0px;
						top: 0px;
					}
					.close, .btn {
						visibility: hidden;
					}
				}
			</style>
			Rendelésszám: '.$rendelesszam.'×
			<h3>Általános adatok</h3>
			<p><b>Vevő neve: </b>'.$nev.'</p>
			<p><b>E-mail címe: </b>'.$email.'</p>
			<p><b>Telefonszáma: </b>'.$telefon.'</p>
			<h3>Számlázási adatok</h3>
			<p><b>Számlázási neve: </b>'.$szla_nev.'</p>
			<p><b>Számlázási címe: </b>'.$szla_cim.'</p>
			<h3>Szállítási adatok</h3>
			<p><b>Szállítási neve: </b>'.$szall_nev.'</p>
			<p><b>Szállítási címe: </b>'.$szall_cim.'</p>
			<h3>Tételek</h3>
			<table width="100%">
				<tr style="font-weight: bold;">
					<td>Cikk neve</td>
					<td class="text-right">Darab</td>
					<td class="text-right" style="min-width: 100px;">Tétel ára</td>
				</tr>
		';
		while ($rekord = mysqli_fetch_assoc($tabla)) {
			$vissza .= '
				<tr style="height: 30px;">
					<td>'.$rekord["cnev"].'</td>
					<td class="text-right">'.number_format($rekord["rtmenny"], 0, ",", " ").' db</td>
					<td class="text-right">'.number_format($rekord["egysegar"]*$rekord["rtmenny"], 0, ",", " ").' Ft</td>
				</tr>
			';
			$osszAr += $rekord["egysegar"]*$rekord["rtmenny"];
		}
		$vissza .= '
				<tr>
					<td colspan="3" class="text-right" style="border-top: double 3px black; height: 50px;">Összesen: '.number_format($osszAr, 0, ",", " ").' Ft</td>
				</tr>
			</table>
			<p class="text-right"><button class="btn btn-success" onclick="window.print()">Nyomtatás</button></p>
		';
		
  }

  print $vissza;

?>
