
// Get the modal
var modal = document.getElementById('id01');

function muncul() {
  document.getElementById('id01').style.display='block';
}

function hilang() {
  document.getElementById('id01').style.display='none'
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
