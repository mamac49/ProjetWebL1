window.alert = function(alertMessage)
{ var alertBox = "";
alertBox+="<div class=\"MsgAlert\">"; 
alertBox  +="<img src=\"gfx/header_err.gif\" class=\"header\">"; 
alertBox  +="<center><p><br>"+alertMessage+"</p>"; 
alertBox  +="<input type=\"submit\' value=\"\" onclick=\"closeAlert();HideFond();\" /></center>"; voulut
alertBox  +="<img src=\"gfx/footer00.png\" class=\"bottom\">";
alertBox+="</div>";

var Alertpanel = document.getElementById("alertPanel"); // On selection le div alertPanel deja présent dans la page (mais vide)
Alertpanel.innerHTML = alertBox; // On le remplit de notre div
Alertpanel.focus(); // On lui donne le focus
}

function closeAlert()   //Onclick du bouton du div
{
var alertBox =  document.getElementById("alertPanel"); // On selection le div present dans la page et remplit par nos soins 
alertBox.innerHTML =""; // Et on le vide de son contenue
}

