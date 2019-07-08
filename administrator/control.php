<?php

session_start();

require_once("kepfeltoltes.php");

function createEmailHeader($emailFrom) {
    $fejlec = "From: $emailFrom\r\n";
    $fejlec .= "Reply-To: $emailFrom\r\n";
    $fejlec .= "Mime-Version: 1.0\r\n";
    $fejlec .= "Content-type: text/html; charset=UTF-8\r\n";
    $fejlec .= "X-Priority: 1\r\n";
    $fejlec .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    return $fejlec;
}

// Adatbázis csatlakozás
require_once("../db-connect.php");

// Eseménykezelés
$pEvent = filter_input(INPUT_POST, "event", FILTER_SANITIZE_SPECIAL_CHARS);
$gEvent = filter_input(INPUT_GET, "event", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
$jelszo = filter_input(INPUT_POST, "jelszo", FILTER_SANITIZE_SPECIAL_CHARS);
$nev = filter_input(INPUT_POST, "nev", FILTER_SANITIZE_SPECIAL_CHARS);
$jelszo1 = filter_input(INPUT_POST, "jelszo1", FILTER_SANITIZE_SPECIAL_CHARS);
$jelszo2 = filter_input(INPUT_POST, "jelszo2", FILTER_SANITIZE_SPECIAL_CHARS);
$auid = filter_input(INPUT_GET, "auid", FILTER_SANITIZE_SPECIAL_CHARS);
settype($auid, "integer");
$pauid = filter_input(INPUT_POST, "auid", FILTER_SANITIZE_SPECIAL_CHARS);
settype($pauid, "integer");
$kid = filter_input(INPUT_GET, "kid", FILTER_SANITIZE_SPECIAL_CHARS);
settype($kid, "integer");
$kat = filter_input(INPUT_POST, "kid", FILTER_SANITIZE_SPECIAL_CHARS);
settype($kat, "integer");
$cid = filter_input(INPUT_GET, "cid", FILTER_SANITIZE_SPECIAL_CHARS);
settype($cid, "integer");
$fid = filter_input(INPUT_GET, "fid", FILTER_SANITIZE_SPECIAL_CHARS); // a fizetésmód módosító űrlaphoz kell
settype($fid, "integer");
$fizid = filter_input(INPUT_POST, "fid", FILTER_SANITIZE_SPECIAL_CHARS); // ez csak a fizetésmód módosítás mentéséhez kell
settype($fizid, "integer");
$knev = filter_input(INPUT_POST, "knev", FILTER_SANITIZE_SPECIAL_CHARS);
$szkid = filter_input(INPUT_POST, "szkid", FILTER_SANITIZE_SPECIAL_CHARS);
$aktiv = filter_input(INPUT_POST, "aktiv", FILTER_SANITIZE_SPECIAL_CHARS);
settype($aktiv, "integer");
$cszam = filter_input(INPUT_POST, "cszam", FILTER_SANITIZE_SPECIAL_CHARS);
$cnev = filter_input(INPUT_POST, "cnev", FILTER_SANITIZE_SPECIAL_CHARS);
$car = filter_input(INPUT_POST, "car", FILTER_SANITIZE_SPECIAL_CHARS);
settype($car, "integer");
$akciosar = filter_input(INPUT_POST, "akciosar", FILTER_SANITIZE_SPECIAL_CHARS);
settype($akciosar, "integer");
$akcios = filter_input(INPUT_POST, "akcios", FILTER_SANITIZE_SPECIAL_CHARS);
settype($akcios, "integer");
$cinfo = filter_input(INPUT_POST, "cinfo", FILTER_SANITIZE_SPECIAL_CHARS);
$fnev = filter_input(INPUT_POST, "fnev", FILTER_SANITIZE_SPECIAL_CHARS);
$leiras = filter_input(INPUT_POST, "leiras", FILTER_SANITIZE_SPECIAL_CHARS);
$felar = filter_input(INPUT_POST, "felar", FILTER_SANITIZE_SPECIAL_CHARS);
settype($felar, "integer");
$rfid = filter_input(INPUT_POST, "rfid", FILTER_SANITIZE_SPECIAL_CHARS);
settype($rfid, "integer");

if ($pEvent == "bejelentkezés") {
    $sql = "select auid, nev from admin_userek where email = '$email' and jelszo = password('$jelszo') and aktiv = 1";
    $tabla = @mysqli_query($dbc, $sql);
    list($auid, $nev) = @mysqli_fetch_row($tabla);
    if (@mysqli_num_rows($tabla) == 1) { // Beléphet
        $_SESSION["auid"] = $auid;
        $_SESSION["nev"] = $nev;
        $_SESSION["email"] = $email;
        $uzenet = "Sikeres belépés!";
    } else { // Nem léphet be
        $uzenet = "Sikertelen belépés!";
    }
} else

if ($gEvent == "kilépés") {
    unset($_SESSION["auid"]);
    unset($_SESSION["nev"]);
    unset($_SESSION["email"]);
    $uzenet = "Sikeres kilépés!";
}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "adataim") {
    if (isset($_SESSION["auid"])) {
        if ($pEvent == "adatlap_mod") { // adatlap mentése...
            if ($jelszo1 != $jelszo2) {
                $uzenet = "A két jelszónak meg kell egyeznie!";
            } else { // ...ha a két jelszó megegyezik
                $sql = "select count(*) as db from admin_userek where email = '$email' and auid <> " . $_SESSION["auid"];
                $tabla = mysqli_query($dbc, $sql);
                list($db) = mysqli_fetch_row($tabla);
                if ($db > 0) {
                    $uzenet = "Ez az e-mail cím már foglalt!<br>Adjon meg másik e-mail címet!";
                } else {
                    $sql = "update admin_userek set nev = '$nev', email = '$email', jelszo = password('$jelszo1') where auid = " . $_SESSION["auid"];
                    mysqli_query($dbc, $sql);
                    $_SESSION["nev"] = $nev;
                    $_SESSION["email"] = $email;
                    $uzenet = "Adatok módosítása sikeres!";
                }
            }
        }
    } else {
        $uzenet = "Adatlap eléréséhez be kell jelentkezni!";
    }
}

// ----------------------
// ----- Rendelések -----
// ----------------------

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "index") {
    if (isset($_SESSION["auid"])) {
        $sql = "select rfid, rfrendelesszam, substring(rfdatum, 6, 5) as rfdatum, fnev, rfallapot from rfej, fizmodok where rfej.rffid = fizmodok.fid order by rfid desc";
        $tabla = mysqli_query($dbc, $sql);
    }
}

if ($pEvent == "rAllapotValtozas") {
    $sql = "select rfallapot from rfej where rfid = $rfid";
    $tabla = mysqli_query($dbc, $sql);
    list($allapot) = mysqli_fetch_row($tabla);
    $allapot = $allapot == 0 ? 1 : 0;
    $sql = "update rfej set rfallapot = $allapot where rfid = $rfid";
    mysqli_query($dbc, $sql);
    print $allapot;
}

// ----------------------
// ----- Kategóriák -----
// ----------------------

if ($pEvent == "kategoriak_uj_mentes") {
    $sql = "insert into cikkat (knev, szkid, aktiv) values ('$knev', $szkid, $aktiv)";
    if (mysqli_query($dbc, $sql)) {
        $kepid = mysqli_insert_id($dbc);
        kepfeltoltes(CIKKAT_IMG_DIR, $kepid);
        $uzenet = "Kategória létrehozása sikeres!";
    } else {
        $uzenet = "Kategória létrehozása sikertelen!<br>Ez a kategória már létre van hozva.";
    }
}

if ($pEvent == "kategoriak_mod_mentes") {
    $sql = "update cikkat set knev = '$knev', szkid = $szkid, aktiv = $aktiv where kid = $kat";
    if (mysqli_query($dbc, $sql)) {
        kepfeltoltes(CIKKAT_IMG_DIR, $kat);
        $uzenet = "Kategória módosítása sikeres!";
    } else {
        $uzenet = "Kategória módosítása sikertelen!";
    }
}

if (isset($_SESSION["auid"])) {
    if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "kategoriak_uj" || pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "kategoriak_mod" || pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "cikkek_uj" || pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "cikkek_mod") {
        // választólistához összes kategória lekérdezése
        $sql = "select kid, knev, szkid, aktiv from cikkat order by knev";
        $kattabla = mysqli_query($dbc, $sql);
    }

    if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "kategoriak_uj") {
        $kep = CIKKAT_IMG_DIR . "/nincskep.png";
    } else

    if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "kategoriak_mod") {
        // módosítandó kategória lekérdezése
        $sql = "select kid, knev, szkid, aktiv from cikkat where kid = $kid";
        $tabla = mysqli_query($dbc, $sql);
        list($kid, $knev, $szkid, $aktiv) = mysqli_fetch_row($tabla);
        $kep = is_file(CIKKAT_IMG_DIR . "/kozepes_$kid.jpg") ? CIKKAT_IMG_DIR . "/kozepes_$kid.jpg?d=" . strtotime("now") : CIKKAT_IMG_DIR . "/nincskep.png";
    } else

    if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "cikkek_uj") {
        $kep = CIKKEK_IMG_DIR . "/nincskep.png";
    } else

    if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "cikkek_mod") {
        // módosítandó cikk lekérdezése
        $sql = "select cid, cszam, cnev, ckid, car, akciosar, akcios, cinfo, aktiv from cikkek where cid = $cid";
        $tabla = mysqli_query($dbc, $sql);
        list($cid, $cszam, $cnev, $ckid, $car, $akciosar, $akcios, $cinfo, $aktiv) = mysqli_fetch_row($tabla);
        $kep = is_file(CIKKEK_IMG_DIR . "/kozepes_$cid.jpg") ? CIKKEK_IMG_DIR . "/kozepes_$cid.jpg?d=" . strtotime("now") : CIKKEK_IMG_DIR . "/nincskep.png";
    }
}

// ------------------
// ----- Cikkek -----
// ------------------

if ($pEvent == "cikkek_uj_mentes") {
    if ($akciosar >= $car) {
        $uzenet = "Az akci�s �rnak kisebbnek kell lennie, mint az eredeti elad�si �r!";
    } else {
        $sql = "insert into cikkek (cszam, cnev, ckid, car, akciosar, akcios, cinfo, aktiv) values ('$cszam', '$cnev', $szkid, $car, $akciosar, $akcios '$cinfo', $aktiv)";
        if (mysqli_query($dbc, $sql)) {
            $kepid = mysqli_insert_id($dbc);
            kepfeltoltes(CIKKEK_IMG_DIR, $kepid);
            $uzenet = "Cikk létrehozása sikeres!";
        } else {
            $uzenet = "Cikk létrehozása sikertelen!<br>Ez a cikk már létre van hozva.";
        }
    }
}

if ($pEvent == "cikkek_mod_mentes") {
    if ($akciosar >= $car) {
        $uzenet = "Az akci�s �rnak kisebbnek kell lennie, mint az eredeti elad�si �r!";
    } else {
        $sql = "update cikkek set cszam = '$cszam', cnev = '$cnev', ckid = $szkid, car = $car, akciosar = $akciosar, akcios = $akcios, cinfo = '$cinfo', aktiv = $aktiv where cid = $cid";
        if (mysqli_query($dbc, $sql)) {
            kepfeltoltes(CIKKEK_IMG_DIR, $cid);
            $uzenet = "Cikk módosítása sikeres!";
        } else {
            $uzenet = "Cikk módosítása sikertelen!";
        }
    }
}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "cikkek") {
    if (isset($_SESSION["auid"])) {
        // kategória neve
        $sql = "select knev from cikkat where kid = $kid";
        $tabla = mysqli_query($dbc, $sql);
        list($knev) = mysqli_fetch_row($tabla);
        // kategóriák
        $sql = "select kid, knev, szkid, aktiv from cikkat where kid > 0 and szkid = $kid order by knev";
        $kattabla = mysqli_query($dbc, $sql);
        // cikkek
        $sql = "select cid, cnev, cszam, car, akciosar, akcios, cinfo, aktiv from cikkek where ckid = $kid order by cnev";
        $tabla = mysqli_query($dbc, $sql);
    } else {
        $uzenet = "Kategóriák és cikkek eléréséhez be kell jelentkezni!";
    }
}

// --------------------
// ----- Fizmódok -----
// --------------------

if ($pEvent == "fizmodok_uj_mentes") {
    $sql = "insert into fizmodok (fnev, leiras, felar, aktiv) values ('$fnev', '$leiras', $felar, $aktiv)";
    if (mysqli_query($dbc, $sql)) {
        $uzenet = "Fizetésmód létrehozása sikeres!";
    } else {
        $uzenet = "Fizetésmód létrehozása sikertelen!<br>Ez a fizetésmód már létre van hozva.";
    }
}

if ($pEvent == "fizmodok_mod_mentes") {
    $sql = "update fizmodok set fnev = '$fnev', leiras = '$leiras', felar = $felar, aktiv = $aktiv where fid = $fizid";
    if (mysqli_query($dbc, $sql)) {
        $uzenet = "Fizetésmód módosítása sikeres!";
    } else {
        $uzenet = "Fizetésmód módosítása sikertelen!<br>Ez a fizetésmód már létre van hozva.";
    }
}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "fizmodok_mod") {
    if (isset($_SESSION["auid"])) {
        $sql = "select fid, fnev, leiras, felar, aktiv from fizmodok where fid = $fid";
        $tabla = mysqli_query($dbc, $sql);
        list($fid, $fnev, $leiras, $felar, $aktiv) = mysqli_fetch_row($tabla);
    }
}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "fizmodok") {
    if (isset($_SESSION["auid"])) {
        $sql = "select fid, fnev, leiras, felar, aktiv from fizmodok order by fid";
        $tabla = mysqli_query($dbc, $sql);
    } else {
        $uzenet = "Fizetésmódok eléréséhez be kell jelentkezni!";
    }
}

// -------------------
// ----- Adminok -----
// -------------------

if ($pEvent == "adminok_uj_mentes") {
    // új jelszó generálása
    define("KISBETUK", "abcdefghijklmnopqrstuvwxyz");
    define("NAGYBETUK", "ABCDEFGHIJKLMNOPQRSTUVWXYZ");
    define("SZAMOK", "0123456789");
    $jelszo = "";
    $maszk = "Aa00aA";
    for ($i = 0; $i < strlen($maszk); $i++) {
        if (substr($maszk, $i, 1) == "A") {
            $jelszo .= substr(NAGYBETUK, rand(0, strlen(NAGYBETUK) - 1), 1);
        } else
        if (substr($maszk, $i, 1) == "a") {
            $jelszo .= substr(KISBETUK, rand(0, strlen(KISBETUK) - 1), 1);
        } else
        if (substr($maszk, $i, 1) == "0") {
            $jelszo .= substr(SZAMOK, rand(0, strlen(SZAMOK) - 1), 1);
        }
    }
    $sql = "insert into admin_userek (nev, email, jelszo, aktiv) values ('$nev', '$email', password('$jelszo'), $aktiv)";
    if (mysqli_query($dbc, $sql)) {
        // Értesítő e-mail küldése
        $targy = "=?UTF-8?B?" . base64_encode("Adminisztrátor lettél!") . "?=";
        $fejlec = createEmailHeader(ADMIN_EMAIL);
        $szoveg = '<p>Kedves ' . $nev . '!</p>';
        $szoveg .= '<p>Jelszavad: <b>' . $jelszo . '</b></p>';

        mail($email, $targy, $szoveg, $fejlec);

        $uzenet = "Adminisztrátor létrehozása sikeres!";
    } else {
        $uzenet = "Adminisztrátor létrehozása sikertelen!<br>Ez az e-mail cím már regisztrálva van.";
    }
}

if ($pEvent == "adminok_mod_mentes") {
    if ($pauid == 1) {
        $aktiv = 1;
    }
    $sql = "update admin_userek set nev = '$nev', email = '$email', aktiv = $aktiv where auid = $pauid";
    if (mysqli_query($dbc, $sql)) {
        $uzenet = "Adminisztrátor módosítása sikeres!";
    } else {
        $uzenet = "Adminisztrátor módosítása sikertelen!";
    }
}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "adminok_mod") {
    if (isset($_SESSION["auid"]) && $_SESSION["auid"] == 1) {
        // módosítandó admin lekérdezése
        $sql = "select auid, nev, email, aktiv from admin_userek where auid = $auid";
        $tabla = mysqli_query($dbc, $sql);
        list($auid, $nev, $email, $aktiv) = mysqli_fetch_row($tabla);
    } else {
        $uzenet = "Adminisztrátor módosításhoz főadminként kell belépni!";
    }
}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "adminok") {
    if (isset($_SESSION["auid"])) {
        $sql = "select auid, nev, email, aktiv from admin_userek order by nev";
        $tabla = mysqli_query($dbc, $sql);
    } else {
        $uzenet = "Adminisztrátorok eléréséhez be kell jelentkezni!";
    }
}
?>
