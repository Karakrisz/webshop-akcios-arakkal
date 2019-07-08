$(document).ready(run);

function run() {

  $("#likeUpload").siblings("img").css({
    "max-width" : "100%",
    "cursor" : "pointer"
  });

  $("#likeUpload").after('<input type="file" name="upload" id="upload" accept="image/jpeg">');
  $("#upload").css("display", "none");

  $("#likeUpload").siblings("img").on("click", function() {
    $("#upload").click();
  });

  $("#upload").on("change", function() {
    if (this.files && this.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function(e) { // kész a betöltés
        $("#likeUpload").siblings("img").attr("src", e.target.result);
      }

      reader.readAsDataURL(this.files[0]); // betöltés indítása
    }
  });

}
