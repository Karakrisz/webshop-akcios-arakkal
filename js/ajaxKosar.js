function kosarba(cid) {
  var ajaxObj = $.ajax({
    url: "kosar.php",
    type: "post",
    data: {
      "event" : "kosárba",
      "adat": cid+"×"+parseInt($("#mennyiseg").val())
    },
    success: function(message) {
      kosarLista();
      alert(message);
    }
  });
}

function kosarbaEgy(cid) {
  var ajaxObj = $.ajax({
    url: "kosar.php",
    type: "post",
    data: {
      "event" : "kosárba",
      "adat": cid+"×1"
    },
    success: function(message) {
      kosarLista();
      alert(message);
    }
  });
}

function kosarLista() {
  var event = window.location.href.indexOf("fid=") >= 0 ? "szummaLista" : "lista";
  var ajaxObj = $.ajax({
    url: "kosar.php",
    type: "post",
    data: {
      "event" : event
    },
    success: function(message) {
      message = message.split("×");
      $(".kosarLista").html(message[0]);
      $(".navbar .badge").html(message[1]);
      visible = parseInt(message[1]) > 0 ? "inline-block" : "none";
      $("#fizmodGomb").css("display", visible);
    }
  });
}

function kosarMod(cid, val) {
  var ajaxObj = $.ajax({
    url: "kosar.php",
    type: "post",
    data: {
      "event" : "kosárMod",
      "adat" : cid+"×"+val
    },
    success: function(message) {
      kosarLista();
    }
  });
}
  