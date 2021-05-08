/*On lance une fonction si l'on clique sur la balise p*/
function move_menu_sandwich()
{
  //On change la classe "menu_sandwich" en "move_menu" (problème avec l'ajout de classe à regler)
  var sandwich = document.getElementById("menu_sandwich");
  sandwich.style.transform = 'translateX(0px)';
  sandwich.style.transform.transition = '300ms all ease-in-out';
}

//même fonctionnement que précedemment en sens inverse, si l'on clique sur la croix
function close_menu_sandwich()
{
  var sandwich = document.getElementById("menu_sandwich");
  sandwich.style.transform = 'translateX(-275px)';
  sandwich.style.transform.transition = '300ms all ease-in-out';
}

/* pour les changement de thèmes */
function LoadCSS( cssURL ) {
    return new Promise( function( resolve, reject ) {
        let link = document.createElement( 'link' );
        link.rel  = 'stylesheet';
        link.href = cssURL;
        document.head.appendChild( link );
        link.onload = function() {
            resolve();
            console.log( 'CSS has loaded!' );
        };
    } );
}

function refresh() {
  window.location.reload();
}

function getNbLines() {
  var saisie = document.getElementById("textarea_cahier_multimedia");
  var publications = document.getElementById("publications_cahier_multimedia");
  publications.value = saisie.nb_max;
}

/*function addLine() {
  var saisie = document.getElementById("textareaCahierMultimedia");
  var nb_max = saisie.nb_max();
  var nb = saisie.nb();
  var publications = document.getElementById("publications_cahier_multimedia");
  var template = document.getElementById("template");
  publications.innerHTML = publications.innerHTML + template.innerHTML;
}*/

function addText() {
  var textPublication = document.getElementById("publications_cahier_multimedia");
  var textTemplate = document.getElementById("text_template_cahier_multimedia");
  textPublication.insertAdjacentHTML("afterbegin",
  '<textarea class="texteCahierMulimedia" id="text_cahier_multimedia" title="texte" name="texte_x" rows="8" cols="80" resize="none" create=false required></textarea>'  );
}

function addImage() {
  var imagePublication = document.getElementById("publications_cahier_multimedia");
  var imageTemplate = document.getElementById("image_template_cahier_multimedia");
  textPublication.insertAdjacentHTML("afterbegin",
  '<input class="imageCahierMulimedia" type="image" id="image_cahier_multimedia" name="image_x" accept="image/*" required>');
}