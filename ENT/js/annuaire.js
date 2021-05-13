function copy(x) {
  // Get the text field
  var copyText = document.getElementById("ToCopy".concat(x.toString()));
  console.log(x)
  console.log(copyText);

  copyText.select();
  copyText.setSelectionRange(0, 99999);

  // Copy the text inside the text field
  document.execCommand("copy");

   //Alert the copied text
  alert("texte copié: " + copyText.textContent);
}
