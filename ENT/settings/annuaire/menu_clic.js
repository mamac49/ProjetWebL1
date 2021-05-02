Mouse_X = 0 ;
Mouse_Y = 0 ;
contextMenuOpened = false;
function detect_click(){
  var contact = document.getElementById("contact");
  contact.onclick = open_context_menu;
 
}

//on récupère la position du curseur en pixels
function posCur(evt) {
  evt = !evt ? event : evt
  Mouse_X = evt.clientX; 
  Mouse_Y = evt.clientY;
  var scroll_x=document.body.scrollLeft || document.documentElement.scrollLeft;
  var scroll_y=document.body.scrollTop || document.documentElement.scrollTop;
  //valeur finale de la position du curseur
  Mouse_X += scroll_x;
  Mouse_Y += scroll_y;
}

typeof window.addEventListener == 'undefined' ? document.attachEvent("onmousemove",posCur) : document.addEventListener('mousemove',posCur,false);

function open_context_menu(){ 
  //on défini dans le css où s'ouvrira notre fenêtre
  menu = document.getElementById("context_menu"); 
  menu.style.top =  (-688 + Mouse_Y) + "px";
  menu.style.left = (-10 + Mouse_X) + "px";
  //puis on change la classe du menu, pour qu'il s'affiche
  document.getElementById("context_menu").className = "show_context_menu";
  contextMenuOpened = true;
}

/*function close_context_menu() {
  if (contextMenuOpened == true) {
  menu = document.getElementById("context_menu"); 
  document.getElementById("context_menu").className = "context_menu";
  contextMenuOpened = false;
  }
}*/