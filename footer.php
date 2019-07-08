    <footer style="line-height: 30px;">
      <div class="container-fluid">
        <div class="col-xs-12">
          <p class="text-center"><a href="#">Felhasználási szabályzat és adatkezelési nyilatkozat</a></p>
          <p class="text-center">Minden jog fenntartva! - Mualim Krisztián - <?php print date("Y"); ?></p>
        </div>
      </div>
    </footer>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/toolTip.js"></script>
    <script src="js/ajaxKosar.js"></script>
    <script src="js/reszletek.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script>
        $('.grid').masonry({
          itemSelector: '.grid-item'
        });
        var $grid = $('.grid').masonry({
          // options...
        });
        // layout Masonry after each image loads
        $grid.imagesLoaded().progress( function() {
            $grid.masonry('layout');
        });
    </script>
    <script>
      kosarLista();
    </script>

  </body>
</html>
