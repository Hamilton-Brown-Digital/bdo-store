import Header from './classes/Header.js';
import HeroCarousel from './classes/HeroCarousel.js';
import Init from './classes/Init';

const siteFunctions = {
  documentReady__ready() {
  },

  header__ready() {
    const header = new Header();
    header.init();
  },

  heroCarousel__ready() {
    const heroCarousel = new HeroCarousel();
    heroCarousel.init();
  },
};

window.functionCore = new Init(siteFunctions);
