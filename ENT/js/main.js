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


function move_menu_burger()
{
  var p = document.getElementById("burger_button");
  p.onclick = move_burger;
};

function move_burger()
{
  document.getElementById("menu_burger").className = "move_menu";
}

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
