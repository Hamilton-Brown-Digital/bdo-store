
const flickityelem2x = document.querySelector('.flickity-carousel--2x');
const flickityelem3x = document.querySelector('.flickity-carousel--3x');


function flickity(x){

  if (flickityelem2x !== null){
    const flickitychildren = flickityelem2x.childElementCount;
    if (flickitychildren > 2 && x.matches){
    var flkty2x = new Flickity( flickityelem2x, {
      pageDots: false,
      prevNextButtons: false,
      freeScroll: false,
      cellAlign: 'left',
      setGallerySize: true,
      wrapAround: true
    });
    } else {
      flickityelem2x.className = "";
      flickityelem2x.classList.add('posts-list', 'posts-list--2x');
    }
  };
  
  
  if (flickityelem3x !== null){
    const flickitychildren = flickityelem3x.childElementCount;
    if (flickitychildren > 2 && x.matches){
      var flkty3x = new Flickity( flickityelem3x, {
        pageDots: false,
        prevNextButtons: false,
        freeScroll: false,
        cellAlign: 'left',
        setGallerySize: true,
        wrapAround: true
      });
    } else {
      flickityelem3x.className = "";
      flickityelem3x.classList.add('posts-list', 'posts-list--3x');
    }
  };

}



var x = window.matchMedia("(max-width: 700px)")
flickity(x);