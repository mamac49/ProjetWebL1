/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function down(x) {
  document.getElementById("myDropdown-".concat(x.toString())).classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function copy(x) {
  /* Get the text field */
  var copyText = document.getElementById("ToCopy".concat(x.toString()));
  console.log(copyText);
  console.log("ToCopy".concat(x.toString()));
  console.log(Object.values(copyText));

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
