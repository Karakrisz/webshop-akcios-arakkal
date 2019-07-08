function RendelesTetelekLista(rfid) {
  var ajaxObj = $.ajax({
    url: "rendelestetelek.php",
    type: "post",
    data: {
      "event" : "lekerdez",
      "rfid": rfid
    },
    success: function(vissza) {
			vissza = vissza.split("×"); // split a Javascriptben a Php-s explode fgv-nek felel meg
			$("#RendelesTetelekModal h4").html(vissza[0]);
			$("#RendelesTetelekModal .RendelesTetelekLista").html(vissza[1]);
    }
  });
}
