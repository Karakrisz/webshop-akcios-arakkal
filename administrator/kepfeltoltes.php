<?php

  function kepkeszites($path, $filename, $width, $height) {
    $elotag = $width <= 150 ? "kicsi_" : ($width <= 400 ? "kozepes_" : "nagy_");
    list($widthOriginal, $heightOriginal) = getimagesize($path."/".$filename);
    if ($widthOriginal < $heightOriginal) { // álló kép
      $width = $widthOriginal * $height / $heightOriginal;
    } else { // fekvő kép
      $height = $heightOriginal * $width / $widthOriginal;
    }
    // kép feltöltése memóriába
    $kep = imagecreatefromjpeg($path."/".$filename);
    // üres kép létrehozása memóriába
    $uresKep = imagecreatetruecolor($width, $height);
    // másolás átméretezéssel
    imagecopyresized($uresKep, $kep, 0, 0, 0, 0, $width, $height, $widthOriginal, $heightOriginal);
    // mentés fájlba
    imagejpeg($uresKep, $path."/".$elotag.$filename, 90);
  }

  function kepfeltoltes($path, $kepid) {
    $filename = $kepid.".jpg";
    if ($_FILES["upload"]["size"] > 0) { // ha van feltöltendő fájl
      if (($_FILES["upload"]["type"] == "image/jpeg" || $_FILES["upload"]["type"] == "image/pjpeg") && $_FILES["upload"]["size"] < 10485760) { // max. 10MB
        if (is_uploaded_file($_FILES["upload"]["tmp_name"])) {
          if (move_uploaded_file($_FILES["upload"]["tmp_name"], $path."/".$filename)) {
            kepkeszites($path, $filename, 80, 60);
            kepkeszites($path, $filename, 240, 180);
            kepkeszites($path, $filename, 800, 600);
            unlink($path."/".$filename);
            sleep(1);
          }
        }
        return true; // feltöltés sikerült
      } else {
        return false; // hibás fájltípus, vagy túl nagy fájlméret
      }
    } else {
      return true; // nem volt feltölteni való kép
    }
  }

?>
