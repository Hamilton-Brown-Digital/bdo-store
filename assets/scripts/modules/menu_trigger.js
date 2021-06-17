// menu trigger -------------------------------------------------

const triggermenu = document.querySelector('.trigger-menu');
const menu = document.querySelector('.mobile-menu');
const body = document.getElementsByTagName("BODY")[0];
var isopen = false;

const menu_open = () => {
  menu.setAttribute('aria-pressed',true);
  isopen = true;
  menu.classList.add('open');
  menu.classList.remove('close');
  body.classList.add('locked');
}
const menu_close = () => {
  menu.setAttribute('aria-pressed',false);
  isopen = false;
  menu.classList.add('close');
  menu.classList.remove('open');
  body.classList.remove('locked');
}

triggermenu.addEventListener('click',function(){
  isopen ? menu_close() : menu_open();
});

triggermenu.addEventListener('keyup',function(e){
  if( e.key == 'Escape' && isopen == true ){
    menu_close();
  }
});