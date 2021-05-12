function getNbLines() {
  var saisie = document.getElementById("textarea_blog");
  var publications = document.getElementById("publicationsBlog");
  publications.value = saisie.nb_max;
}

/*Fonction d'ajout de texte ou d'image*/

  /*déclaration des variables :
  -publicationCahierMultimedia : liste où sont affichés les zones de saisie
  -textArea : template de la saisie de texte
  -inputImage : template du dépot d'image
  -line : ligne de la zone
  -publicationCahierMultimedia : liste où sont affichés les zones de saisie*/
  textArea = '<textarea name="line_0" class="texteblog blog-area" id="text_blog"  title="texte" rows="8" cols="80" resize="none" create="false" required=""></textarea>';
  inputImage = '<input name="line_0" class="imageblog" type="file" id="image_blog" accept="image/*" required>';
  videoArea = '<input name="line_0" type="url" class="videoBlog videoArea" id="video_cahier_multimedia" title="video" rows="8" cols="80" resize="none" create="false" required=""></videoarea>';
  line = 0;

function addLine(lineType) {
  var publicationBlog = document.getElementById("publicationsBlog");

  /*vérifie si l'on a commencé par un texte*/
  if (line == 0) {
    if (publicationBlog.innerHTML.indexOf(textArea == -1) && lineType == 'text') {
      /*DEBUT DU MONDE !!!*/
    } /*si l'on a pas encore entré de texte on alerte l'utilisateur*/
    else if (publicationBlog.innerHTML.indexOf(textArea == -1) && lineType == 'image') {
      /*FIN DU MONDE !!!*/
      alert("Veuillez ajouter un texte avant votre image." );
      return false;
    }
    else if (publicationBlog.innerHTML.indexOf(textArea == -1) && lineType == 'video') {
      /*FIN DU MONDE !!!*/
      alert("Veuillez ajouter un texte avant votre lien vidéo." );
      return false;
    } /*une fois le tout vérifié on ajoute la première ligne*/
  }
  /*PAS FIN DU MONDE !!!*/

  /*logs tests
  console.log('text area = ' + textArea);
  console.log('image area = ' + inputImage);
  console.log('image area = ' + inputImage);*/

  textArea = textArea.replace('line_' + line, 'line_' + (line + 1));
  inputImage = inputImage.replace('line_' + line, 'line_' + (line + 1));
  videoArea = videoArea.replace('line_' + line, 'line_' + (line += 1));
  console.log('Line ' + line + ' added.');
  /*logs tests
  console.log('text area = ' + textArea);
  console.log('image area = ' + inputImage);
  console.log(line);*/

  /* ajoute en fonction du type de ligne demandé
  -un texte*/
  if (lineType == 'text') {
    return textArea;
  }
/*-ou une image*/
  else if (lineType == 'image') {
    return inputImage;
  }
/*-ou une video*/
  else if (lineType == 'video') {
    return videoArea;
  }
/*-et une erreur si aucun type n'a été spécifié, peut arriver en cas de bug au niveau des boutons*/
  else {
    console.log('Error : Undefined lineType');
  }
}

  /*ajoute au début de la liste l'élément souhaité (texte / image)*/
  function addText() {
    var publicationBlog = document.getElementById("publications_blog");
    publicationBlog.insertAdjacentHTML("beforeend", addLine('text'));
  }

  function addImage() {
    var publicationBlog = document.getElementById("publications_blog");
    if (line == 0 && addLine('image') == false) {
      /*FIN DU MONDE!!!*/
    } else {
      /*PAS FIN DU MONDE !!!*/
      publicationBlog.insertAdjacentHTML("beforeend", addLine('image'));
    }
  }

  function addVideo() {
    var publicationBlog = document.getElementById("publications_blog");
    if (line == 0 && addLine('video') == false) {
      /*FIN DU MONDE!!!*/
    } else {
      /*PAS FIN DU MONDE !!!*/
      publicationBlog.insertAdjacentHTML("beforeend", addLine('video'));
    }
  }
