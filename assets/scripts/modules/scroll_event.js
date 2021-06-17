// scroll event ---------------------------------------------
import * as sb from './scroll_progress_indicator.js';
import * as gv from './global_variables.js';

const backtop = document.querySelector('.backtop');
const backtopinner = document.querySelector('.backtop__inner');
const contentstart = document.querySelector('main');
const contentoffset = contentstart.getBoundingClientRect().top + pageYOffset;
const header = document.querySelector('.header');
const allelems = [sb.progress_indicator, backtop];
const body = document.querySelector('body');
let scrolldelay;
var isitdown;

const backtopfunc = () => {
  if (isitdown){
    fadein();
    isitdown = false;
  }
  clearTimeout(scrolldelay);
  scrolldelay = setTimeout(function(){
    fadeout();
    isitdown = true;
  },1500);
}

const fadeout = () => {
  backtopinner.classList.add('fadeout');
  backtopinner.classList.remove('fadein');
};
const fadein = () => {
  backtopinner.classList.remove('fadeout');
  backtopinner.classList.add('fadein');
};

const hideshow = function(){
  window.onscroll = () => {
    if (body.classList.contains('single')){
      sb.scrollbar();
    }
    if ( window.pageYOffset < contentoffset ){
      if (body.classList.contains('single')){
        allelems.forEach( (e) => {
          e.classList.remove('visible');
          e.classList.add('hidden');
        });
      }
      header.classList.remove('header--shallow');
    } else {
      if (body.classList.contains('single')){
        allelems.forEach( (e) => {
          e.classList.add('visible');
          e.classList.remove('hidden');
        });
      }
      header.classList.add('header--shallow');
    }
    if(gv.mq_small.matches){
      backtopfunc();
    }
  }
};

hideshow();