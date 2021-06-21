class Header {

  constructor() {
    this.primaryNav = document.querySelector('.js-primary-nav')
  }

  init() {
    this.events()
  }

  events() {

    document.addEventListener('click', (ev) => {
      this.clickAway(ev)
    });

  }

  clickAway( ev ) {
    let targetElement = ev.target;

    do {
      if ( targetElement === this.primaryNav ) {
          return;
      }
      targetElement = targetElement.parentNode;
    } while (targetElement);

    this.close(this.primaryNav)
    this.closeAllSecondaryNav()
  }

  closeAllSecondaryNav() {
    this.navItems.forEach((navItem) => {
      this.close(navItem.querySelector('.c-navigation__link'))
      this.close(navItem.querySelector('.c-navigation__children'))
      navItem.classList.remove('open')
    })
  }
  /* eslint-disable */
  open(elem) {
    elem.classList.add('open')
  }

  close(elem) {
    elem.classList.remove('open')
  }
  /* eslint-enable */
}

export default Header
