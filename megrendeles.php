<?php

  require_once("header.php");

?>

  <div class="container">
    <h1 class="text-center">Köszönjük megrendelését!</h1>
    <h2 class="text-center">Az Ön megrendeléséhez tartozó rendelésszám: <?php print $_SESSION["rendelesszam"]; ?></h2>
    <p class="text-center">Kérjük jegyezze fel a rendelésszámot, hogy reklamáció esetén hivatkozni tudjon rá!</p>
  </div>

<?php

  require_once("footer.php");

?>
