<?php
require_once("header.php");

if (isset($_SESSION["auid"])) { // ha belépve
    ?>

    <div class="container">
        <h1 class="text-center"><?php print $knev; ?></h1>
        <div class="col-xs-12">
            <div class="grid">
    <?php
    while ($rekord = mysqli_fetch_assoc($kattabla)) {
        $kep = is_file(CIKKAT_IMG_DIR . "/kozepes_" . $rekord["kid"] . ".jpg") ? CIKKAT_IMG_DIR . "/kozepes_" . $rekord["kid"] . ".jpg?d=" . strtotime("now") : CIKKAT_IMG_DIR . "/nincskep.png";
        ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 grid-item">
                        <div class="panel panel-default col-xs-12">
                            <a href="cikkek.php?kid=<?php print $rekord["kid"]; ?>">
                                <div class="page-header" style="margin-top: 10px;">
                                    <img src="<?php print $kep; ?>" alt="<?php print $rekord["knev"]; ?>" width="100%">
                                </div>
                                <h3 class="text-center"><?php print $rekord["knev"]; ?></h3> 
                            </a>
                            <p class="text-right"><a class="btn btn-warning" href="kategoriak_mod.php?kid=<?php print $rekord["kid"]; ?>"><span class="glyphicon glyphicon-pencil"></span></a></p>
                        </div>
                    </div>
        <?php
    }
    while ($rekord = mysqli_fetch_assoc($tabla)) {
        $kozepeskep = is_file(CIKKEK_IMG_DIR . "/kozepes_" . $rekord["cid"] . ".jpg") ? CIKKEK_IMG_DIR . "/kozepes_" . $rekord["cid"] . ".jpg?d=" . strtotime("now") : CIKKEK_IMG_DIR . "/nincskep.png";
        $cinfo = str_replace("\r\n", "<br>", $rekord["cinfo"]);
        $beginDel = $rekord["akcios"] == 1 ? "<del>" : "";
        $endDel = $rekord["akcios"] == 1 ? "</del>" : "";
        ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 grid-item">
                        <div class="panel panel-default col-xs-12">
                            <div class="page-header" style="margin-top: 10px;">
                                <img src="<?php print $kozepeskep; ?>" alt="<?php print $rekord["cnev"]; ?>" width="100%">
                            </div>
                            <h3 class="text-center"><?php print $rekord["cnev"]; ?></h3> 
                            <p class="text-center"><?php print $beginDel . number_format($rekord["car"], 0, ",", " ") . $endDel; ?> Ft</p>
<?php
        if ($rekord["akcios"] == 1) {
?>
                                <p class="text-center text-danger"><?php print number_format($rekord["akciosar"], 0, ",", " "); ?> Ft</p>
<?php
        }
?>
                            <p class="text-right"><a class="btn btn-warning" href="cikkek_mod.php?cid=<?php print $rekord["cid"]; ?>"><span class="glyphicon glyphicon-pencil"></span></a></p>
                        </div> 
                    </div>
        <?php
    }
    ?>
            </div>
        </div>
    </div>

    <?php
}

require_once("footer.php");
?>
