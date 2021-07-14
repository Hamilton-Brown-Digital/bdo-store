class BackToTop {

    constructor() {  
      const footer = document.querySelector('.c-footer')
      this.startShow = 100
      this.stopShow = (footer.offsetTop - footer.offsetHeight) - (window.innerHeight - this.startShow)
      this.btn = document.querySelector('.e-back-to-top')
    }
  
    init() {
      this.events()
    }
  
    events() {
        document.addEventListener('scroll', () => {
            const lastKnownScrollPosition = window.scrollY
            if ( (lastKnownScrollPosition > this.startShow) && (lastKnownScrollPosition < this.stopShow) ) {
                this.show()
            } else {
                this.hide()
            }
        })

        this.btn.addEventListener( 'click', ( ev ) => {
            ev.preventDefault()
            this.trigger()
        })
    }

    show () {
        this.btn.classList.add('show')
    }

    hide () {
        this.btn.classList.remove('show')
    }

    /* eslint-disable */
    trigger () {
        document.querySelector('body').scrollIntoView({
            behavior: "smooth"
        })
    }
    /* eslint-enable */

}

export default BackToTop