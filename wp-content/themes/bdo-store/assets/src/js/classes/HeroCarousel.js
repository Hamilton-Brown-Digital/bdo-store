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
        pagination: {
            el: '.c-hero-carousel__pagination',
        }
    } );
  }
  
}

export default HeroCarousel
