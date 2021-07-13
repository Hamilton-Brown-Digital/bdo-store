class Skip {

    constructor() {  
      this.skips = document.querySelector('.e-cta-button--skip')
      this.skipContent = document.querySelector('#details')
    }
  
    init() {
      this.events()
    }
  
    events() {
        if ( this.skips ) {
            this.skips.addEventListener( 'click', ( ev ) => {
                ev.preventDefault()
                this.trigger()
            })
        }
    }

    trigger () {
        this.skipContent.scrollIntoView({
            behavior: "smooth"
        })
    }

}

export default Skip