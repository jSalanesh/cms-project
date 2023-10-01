$(document).ready(function () {
  $("#summernote").summernote({
    height: 200,
  });
});
function loadUsersOnline(){
  $.get("functions.php?onlineusers=result",function(data){
    $(".usersonline").text(data);
  });
}

setInterval(function(){
  loadUsersOnline();
},500);

const checkAllElement = document.querySelector("#checkAll");
const tableBoxElements = document.querySelectorAll(".table-boxes");
checkAllElement.addEventListener("click", function () {
  for (el of tableBoxElements) {
    if (el.checked === true) {
      el.checked = false;
    } else {
      el.checked = true;
    }
  }
});

