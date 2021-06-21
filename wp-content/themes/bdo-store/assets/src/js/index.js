import Header from './classes/Header.js';
import Init from './classes/Init';

const siteFunctions = {
  documentReady__ready() {
  },

  header__ready() {
    const header = new Header();
    header.init();
  },
};

window.functionCore = new Init(siteFunctions);
