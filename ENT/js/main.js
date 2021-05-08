/*  Avec jQuery
(function($){

     Quand je clique sur l'icône hamsandwich je rajoute une classe au body
    $('#sandwich_icon').click(function(e){
        e.preventDefault();
        $('sandwich').toggleClass('move_menu');
    });

     Je veux pouvoir masquer le menu si on clique sur le cache
    $('#sitecache').click(function(e){
        $('sandwich').removeClass('move_menu');
    })

})(jQuery);*/

/*Sans JQuery

On lance une fonction si l'on clique sur la balise p*/
function move_menu_sandwich()
{
  //On change la classe "menu_sandwich" en "move_menu" (problème avec l'ajout de classe à regler)
  document.getElementById("menu_sandwich").className = "move_menu";
}

//même fonctionnement que précedemment en sens inverse, si l'on clique sur la croix
function close_menu_sandwich()
{
  document.getElementById("menu_sandwich").className = "sandwich";
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
  var pulications = document.getElementById("publications_cahier_multimedia");
  publications.value = saisie.nb_max;
}

function addLine() {
  /*var saisie = document.getElementById("textareaCahierMultimedia");
  var nb_max = saisie.nb_max();
  var nb = saisie.nb();*/

  var publications = document.getElementById("publications_cahier_multimedia");
  var template = document.getElementById("template");
  /*teste si le nombre de ligne actuel est inférieur au nombre demandé, et rajoute le nécessaire*/
  publications.innerHTML = publications.innerHTML + template.innerHTML;
}

function addText() {
  /*var saisie = document.getElementById("textareaCahierMultimedia");
  var nb_max = saisie.nb_max();
  var nb = saisie.nb();*/
  
  var textPublication = document.getElementById("publications_cahier_multimedia");
  var textTemplate = document.getElementById("template_cahier_multimedia");
  /*teste si le nombre de ligne actuel est inférieur au nombre demandé, et rajoute le nécessaire*/
  textTemplate.className = "texteCahierMulimedia";
  textPublication.innerHTML = textPublication.innerHTML + textTemplate.innerHTML;

}

function addImage() {
  /*var saisie = document.getElementById("textareaCahierMultimedia");
  var nb_max = saisie.nb_max();
  var nb = saisie.nb();*/

  var imagePublication = document.getElementById("publications_cahier_multimedia");
  var imageTemplate = document.getElementById("imageTemplate");
  /*teste si le nombre de ligne actuel est inférieur au nombre demandé, et rajoute le nécessaire*/
  textTemplate.className = "imageCahierMulimedia";
  imagePublication.innerHTML = imagePublication.innerHTML + imageTemplate.innerHTML;
}