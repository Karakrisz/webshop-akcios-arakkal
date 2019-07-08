<?php

  session_start();
  
  require_once 'db-connect.php';

  function kosarUres() {
    return !isset($_SESSION["kosar"]) || count($_SESSION["kosar"]) == 0;
  }

  $event = htmlspecialchars(filter_input(INPUT_POST, "event"));
  $adat = htmlspecialchars(filter_input(INPUT_POST, "adat"));
  $adat = explode("×", $adat); // cid × mennyiseg
  settype($adat[1], "integer");

  if ($event == "kosárba") {
    if ($adat[1] > 0) {
      // lekérdezzük az adatbázisban lévő árat
      $sql = "select cnev, car, akciosar, akcios from cikkek where cid = ".$adat[0];
      $table = mysqli_query($dbc, $sql);
      list($adat[2], $car, $akciosar, $akcios) = mysqli_fetch_row($table);
      $adat[3] = $akcios == 1 ? $akciosar : $car;
      // ha van már a kosárban a hozzáadni kívánt cikk, akkor csak a mennyiséget kell módosítani
      $van = false;
      if (!kosarUres()) {
        foreach ($_SESSION["kosar"] as $i => $tetel) {
          if ($_SESSION["kosar"][$i][0] == $adat[0]) {
            $_SESSION["kosar"][$i][1] += $adat[1];
            $van = true;
          }
        }
      }
      // ha nincs még a kosárban, akkor hozzáadni
      if (!$van) {
        $_SESSION["kosar"][] = $adat;
      }
      $vissza = "Kosárba helyezve ".$adat[1]." db cikk!";
    } else {
      $vissza = "Nem került cikk a kosárba!";
    }
  } else
  
  if ($event == "lista" || $event == "szummaLista") {
    // összeállítani a kosár táblázatát + új tétel mennyiségét
    $osszMennyiseg = 0;
    if (!kosarUres()) {
      $osszAr = 0;
      $vissza = '
        <table width="100%">
          <tr style="font-weight: bold;">
            <td>Cikk neve</td>
            <td class="text-right">Darab</td>
            <td style="min-width: 40px;"></td>
            <td class="text-right" width="100">Tétel ára</td>
          </tr>
      ';
      foreach ($_SESSION["kosar"] as $tetel) {
        $vissza .= '
            <tr style="border-top: solid 1px silver;">
              <td style="height: 50px;">'.$tetel[2].'</td>
              <td class="text-right">'.$tetel[1].'</td>
              <td>&nbsp;<a onclick="kosarMod('.$tetel[0].', 1)" style="cursor: pointer;"><span class="glyphicon glyphicon-plus-sign text-success"></span></a>  <a onclick="kosarMod('.$tetel[0].', -1)" style="cursor: pointer;"><span class="glyphicon glyphicon-minus-sign text-danger"></span></a></td>
              <td class="text-right">'.number_format($tetel[1]*$tetel[3], 0, ",", " ").' Ft</td>
            </tr>
        ';
        $osszAr += $tetel[1]*$tetel[3];
        $osszMennyiseg += $tetel[1];
      }
      // szállítási költség hozzáírása, ha van felár
      if (isset($_SESSION["felar"]) && $_SESSION["felar"] > 0) {
        $vissza .= '
            <tr style="border-top: solid 1px silver;">
              <td style="height: 50px;">Fizetésmód: '.$_SESSION["fnev"].'</td>
              <td class="text-right">1</td>
              <td>&nbsp;</td>
              <td class="text-right">'.number_format($_SESSION["felar"], 0, ",", " ").' Ft</td>
            </tr>
        ';
        $osszAr += $_SESSION["felar"];
      }
      $gomb =  $event != "szummaLista" ? '<a class="btn btn-warning" href="fizmod.php">Tovább a vásárláshoz</a>' : '<a class="btn btn-lg btn-success" href="megrendeles.php">Megrendelés elküldése</a>';
      $vissza .= '
          <tr>
            <td colspan="4" class="text-right text-success" style="border-top: double 3px silver; height: 50px;">Összesen: '.number_format($osszAr, 0, ",", " ").' Ft</td>
          </tr>
          <tr>
            <td colspan="4" class="text-right" style="height: 50px;">'.$gomb.'</td>
          </tr>
        </table>
      ';
      $vissza .= '×'.$osszMennyiseg.'×'.$osszAr;
    } else { // ha üres a kosár
      $vissza = '<p class="text-center">Az Ön kosara jelenleg üres.</p>×'.$osszMennyiseg;
    }
  } else

  if ($event == "kosárMod") {
    // mennyiség módosítása eggyel
    if (!kosarUres()) {
      foreach ($_SESSION["kosar"] as $i => $tetel) {
        if ($_SESSION["kosar"][$i][0] == $adat[0]) {
          $_SESSION["kosar"][$i][1] += $adat[1];
          if ($_SESSION["kosar"][$i][1] == 0) {
            unset($_SESSION["kosar"][$i]);
          }
        }
      }
    }
    $vissza = "";
  }

  print $vissza;

?>
