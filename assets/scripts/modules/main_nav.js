const header = document.querySelector('header');
const menu = document.getElementById('menu-main');
const menuItems = menu.querySelectorAll('.header__menu__item');
menuItems.forEach( (i) => {
    let menuitem = i;
    let mainlink = i.querySelector('.header__menu__item__link');
    let dd = i.querySelector('.dropdown');
    menuitem.addEventListener('mouseenter',() => {
        menuitem.classList.add('link-active');
    });
    menuitem.addEventListener('mouseleave',() => {
        menuitem.classList.remove('link-active');
    });
} );