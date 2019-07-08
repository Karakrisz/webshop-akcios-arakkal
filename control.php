<?php

  session_start();

  function createEmailHeader() {
    $fejlec = "From: ".ADMIN_EMAIL."\r\n";
    $fejlec .= "Reply-To: ".ADMIN_EMAIL."\r\n";
    $fejlec .= "Mime-Version: 1.0\r\n";
    $fejlec .= "Content-type: text/html; charset=UTF-8\r\n";
    $fejlec .= "X-Priority: 1\r\n";
    $fejlec .= "X-Mailer: PHP/".phpversion()."\r\n";
    return $fejlec;
  }

  function kosarUres() {
    return !isset($_SESSION["kosar"]) || count($_SESSION["kosar"]) == 0;
  }

  // Adatbázis csatlakozás
	require_once("db-connect.php");

  // Eseménykezelés
  $pEvent = filter_input(INPUT_POST, "event", FILTER_SANITIZE_SPECIAL_CHARS);
  $gEvent = filter_input(INPUT_GET, "event", FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
  $jelszo = filter_input(INPUT_POST, "jelszo", FILTER_SANITIZE_SPECIAL_CHARS);
  $nev = filter_input(INPUT_POST, "nev", FILTER_SANITIZE_SPECIAL_CHARS);
  $jelszo1 = filter_input(INPUT_POST, "jelszo1", FILTER_SANITIZE_SPECIAL_CHARS);
  $jelszo2 = filter_input(INPUT_POST, "jelszo2", FILTER_SANITIZE_SPECIAL_CHARS);
  $uid = filter_input(INPUT_GET, "uid", FILTER_SANITIZE_SPECIAL_CHARS);
  settype($uid, "integer");
  $aid = filter_input(INPUT_GET, "aid", FILTER_SANITIZE_SPECIAL_CHARS);
  settype($aid, "integer");
  $reCaptcha = filter_input(INPUT_POST, "g-recaptcha-response", FILTER_SANITIZE_SPECIAL_CHARS);
  $telefon = filter_input(INPUT_POST, "telefon", FILTER_SANITIZE_SPECIAL_CHARS);
  $szla_nev = filter_input(INPUT_POST, "szla_nev", FILTER_SANITIZE_SPECIAL_CHARS);
  $szla_irszam = filter_input(INPUT_POST, "szla_irszam", FILTER_SANITIZE_SPECIAL_CHARS);
  $szla_varos = filter_input(INPUT_POST, "szla_varos", FILTER_SANITIZE_SPECIAL_CHARS);
  $szla_utcahaz = filter_input(INPUT_POST, "szla_utcahaz", FILTER_SANITIZE_SPECIAL_CHARS);
  $szall_nev = filter_input(INPUT_POST, "szall_nev", FILTER_SANITIZE_SPECIAL_CHARS);
  $szall_irszam = filter_input(INPUT_POST, "szall_irszam", FILTER_SANITIZE_SPECIAL_CHARS);
  $szall_varos = filter_input(INPUT_POST, "szall_varos", FILTER_SANITIZE_SPECIAL_CHARS);
  $szall_utcahaz = filter_input(INPUT_POST, "szall_utcahaz", FILTER_SANITIZE_SPECIAL_CHARS);
  $kid = filter_input(INPUT_GET, "kid", FILTER_SANITIZE_SPECIAL_CHARS);
  settype($kid, "integer");
  $fid = filter_input(INPUT_GET, "fid", FILTER_SANITIZE_SPECIAL_CHARS);
  settype($fid, "integer");

  if ($pEvent == "bejelentkezés") {
    $sql = "select uid, nev from userek where email = '$email' and jelszo = password('$jelszo') and aktiv = 1";
    $tabla = @mysqli_query($dbc, $sql);
    list($uid, $nev) = @mysqli_fetch_row($tabla);
    if (@mysqli_num_rows($tabla) == 1) { // Beléphet
      $_SESSION["uid"] = $uid;
      $_SESSION["nev"] = $nev;
      $_SESSION["email"] = $email;
      $datumido = date("Y.m.d H:i:s");
      $sql = "update userek set datum_utolso = '$datumido' where uid = $uid";
      mysqli_query($dbc, $sql);
      $uzenet = "Sikeres belépés!";
    } else { // Nem léphet be
      $uzenet = "Sikertelen belépés!";
    }
  } else

  if ($gEvent == "kilépés") {
    unset($_SESSION["uid"]);
    unset($_SESSION["nev"]);
    unset($_SESSION["email"]);
    $uzenet = "Sikeres kilépés!";
  } else

  if ($pEvent == "regisztráció") {
    if ($reCaptcha == null) {
      $uzenet = "Pipálni kell, hogy nem vagy robot!";
    } else
    if ($jelszo1 != $jelszo2) {
      $uzenet = "A két jelszónak meg kell egyeznie!";
    } else {
      $sql = "select count(*) as db from userek where email = '$email'";
      $tabla = mysqli_query($dbc, $sql);
      list($db) = mysqli_fetch_row($tabla);
      if ($db > 0) {
        $uzenet = "Ez az e-mail cím már regisztrálva van!<br>Adjon meg másik e-mail címet!";
      } else {
        $aid = rand(1000000, 9999999); // aktiváláshoz kell
        $sql = "insert into userek (email, nev, jelszo, aid, szla_nev, szla_irszam, szla_varos, szla_utcahaz, szall_nev, szall_irszam, szall_varos, szall_utcahaz, telefon) values ('$email', '$nev', password('$jelszo1'), $aid, '$szla_nev', '$szla_irszam', '$szla_varos', '$szla_utcahaz', '$szall_nev', '$szall_irszam', '$szall_varos', '$szall_utcahaz', '$telefon')";
        mysqli_query($dbc, $sql);
        $uid = mysqli_insert_id($dbc); // aktiváláshoz kell

        // Aktiváló e-mail küldése
        $targy = "=?UTF-8?B?".base64_encode("Regisztráció aktiválása")."?=";
        $fejlec = createEmailHeader();
        $szoveg = '<p>Kedves '.$nev.'!</p>';
        $szoveg .= '<p>Regisztrációja aktiválásához kattintson <a href="'.DOMAIN.'aktivalas.php?uid='.$uid.'&aid='.$aid.'">ide</a>!</p>';

        mail($email, $targy, $szoveg, $fejlec);

        $uzenet = "Regisztráció sikeres, már csak aktiválni kell!<br>A megadott e-mail címre elküldtük az aktiváló linket, kérjük ellenőrizze postafiókját!";
      }
    }
  } else

  if ($uid != null && $aid != null) { // aktiválás
    $sql = "update userek set aktiv = 1 where uid = $uid and aid = $aid";
    mysqli_query($dbc, $sql);
    $uzenet = "Regisztrációja aktiválása sikeres!<br>Bejelentkezhet a képernyő jobb felső részen.";
  }

  if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "adataim" || pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "szumma") {
    if (isset($_SESSION["uid"])) { // be van jelentkezve
      if ($pEvent == "adatlap_mod") { // adatlap mentése...
        if ($jelszo1 != $jelszo2) {
          $uzenet = "A két jelszónak meg kell egyeznie!";
        } else { // ...ha a két jelszó megegyezik
          $sql = "select count(*) as db from userek where email = '$email' and uid <> ".$_SESSION["uid"];
          $tabla = mysqli_query($dbc, $sql);
          list($db) = mysqli_fetch_row($tabla);
          if ($db > 0) {
            $uzenet = "Ez az e-mail cím már foglalt!<br>Adjon meg másik e-mail címet!";
          } else {
            $sql = "update userek set nev = '$nev', email = '$email', jelszo = password('$jelszo1'), szla_nev = '$szla_nev', szla_irszam = '$szla_irszam', szla_varos = '$szla_varos', szla_utcahaz = '$szla_utcahaz', szall_nev = '$szall_nev', szall_irszam = '$szall_irszam', szall_varos = '$szall_varos', szall_utcahaz = '$szall_utcahaz', telefon = '$telefon' where uid = ".$_SESSION["uid"];
            mysqli_query($dbc, $sql);
            $_SESSION["nev"] = $nev;
            $_SESSION["email"] = $email;
            $uzenet = "Adatok módosítása sikeres!";
          }
        }
      } else { // megjelenítéshez lekérdezni a tárolt adatokat
        $sql = "select nev, email, szla_nev, szla_irszam, szla_varos, szla_utcahaz, szall_nev, szall_irszam, szall_varos, szall_utcahaz, telefon from userek where uid = ".$_SESSION["uid"];
        $tabla = mysqli_query($dbc, $sql);
        list($nev, $email, $szla_nev, $szla_irszam, $szla_varos, $szla_utcahaz, $szall_nev, $szall_irszam, $szall_varos, $szall_utcahaz, $telefon) = mysqli_fetch_row($tabla);
      }
    } else {
      $uzenet = "Adatlap eléréséhez be kell jelentkezni!";
    }
  }

  if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "index") {
    // kategória neve
    $sql = "select knev from cikkat where kid = $kid";
    $tabla = mysqli_query($dbc, $sql);
    list($knev) = mysqli_fetch_row($tabla);
    // kategóriák
    $sql = "select kid, knev from cikkat where kid > 0 and szkid = $kid and aktiv = 1 order by knev";
    $kattabla = mysqli_query($dbc, $sql);
    // cikkek
    $sql = "select cid, cnev, cszam, car, akciosar, akcios, cinfo from cikkek where ckid = $kid and aktiv = 1 order by cnev";
    $tabla = mysqli_query($dbc, $sql);
    // Legtöbbször vásárolt cikkek Top3
    $sql = "select cid, cszam, cnev, car, akciosar, akcios, cinfo, count(*) as db
            from rtetel, cikkek
            where cid = rtcid and cid > 0
            group by cid
            order by db desc
            limit 0, 3";
    $top3tabla = mysqli_query($dbc, $sql);
  }

  if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "fizmod") {
    if (kosarUres()) {
      $uzenet = 'Az Ön kosara jelenleg üres. <a href="index.php">Irány a webshop!</a>';
    } else
    if (isset($_SESSION["uid"])) { // ha be van jelentkezve
      $sql = "select fid, fnev, leiras, felar from fizmodok where aktiv = 1 order by fid";
      $fiztabla = mysqli_query($dbc, $sql);
    }
  }

  if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "szumma") {
    if (!isset($_SESSION["uid"])) { // nincs belépve
      $uzenet = "A rendelés ellenőrzése eléréséhez be kell jelentkezni!";
    } else
    if (kosarUres()) {
      $uzenet = 'Az Ön kosara jelenleg üres. <a href="index.php">Irány a webshop!</a>';
    } else
    if ($fid == 0) { // nincs fizetésmód választva
      $uzenet = 'Nincs fizetésmód választva. <a href="fizmod.php">Irány a fizetésmód kiválasztása!</a>';
    } else { 
      // kiválasztott fizetésmód lekérdezése
      $sql = "select fid, fnev, leiras, felar from fizmodok where aktiv = 1 and fid = $fid";
      $fiztabla = mysqli_query($dbc, $sql);
      list($fid, $fnev, $leiras, $felar) = mysqli_fetch_row($fiztabla);
			if (mysqli_num_rows($fiztabla) > 0) {
				$_SESSION["fid"] = $fid;
				$_SESSION["fnev"] = $fnev;
				$_SESSION["felar"] = $felar;
			}
    }
  }

  if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "megrendeles") {
    if (kosarUres()) {
      $uzenet = 'Az Ön kosara jelenleg üres. <a href="index.php">Irány a webshop!</a>';
    } else
    if (!isset($_SESSION["uid"])) { 
      $uzenet = "A rendelés elküldéséhez be kell jelentkezni!";
    } else {
      $sql = "insert into rfej (rfuid, rffid) values (".$_SESSION["uid"].", ".$_SESSION["fid"].")";
      mysqli_query($dbc, $sql);
      $rfid = mysqli_insert_id($dbc);
      // rendelésszám készítése $rfid-ból
      $sRendelesszam = $rfid;
      settype($sRendelesszam, "string");
      while (strlen($sRendelesszam) < 7) {
        $sRendelesszam = "0".$sRendelesszam;
      }
      $sRendelesszam .= "/".date("Y");
      $sql = "update rfej set rfrendelesszam = '$sRendelesszam' where rfid = ".$rfid;
      mysqli_query($dbc, $sql);
      $_SESSION["rendelesszam"] = $sRendelesszam; // rendelésszámot meg kell majd jeleníteni a megrendeles.php-ban
      // tételek mentése
      foreach ($_SESSION["kosar"] as $tetel) {
        $sql = "insert into rtetel (rtrfid, rtcid, rtar, rtmenny) values ($rfid, ".$tetel[0].", ".$tetel[3].", ".$tetel[1].")";
        mysqli_query($dbc, $sql);
      }
			// hozzáírni a feláras szállítási díjat
			if (isset($_SESSION["felar"]) && $_SESSION["felar"] > 0) {
				$sql = "insert into rtetel (rtrfid, rtcid, rtar, rtmenny) values ($rfid, 0, ".$_SESSION["felar"].", 1)";
				mysqli_query($dbc, $sql);
			}
      // visszaigazoló e-mail küldése
      $targy = "=?UTF-8?B?".base64_encode("Megrendelés visszaigazolása")."?=";
      $fejlec = createEmailHeader();

      $osszAr = 0;
      $szoveg = '
        <h2>Kedves '.$_SESSION["nev"].'!</h2>
        <p>Köszönjük megrendelését!</p>
        <h3>Rendelésszám: '.$_SESSION["rendelesszam"].'</h3>
        <p>Ön az alábbi tételeket rendelte meg:</p>
        <table width="100%">
          <tr style="font-weight: bold;">
            <td>Cikk neve</td>
            <td style="text-align: right;">Egységár</td>
            <td style="text-align: right;">Darab</td>
            <td style="min-width: 40px;">&nbsp;</td>
            <td style="text-align: right;" width="100">Tétel ára</td>
          </tr>
      ';
      foreach ($_SESSION["kosar"] as $tetel) { // 0. cid, 1. menny, 2. cnev, 3. ar
        $szoveg .= '
          <tr>
            <td style="border-top: solid 1px silver; height: 50px;">'.$tetel[2].'</td>
            <td style="border-top: solid 1px silver; text-align: right;">'.number_format($tetel[3], 0, ",", " ").' Ft</td>
            <td style="border-top: solid 1px silver; text-align: right;">'.$tetel[1].'</td>
            <td style="border-top: solid 1px silver;">&nbsp;</td>
            <td style="border-top: solid 1px silver; text-align: right;">'.number_format($tetel[1]*$tetel[3], 0, ",", " ").' Ft</td>
          </tr>
        ';
        $osszAr += $tetel[1]*$tetel[3];
      }
      // szállítási költség hozzáírása, ha van felár
      if (isset($_SESSION["felar"]) && $_SESSION["felar"] > 0) {
        $szoveg .= '
            <tr>
              <td style="border-top: solid 1px silver; height: 50px;">Fizetésmód: '.$_SESSION["fnev"].'</td>
              <td style="border-top: solid 1px silver; text-align: right;">'.number_format($_SESSION["felar"], 0, ",", " ").' Ft</td>
              <td style="border-top: solid 1px silver; text-align: right;">1</td>
              <td style="border-top: solid 1px silver;">&nbsp;</td>
              <td style="border-top: solid 1px silver; text-align: right;">'.number_format($_SESSION["felar"], 0, ",", " ").' Ft</td>
            </tr>
        ';
        $osszAr += $_SESSION["felar"];
      }
      $szoveg .= '
          <tr>
            <td colspan="5" style="border-top: double 3px silver; height: 50px; text-align: right; color: green;">Összesen: '.number_format($osszAr, 0, ",", " ").' Ft</td>
          </tr>
        </table>
      ';

      mail($_SESSION["email"], $targy, $szoveg, $fejlec);

      // kosár ürítése, fizetésmód eldobása
      unset($_SESSION["kosar"]);
      unset($_SESSION["fid"]);
      unset($_SESSION["fnev"]);
      unset($_SESSION["felar"]);

      $uzenet = "Rendelés feldolgozása sikeres!";
    }
  }

?>
