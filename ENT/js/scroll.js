// When the user scrolls down 20px from the top of the document, slide down the navbar
// When the user scrolls to the top of the page, slide up the navbar (50px out of the top view)
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollBottom > 20 || document.documentElement.scrollBottom > 20) {
    document.getElementById("navbar").style.bottom = "-50px";
  } else {
    document.getElementById("navbar").style.bottom = "0px";
  }
}
