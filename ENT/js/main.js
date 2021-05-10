/*On lance une fonction si l'on clique sur la balise p*/
function move_menu_sandwich()
{
  //On change la classe "menu_sandwich" en "move_menu" (problème avec l'ajout de classe à regler)
  var sandwich = document.getElementById("menu_sandwich");
  sandwich.style.transform = 'translateX(0px)';
  sandwich.style.transition = '300ms all ease-in-out';
}

//même fonctionnement que précedemment en sens inverse, si l'on clique sur la croix
function close_menu_sandwich()
{
  var sandwich = document.getElementById("menu_sandwich");
  sandwich.style.transform = 'translateX(-275px)';
  sandwich.style.transition = '300ms all ease-in-out';
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

/*Fonction d'ajout de texte ou d'image*/

/*déclaration des variables :
  -textArea : template de la saisie de texte
  -inputImage : template du dépot d'image
  -line : ligne de la zone*/
textArea = '<textarea name="line_0" class="texteCahierMulimedia" id="text_cahier_multimedia" title="texte" rows="8" cols="80" resize="none" create="false" required=""></textarea>';
inputImage = '<input name="line_0" class="imageCahierMulimedia" type="image" id="image_cahier_multimedia" accept="image/*" required>';
line = 0;

/*conditions pour poster image à corriger
ajout des cases de texte par deux à corriger*/
function addLine(lineType) {
  /*publicationCahierMultimedia = liste où sont affichés les zones de saisie*/
  var publicationCahierMultimedia = document.getElementById("publications_cahier_multimedia");
  /*vérifie si l'on a commencé par un texte*/
  if (publicationCahierMultimedia.innerHTML.indexOf(textArea) == -1 && lineType == 'text') {
    /* DEBUT DU MONDE !!!*/
  } /*si l'on a pas encore entré de texte on alerte l'utilisateur*/
  else if (publicationCahierMultimedia.innerHTML.indexOf(textArea) == -1 && lineType == 'image') {
    /* FIN DU MONDE !!!*/
    alert("Veuillez ajouter un texte avant votre image." );
    return false;
  } /*une fois le tout vérifié on ajoute un ligne*/
  
  /*PAS FIN DU MONDE !!!*/
  console.log("text area = " + textArea));
  console.log("image area = " + String(inputImage));
  console.log(line)
  textArea.replace('line_'+ line, 'line_' + line + 1);
  inputImage.replace('line_'+ line, 'line_' + line + 1);
  line += 1;
  console.log("text area = " + String(textArea));
  console.log("image area = " + String(inputImage));
  console.log(line)


  /* ajoute en fonction du type de ligne demandé
  -un texte*/
  if (lineType == 'text') {
    return textArea;
  }
/*-ou une image*/
  else if (lineType == 'image') {
    return inputImage
  } 
/*-et une erreur si aucun type n'a été spécifié, peut arriver en cas de bug au niveau des boutons*/
  else {
    console.log('Error : Undefined lineType')
  }
}

/*ajoute au début de la liste l'élément souhaité (texte / image)*/
function addText() {
  var publicationCahierMultimedia = document.getElementById("publications_cahier_multimedia");
  publicationCahierMultimedia.insertAdjacentHTML("beforeend", addLine('text'));
}

function addImage() {
  var publicationCahierMultimedia = document.getElementById("publications_cahier_multimedia");
  publicationCahierMultimedia.insertAdjacentHTML("beforeend", addLine('image'));
}