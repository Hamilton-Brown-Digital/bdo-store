class Header {

  constructor() {
    this.nav = document.querySelector('.js-primary-nav')
    this.hamburger = document.querySelector('.js-hamburger')
  }

  init() {
    this.events()
  }

  events() {

    this.hamburger.addEventListener('click', () => {
      this.toggle()
    });

  }

  toggle () {
    if ( this.hamburger.classList.contains('open') ) {
      this.close(this.hamburger)
      this.close(this.nav)
    } else {
      this.open(this.hamburger)
      this.open(this.nav)
    }
  }

  /* eslint-disable */
  open (elem) {
    elem.classList.add('open')
  }

  close (elem) {
    elem.classList.remove('open')
  }
  /* eslint-enable */
}

export default Header
