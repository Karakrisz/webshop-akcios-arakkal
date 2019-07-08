function ajaxRendelesAllapot(rfid) {
  var ajaxObj = $.ajax({
    url: "control.php",
    type: "post",
    data: {
      "event" : "rAllapotValtozas",
      "rfid": rfid
    },
    success: function(vissza) { // vissza = 0 vagy 1
      allapot = vissza == 0 ? "várakozik" : "kiszállítva";
      $("#allapotCella"+rfid).html(allapot);
      ikon = vissza == 0 ? "glyphicon glyphicon-ok" : "glyphicon glyphicon-time";
      $("#ikon"+rfid).attr("class", ikon);
      szin = vissza == 0 ? "text-danger" : "";
      $("#sor"+rfid).attr("class", szin);
    }
  });
}
