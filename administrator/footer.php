    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/likeUpload.js"></script>
    <script src="../js/ajaxRendelesTetelek.js"></script>
    <script src="../js/ajaxRendelesAllapot.js"></script>
    <script src="../js/masonry.pkgd.min.js"></script>
    <script src="../js/imagesloaded.pkgd.min.js"></script>
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

  </body>
</html>
