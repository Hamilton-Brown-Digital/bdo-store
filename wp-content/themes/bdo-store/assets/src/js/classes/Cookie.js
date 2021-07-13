class Cookie {

    constructor() {  
        this.cookie = document.querySelector('.e-cookie')
        this.cookieCta = document.querySelector('.e-cookie__cta')
    }
  
    init() {
      this.events()
    }
  
    events() {
        this.show()

        this.cookieCta.addEventListener( 'click', ( ev ) => {
            ev.preventDefault()
            this.hide()
        })
    }

    show () {
        if ( this.getCookie('bdoCookie') === null ) {
            this.cookie.classList.add('show')
        }
    }

    hide () {
        this.setCookie('bdoCookie', 'accepted', 30)
        this.cookie.classList.remove('show')
    }

    /* eslint-disable */
    setCookie ( name, value, days ) {
        let expires = "";
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = `; expires=${  date.toUTCString()}`;
        }
        document.cookie = `${name  }=${  value || ""   }${expires  }; path=/`;
    }

    getCookie ( name ) {
        const nameEQ = `${name  }=`;
        const ca = document.cookie.split(';');
        for(let i=0;i < ca.length;i++) {
            let c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }
    /* eslint-enable */

}

export default Cookie