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
publicationCahierMultimedia = document.getElementById("publications_cahier_multimedia");
textArea = '<textarea name="line_0" class="texteCahierMulimedia" id="text_cahier_multimedia" title="texte" rows="8" cols="80" resize="none" create=false required></textarea>';
inputImage = '<input name="line_0" class="imageCahierMulimedia" type="image" id="image_cahier_multimedia" accept="image/*" required>';
line = 0;

function addLine(lineType) {
  if (publicationCahierMultimedia.innerHTML.indexOf(textArea) == -1 && lineType == 'text') {
    publicationCahierMultimedia.insertAdjacentHTML("afterbegin", textArea);
  } else if (publicationCahierMultimedia.innerHTML.indexOf(textArea) == -1 && lineType == 'image') {
    alert("Veuillez ajouter un texte avant votre image." );
  } else {
    textArea.replace('line_'+ line, 'line_' + line + 1);
    inputImage.replace('line_'+ line, 'line_' + line + 1);
    line += 1;
  }
  if (lineType == 'text') {
    return textArea;
  } else if (lineType == 'image') {
    return inputImage
  } else {
    console.log('Error : Undefined lineType')
  }
}

function addText() {
  publicationCahierMultimedia.insertAdjacentHTML("afterbegin", addLine('text'));
}

function addImage() {
  publicationCahierMultimedia.insertAdjacentHTML("afterbegin", addLine('image'));
}

/*if(publicationCahierMultimedia.innerHTML.slice(-51,-28) == "image_cahier_multimedia")*/
/*var publicationCahierMultimedia = document.getElementById("publications_cahier_multimedia");
  if (publicationCahierMultimedia.innerHTML.indexOf(textArea) == -1) {
    alert("Veuillez ajouter un texte avant votre image." );
  } else {
    input.replace('line_'+ line, 'line_' + line + 1);
    line += 1;
  }*/
