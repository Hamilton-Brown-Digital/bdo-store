class Accordion {

    constructor() {  
      this.accordions = document.querySelectorAll('.c-accordion__item')
      this.accordionMenu = document.querySelectorAll('.js-accordion-menu')
    }
  
    init() {
      this.events()
    }
  
    events() {
        this.accordions.forEach( ( accordion ) => {
            accordion.querySelector('.c-accordion__item__title').addEventListener( 'click', ( ev ) => {
                ev.preventDefault()
                this.trigger( ev.target )
            })
        } )

        this.accordionMenu.forEach( ( item ) => {
            item.addEventListener( 'click', ( ev ) => {
                ev.preventDefault()

                document.querySelector(ev.target.getAttribute('href')).scrollIntoView({
                    behavior: "smooth"
                })
            })
        } )
    }

    /* eslint-disable */
    trigger ( el ) {
        const parent = el.closest('.c-accordion__item')
        
        if (parent.classList.contains('c-accordion__item--active')) {
            parent.classList.remove('c-accordion__item--active')
        } else {
            parent.classList.add('c-accordion__item--active')
        }
    }
    /* eslint-enable */

}

export default Accordion