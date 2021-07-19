import Swiper from 'swiper/bundle';

class HeroCarousel {

  constructor() {
    this.hero = document.querySelector('.c-hero-carousel__swiper')
  }

  init() {
    this.setupSwiper()
  }

  setupSwiper () {
    this.swiper = new Swiper( this.hero, {
        autoplay: {
          delay: 12500,
        },
        pagination: {
            el: '.c-hero-carousel__pagination',
            clickable: true
        }
    } );
  }
  
}

export default HeroCarousel
