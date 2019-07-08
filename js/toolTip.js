$(document).ready(run);

function run() {
  $("#adataim, #adataim span").mousemove(function() {
    if (!$("#toolTip").length) { // ha még nem létezik
      $("body").append('<div id="toolTip">Adataim</div>');
      $("#toolTip").css({
        "position": "absolute",
        "left": $(window).innerWidth() - 100,
        "top": "70px",
        "background-color": "grey",
        "color": "white",
        "padding": "5px 10px",
        "border-radius": "3px"
      });
    }
  });

  $("#adataim").mouseover(function() {
    $("#toolTip").css("display", "block");
  });

  $("#adataim").mouseout(function() {
    $("#toolTip").css("display", "none");
  });
  
  $(window).scroll(function() {
    $("#toolTip").css("top", $(window).scrollTop() + 70);
  });

  $(window).resize(function() {
    $("#toolTip").css({
      "top": $(window).scrollTop() + 70,
      "left": $(window).innerWidth() - 100
    });
  });

}
 