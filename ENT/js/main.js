/*  Avec jQuery
(function($){

     Quand je clique sur l'icône hamburger je rajoute une classe au body
    $('#burger_icon').click(function(e){
        e.preventDefault();
        $('burger').toggleClass('move_menu');
    });

     Je veux pouvoir masquer le menu si on clique sur le cache
    $('#sitecache').click(function(e){
        $('burger').removeClass('move_menu');
    })

})(jQuery);*/

/*Sans JQuery

On lance une fonction si l'on clique sur la balise p*/
function move_menu_burger()
{
  var p = document.getElementById("burger_button");
  p.onclick = move_burger;
};

//On change la classe "menu_burger" en "move_menu" (problème avec l'ajout de classe à regler)
function move_burger()
{
  document.getElementById("menu_burger").className = "move_menu";
}

//même fonctionnement que précedemment en sens inverse, si l'on clique sur la croix
function close_menu_burger()
{
  var p = document.getElementById("burger_cross");
  p.onclick = close_burger;
};

function close_burger()
{
  document.getElementById("menu_burger").className = "burger";
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

function createLine() {
  /*var saisie = document.getElementById("textareaCahierMultimedia");
  var nb_max = saisie.nb_max();
  var nb = saisie.nb();*/

  var publications = document.getElementById("publications_cahier_multimedia");
  var template = document.getElementById("template");
  /*teste si le nombre de ligne actuel est inférieur au nombre demandé, et rajoute le nécessaire*/
  publications.innerHTML = publications.innerHTML + template.innerHTML;
}
