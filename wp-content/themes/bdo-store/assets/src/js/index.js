import Header from './classes/Header.js';
import HeroCarousel from './classes/HeroCarousel.js';
import Accordion from './classes/Accordion.js';
import Skip from './classes/Skip.js';
import BackToTop from './classes/BackToTop.js';
import Video from './classes/Video.js';
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

  accordion__ready() {
    const accordion = new Accordion();
    accordion.init();
  },

  skip__ready() {
    const skip = new Skip();
    skip.init();
  },
  
  backToTop__ready() {
    const backToTop = new BackToTop();
    backToTop.init();
  },

  video__ready() {
    const video = new Video();
    video.init()

    /* eslint-disable */
    window.onYouTubeIframeAPIReady = () => {
      video.initYoutube()
    };
    /* eslint-enable */

  }
};

window.functionCore = new Init(siteFunctions);
