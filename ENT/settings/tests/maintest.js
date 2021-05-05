function bouton() {
	var p = document.getElementById("bouton");
	p.className = "animation_on";
	buton_state = true;
}

function bouton() {
	if(buton_state == true) {
		var p = document.getElementById("bouton");
		p.className = "animation_off";
		buton_state = false;
	}
}