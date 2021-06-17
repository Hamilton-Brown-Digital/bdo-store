(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

require("./modules/global_variables.js");

require("./modules/menu_trigger.js");

require("./modules/main_nav.js");

require("./modules/scroll_event.js");

require("./modules/flickity.js");

},{"./modules/flickity.js":2,"./modules/global_variables.js":3,"./modules/main_nav.js":4,"./modules/menu_trigger.js":5,"./modules/scroll_event.js":6}],2:[function(require,module,exports){
"use strict";

var flickityelem2x = document.querySelector('.flickity-carousel--2x');
var flickityelem3x = document.querySelector('.flickity-carousel--3x');

function flickity(x) {
  if (flickityelem2x !== null) {
    var flickitychildren = flickityelem2x.childElementCount;

    if (flickitychildren > 2 && x.matches) {
      var flkty2x = new Flickity(flickityelem2x, {
        pageDots: false,
        prevNextButtons: false,
        freeScroll: false,
        cellAlign: 'left',
        setGallerySize: true,
        wrapAround: true
      });
    } else {
      flickityelem2x.className = "";
      flickityelem2x.classList.add('posts-list', 'posts-list--2x');
    }
  }

  ;

  if (flickityelem3x !== null) {
    var _flickitychildren = flickityelem3x.childElementCount;

    if (_flickitychildren > 2 && x.matches) {
      var flkty3x = new Flickity(flickityelem3x, {
        pageDots: false,
        prevNextButtons: false,
        freeScroll: false,
        cellAlign: 'left',
        setGallerySize: true,
        wrapAround: true
      });
    } else {
      flickityelem3x.className = "";
      flickityelem3x.classList.add('posts-list', 'posts-list--3x');
    }
  }

  ;
}

var x = window.matchMedia("(max-width: 700px)");
flickity(x);

},{}],3:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.mq_small = void 0;
var mq_small = window.matchMedia("(max-width:560px)");
exports.mq_small = mq_small;

},{}],4:[function(require,module,exports){
"use strict";

var header = document.querySelector('header');
var menu = document.getElementById('menu-main');
var menuItems = menu.querySelectorAll('.header__menu__item');
menuItems.forEach(function (i) {
  var menuitem = i;
  var mainlink = i.querySelector('.header__menu__item__link');
  var dd = i.querySelector('.dropdown');
  menuitem.addEventListener('mouseenter', function () {
    menuitem.classList.add('link-active');
  });
  menuitem.addEventListener('mouseleave', function () {
    menuitem.classList.remove('link-active');
  });
});

},{}],5:[function(require,module,exports){
"use strict";

// menu trigger -------------------------------------------------
var triggermenu = document.querySelector('.trigger-menu');
var menu = document.querySelector('.mobile-menu');
var body = document.getElementsByTagName("BODY")[0];
var isopen = false;

var menu_open = function menu_open() {
  menu.setAttribute('aria-pressed', true);
  isopen = true;
  menu.classList.add('open');
  menu.classList.remove('close');
  body.classList.add('locked');
};

var menu_close = function menu_close() {
  menu.setAttribute('aria-pressed', false);
  isopen = false;
  menu.classList.add('close');
  menu.classList.remove('open');
  body.classList.remove('locked');
};

triggermenu.addEventListener('click', function () {
  isopen ? menu_close() : menu_open();
});
triggermenu.addEventListener('keyup', function (e) {
  if (e.key == 'Escape' && isopen == true) {
    menu_close();
  }
});

},{}],6:[function(require,module,exports){
"use strict";

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

var sb = _interopRequireWildcard(require("./scroll_progress_indicator.js"));

var gv = _interopRequireWildcard(require("./global_variables.js"));

function _getRequireWildcardCache() { if (typeof WeakMap !== "function") return null; var cache = new WeakMap(); _getRequireWildcardCache = function _getRequireWildcardCache() { return cache; }; return cache; }

function _interopRequireWildcard(obj) { if (obj && obj.__esModule) { return obj; } if (obj === null || _typeof(obj) !== "object" && typeof obj !== "function") { return { "default": obj }; } var cache = _getRequireWildcardCache(); if (cache && cache.has(obj)) { return cache.get(obj); } var newObj = {}; var hasPropertyDescriptor = Object.defineProperty && Object.getOwnPropertyDescriptor; for (var key in obj) { if (Object.prototype.hasOwnProperty.call(obj, key)) { var desc = hasPropertyDescriptor ? Object.getOwnPropertyDescriptor(obj, key) : null; if (desc && (desc.get || desc.set)) { Object.defineProperty(newObj, key, desc); } else { newObj[key] = obj[key]; } } } newObj["default"] = obj; if (cache) { cache.set(obj, newObj); } return newObj; }

// scroll event ---------------------------------------------
var backtop = document.querySelector('.backtop');
var backtopinner = document.querySelector('.backtop__inner');
var contentstart = document.querySelector('main');
var contentoffset = contentstart.getBoundingClientRect().top + pageYOffset;
var header = document.querySelector('.header');
var allelems = [sb.progress_indicator, backtop];
var body = document.querySelector('body');
var scrolldelay;
var isitdown;

var backtopfunc = function backtopfunc() {
  if (isitdown) {
    fadein();
    isitdown = false;
  }

  clearTimeout(scrolldelay);
  scrolldelay = setTimeout(function () {
    fadeout();
    isitdown = true;
  }, 1500);
};

var fadeout = function fadeout() {
  backtopinner.classList.add('fadeout');
  backtopinner.classList.remove('fadein');
};

var fadein = function fadein() {
  backtopinner.classList.remove('fadeout');
  backtopinner.classList.add('fadein');
};

var hideshow = function hideshow() {
  window.onscroll = function () {
    if (body.classList.contains('single')) {
      sb.scrollbar();
    }

    if (window.pageYOffset < contentoffset) {
      if (body.classList.contains('single')) {
        allelems.forEach(function (e) {
          e.classList.remove('visible');
          e.classList.add('hidden');
        });
      }

      header.classList.remove('header--shallow');
    } else {
      if (body.classList.contains('single')) {
        allelems.forEach(function (e) {
          e.classList.add('visible');
          e.classList.remove('hidden');
        });
      }

      header.classList.add('header--shallow');
    }

    if (gv.mq_small.matches) {
      backtopfunc();
    }
  };
};

hideshow();

},{"./global_variables.js":3,"./scroll_progress_indicator.js":7}],7:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.scrollbar = exports.progress_indicator = void 0;
// scrollbar progress indicator -----------------------------
var progress_indicator = document.querySelector('.progress-indicator');
exports.progress_indicator = progress_indicator;

var scrollbar = function scrollbar() {
  var displayheight = window.innerHeight;
  var pillarcontent = document.querySelector('.article');
  var bodyheight = document.body.clientHeight;
  var pillarcontentheight = pillarcontent.clientHeight;
  var pillarcontentoffset = pillarcontent.offsetTop;
  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  var winScroll_new = winScroll - pillarcontentoffset;
  var windScroll_new_bottom = winScroll_new + window.innerHeight;
  var scrolledpc = windScroll_new_bottom / pillarcontentheight * 100;
  document.getElementById("myBar").style.width = scrolledpc + "%";
};

exports.scrollbar = scrollbar;

},{}]},{},[1])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyaWZ5L25vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhc3NldHMvc2NyaXB0cy9tYWluLmpzIiwiYXNzZXRzL3NjcmlwdHMvbW9kdWxlcy9mbGlja2l0eS5qcyIsImFzc2V0cy9zY3JpcHRzL21vZHVsZXMvZ2xvYmFsX3ZhcmlhYmxlcy5qcyIsImFzc2V0cy9zY3JpcHRzL21vZHVsZXMvbWFpbl9uYXYuanMiLCJhc3NldHMvc2NyaXB0cy9tb2R1bGVzL21lbnVfdHJpZ2dlci5qcyIsImFzc2V0cy9zY3JpcHRzL21vZHVsZXMvc2Nyb2xsX2V2ZW50LmpzIiwiYXNzZXRzL3NjcmlwdHMvbW9kdWxlcy9zY3JvbGxfcHJvZ3Jlc3NfaW5kaWNhdG9yLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBOzs7QUNBQTs7QUFDQTs7QUFDQTs7QUFDQTs7QUFDQTs7Ozs7QUNIQSxJQUFNLGNBQWMsR0FBRyxRQUFRLENBQUMsYUFBVCxDQUF1Qix3QkFBdkIsQ0FBdkI7QUFDQSxJQUFNLGNBQWMsR0FBRyxRQUFRLENBQUMsYUFBVCxDQUF1Qix3QkFBdkIsQ0FBdkI7O0FBR0EsU0FBUyxRQUFULENBQWtCLENBQWxCLEVBQW9CO0FBRWxCLE1BQUksY0FBYyxLQUFLLElBQXZCLEVBQTRCO0FBQzFCLFFBQU0sZ0JBQWdCLEdBQUcsY0FBYyxDQUFDLGlCQUF4Qzs7QUFDQSxRQUFJLGdCQUFnQixHQUFHLENBQW5CLElBQXdCLENBQUMsQ0FBQyxPQUE5QixFQUFzQztBQUN0QyxVQUFJLE9BQU8sR0FBRyxJQUFJLFFBQUosQ0FBYyxjQUFkLEVBQThCO0FBQzFDLFFBQUEsUUFBUSxFQUFFLEtBRGdDO0FBRTFDLFFBQUEsZUFBZSxFQUFFLEtBRnlCO0FBRzFDLFFBQUEsVUFBVSxFQUFFLEtBSDhCO0FBSTFDLFFBQUEsU0FBUyxFQUFFLE1BSitCO0FBSzFDLFFBQUEsY0FBYyxFQUFFLElBTDBCO0FBTTFDLFFBQUEsVUFB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LFFBQVEsQ0FBQyxJQUFULENBQWMsU0FBZCxJQUEyQixRQUFRLENBQUMsZUFBVCxDQUF5QixTQUFwRTtBQUNBLE1BQUksYUFBYSxHQUFHLFNBQVMsR0FBRyxtQkFBaEM7QUFDQSxNQUFJLHFCQUFxQixHQUFHLGFBQWEsR0FBRyxNQUFNLENBQUMsV0FBbkQ7QUFDQSxNQUFJLFVBQVUsR0FBRyxxQkFBcUIsR0FBRyxtQkFBeEIsR0FBOEMsR0FBL0Q7QUFDQSxFQUFBLFFBQVEsQ0FBQyxjQUFULENBQXdCLE9BQXhCLEVBQWlDLEtBQWpDLENBQXVDLEtBQXZDLEdBQStDLFVBQVUsR0FBRyxHQUE1RDtBQUNELENBWE0iLCJmaWxlIjoiZ2VuZXJhdGVkLmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigpe2Z1bmN0aW9uIHIoZSxuLHQpe2Z1bmN0aW9uIG8oaSxmKXtpZighbltpXSl7aWYoIWVbaV0pe3ZhciBjPVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmU7aWYoIWYmJmMpcmV0dXJuIGMoaSwhMCk7aWYodSlyZXR1cm4gdShpLCEwKTt2YXIgYT1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK2krXCInXCIpO3Rocm93IGEuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixhfXZhciBwPW5baV09e2V4cG9ydHM6e319O2VbaV1bMF0uY2FsbChwLmV4cG9ydHMsZnVuY3Rpb24ocil7dmFyIG49ZVtpXVsxXVtyXTtyZXR1cm4gbyhufHxyKX0scCxwLmV4cG9ydHMscixlLG4sdCl9cmV0dXJuIG5baV0uZXhwb3J0c31mb3IodmFyIHU9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZSxpPTA7aTx0Lmxlbmd0aDtpKyspbyh0W2ldKTtyZXR1cm4gb31yZXR1cm4gcn0pKCkiLCJpbXBvcnQgJy4vbW9kdWxlcy9nbG9iYWxfdmFyaWFibGVzLmpzJztcbmltcG9ydCAnLi9tb2R1bGVzL21lbnVfdHJpZ2dlci5qcyc7XG5pbXBvcnQgJy4vbW9kdWxlcy9tYWluX25hdi5qcyc7XG5pbXBvcnQgJy4vbW9kdWxlcy9zY3JvbGxfZXZlbnQuanMnO1xuaW1wb3J0ICcuL21vZHVsZXMvZmxpY2tpdHkuanMnOyIsIlxuY29uc3QgZmxpY2tpdHllbGVtMnggPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuZmxpY2tpdHktY2Fyb3VzZWwtLTJ4Jyk7XG5jb25zdCBmbGlja2l0eWVsZW0zeCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5mbGlja2l0eS1jYXJvdXNlbC0tM3gnKTtcblxuXG5mdW5jdGlvbiBmbGlja2l0eSh4KXtcblxuICBpZiAoZmxpY2tpdHllbGVtMnggIT09IG51bGwpe1xuICAgIGNvbnN0IGZsaWNraXR5Y2hpbGRyZW4gPSBmbGlja2l0eWVsZW0yeC5jaGlsZEVsZW1lbnRDb3VudDtcbiAgICBpZiAoZmxpY2tpdHljaGlsZHJlbiA+IDIgJiYgeC5tYXRjaGVzKXtcbiAgICB2YXIgZmxrdHkyeCA9IG5ldyBGbGlja2l0eSggZmxpY2tpdHllbGVtMngsIHtcbiAgICAgIHBhZ2VEb3RzOiBmYWxzZSxcbiAgICAgIHByZXZOZXh0QnV0dG9uczogZmFsc2UsXG4gICAgICBmcmVlU2Nyb2xsOiBmYWxzZSxcbiAgICAgIGNlbGxBbGlnbjogJ2xlZnQnLFxuICAgICAgc2V0R2FsbGVyeVNpemU6IHRydWUsXG4gICAgICB3cmFwQXJvdW5kOiB0cnVlXG4gICAgfSk7XG4gICAgfSBlbHNlIHtcbiAgICAgIGZsaWNraXR5ZWxlbTJ4LmNsYXNzTmFtZSA9IFwiXCI7XG4gICAgICBmbGlja2l0eWVsZW0yeC5jbGFzc0xpc3QuYWRkKCdwb3N0cy1saXN0JywgJ3Bvc3RzLWxpc3QtLTJ4Jyk7XG4gICAgfVxuICB9O1xuICBcbiAgXG4gIGlmIChmbGlja2l0eWVsZW0zeCAhPT0gbnVsbCl7XG4gICAgY29uc3QgZmxpY2tpdHljaGlsZHJlbiA9IGZsaWNraXR5ZWxlbTN4LmNoaWxkRWxlbWVudENvdW50O1xuICAgIGlmIChmbGlja2l0eWNoaWxkcmVuID4gMiAmJiB4Lm1hdGNoZXMpe1xuICAgICAgdmFyIGZsa3R5M3ggPSBuZXcgRmxpY2tpdHkoIGZsaWNraXR5ZWxlbTN4LCB7XG4gICAgICAgIHBhZ2VEb3RzOiBmYWxzZSxcbiAgICAgICAgcHJldk5leHRCdXR0b25zOiBmYWxzZSxcbiAgICAgICAgZnJlZVNjcm9sbDogZmFsc2UsXG4gICAgICAgIGNlbGxBbGlnbjogJ2xlZnQnLFxuICAgICAgICBzZXRHYWxsZXJ5U2l6ZTogdHJ1ZSxcbiAgICAgICAgd3JhcEFyb3VuZDogdHJ1ZVxuICAgICAgfSk7XG4gICAgfSBlbHNlIHtcbiAgICAgIGZsaWNraXR5ZWxlbTN4LmNsYXNzTmFtZSA9IFwiXCI7XG4gICAgICBmbGlja2l0eWVsZW0zeC5jbGFzc0xpc3QuYWRkKCdwb3N0cy1saXN0JywgJ3Bvc3RzLWxpc3QtLTN4Jyk7XG4gICAgfVxuICB9O1xuXG59XG5cblxuXG52YXIgeCA9IHdpbmRvdy5tYXRjaE1lZGlhKFwiKG1heC13aWR0aDogNzAwcHgpXCIpXG5mbGlja2l0eSh4KTsiLCJleHBvcnQgY29uc3QgbXFfc21hbGwgPSB3aW5kb3cubWF0Y2hNZWRpYShcIihtYXgtd2lkdGg6NTYwcHgpXCIpOyIsImNvbnN0IGhlYWRlciA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ2hlYWRlcicpO1xuY29uc3QgbWVudSA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdtZW51LW1haW4nKTtcbmNvbnN0IG1lbnVJdGVtcyA9IG1lbnUucXVlcnlTZWxlY3RvckFsbCgnLmhlYWRlcl9fbWVudV9faXRlbScpO1xubWVudUl0ZW1zLmZvckVhY2goIChpKSA9PiB7XG4gICAgbGV0IG1lbnVpdGVtID0gaTtcbiAgICBsZXQgbWFpbmxpbmsgPSBpLnF1ZXJ5U2VsZWN0b3IoJy5oZWFkZXJfX21lbnVfX2l0ZW1fX2xpbmsnKTtcbiAgICBsZXQgZGQgPSBpLnF1ZXJ5U2VsZWN0b3IoJy5kcm9wZG93bicpO1xuICAgIG1lbnVpdGVtLmFkZEV2ZW50TGlzdGVuZXIoJ21vdXNlZW50ZXInLCgpID0+IHtcbiAgICAgICAgbWVudWl0ZW0uY2xhc3NMaXN0LmFkZCgnbGluay1hY3RpdmUnKTtcbiAgICB9KTtcbiAgICBtZW51aXRlbS5hZGRFdmVudExpc3RlbmVyKCdtb3VzZWxlYXZlJywoKSA9PiB7XG4gICAgICAgIG1lbnVpdGVtLmNsYXNzTGlzdC5yZW1vdmUoJ2xpbmstYWN0aXZlJyk7XG4gICAgfSk7XG59ICk7IiwiLy8gbWVudSB0cmlnZ2VyIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cblxuY29uc3QgdHJpZ2dlcm1lbnUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcudHJpZ2dlci1tZW51Jyk7XG5jb25zdCBtZW51ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLm1vYmlsZS1tZW51Jyk7XG5jb25zdCBib2R5ID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeVRhZ05hbWUoXCJCT0RZXCIpWzBdO1xudmFyIGlzb3BlbiA9IGZhbHNlO1xuXG5jb25zdCBtZW51X29wZW4gPSAoKSA9PiB7XG4gIG1lbnUuc2V0QXR0cmlidXRlKCdhcmlhLXByZXNzZWQnLHRydWUpO1xuICBpc29wZW4gPSB0cnVlO1xuICBtZW51LmNsYXNzTGlzdC5hZGQoJ29wZW4nKTtcbiAgbWVudS5jbGFzc0xpc3QucmVtb3ZlKCdjbG9zZScpO1xuICBib2R5LmNsYXNzTGlzdC5hZGQoJ2xvY2tlZCcpO1xufVxuY29uc3QgbWVudV9jbG9zZSA9ICgpID0+IHtcbiAgbWVudS5zZXRBdHRyaWJ1dGUoJ2FyaWEtcHJlc3NlZCcsZmFsc2UpO1xuICBpc29wZW4gPSBmYWxzZTtcbiAgbWVudS5jbGFzc0xpc3QuYWRkKCdjbG9zZScpO1xuICBtZW51LmNsYXNzTGlzdC5yZW1vdmUoJ29wZW4nKTtcbiAgYm9keS5jbGFzc0xpc3QucmVtb3ZlKCdsb2NrZWQnKTtcbn1cblxudHJpZ2dlcm1lbnUuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLGZ1bmN0aW9uKCl7XG4gIGlzb3BlbiA/IG1lbnVfY2xvc2UoKSA6IG1lbnVfb3BlbigpO1xufSk7XG5cbnRyaWdnZXJtZW51LmFkZEV2ZW50TGlzdGVuZXIoJ2tleXVwJyxmdW5jdGlvbihlKXtcbiAgaWYoIGUua2V5ID09ICdFc2NhcGUnICYmIGlzb3BlbiA9PSB0cnVlICl7XG4gICAgbWVudV9jbG9zZSgpO1xuICB9XG59KTsiLCIvLyBzY3JvbGwgZXZlbnQgLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG5pbXBvcnQgKiBhcyBzYiBmcm9tICcuL3Njcm9sbF9wcm9ncmVzc19pbmRpY2F0b3IuanMnO1xuaW1wb3J0ICogYXMgZ3YgZnJvbSAnLi9nbG9iYWxfdmFyaWFibGVzLmpzJztcblxuY29uc3QgYmFja3RvcCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5iYWNrdG9wJyk7XG5jb25zdCBiYWNrdG9waW5uZXIgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuYmFja3RvcF9faW5uZXInKTtcbmNvbnN0IGNvbnRlbnRzdGFydCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ21haW4nKTtcbmNvbnN0IGNvbnRlbnRvZmZzZXQgPSBjb250ZW50c3RhcnQuZ2V0Qm91bmRpbmdDbGllbnRSZWN0KCkudG9wICsgcGFnZVlPZmZzZXQ7XG5jb25zdCBoZWFkZXIgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuaGVhZGVyJyk7XG5jb25zdCBhbGxlbGVtcyA9IFtzYi5wcm9ncmVzc19pbmRpY2F0b3IsIGJhY2t0b3BdO1xuY29uc3QgYm9keSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ2JvZHknKTtcbmxldCBzY3JvbGxkZWxheTtcbnZhciBpc2l0ZG93bjtcblxuY29uc3QgYmFja3RvcGZ1bmMgPSAoKSA9PiB7XG4gIGlmIChpc2l0ZG93bil7XG4gICAgZmFkZWluKCk7XG4gICAgaXNpdGRvd24gPSBmYWxzZTtcbiAgfVxuICBjbGVhclRpbWVvdXQoc2Nyb2xsZGVsYXkpO1xuICBzY3JvbGxkZWxheSA9IHNldFRpbWVvdXQoZnVuY3Rpb24oKXtcbiAgICBmYWRlb3V0KCk7XG4gICAgaXNpdGRvd24gPSB0cnVlO1xuICB9LDE1MDApO1xufVxuXG5jb25zdCBmYWRlb3V0ID0gKCkgPT4ge1xuICBiYWNrdG9waW5uZXIuY2xhc3NMaXN0LmFkZCgnZmFkZW91dCcpO1xuICBiYWNrdG9waW5uZXIuY2xhc3NMaXN0LnJlbW92ZSgnZmFkZWluJyk7XG59O1xuY29uc3QgZmFkZWluID0gKCkgPT4ge1xuICBiYWNrdG9waW5uZXIuY2xhc3NMaXN0LnJlbW92ZSgnZmFkZW91dCcpO1xuICBiYWNrdG9waW5uZXIuY2xhc3NMaXN0LmFkZCgnZmFkZWluJyk7XG59O1xuXG5jb25zdCBoaWRlc2hvdyA9IGZ1bmN0aW9uKCl7XG4gIHdpbmRvdy5vbnNjcm9sbCA9ICgpID0+IHtcbiAgICBpZiAoYm9keS5jbGFzc0xpc3QuY29udGFpbnMoJ3NpbmdsZScpKXtcbiAgICAgIHNiLnNjcm9sbGJhcigpO1xuICAgIH1cbiAgICBpZiAoIHdpbmRvdy5wYWdlWU9mZnNldCA8IGNvbnRlbnRvZmZzZXQgKXtcbiAgICAgIGlmIChib2R5LmNsYXNzTGlzdC5jb250YWlucygnc2luZ2xlJykpe1xuICAgICAgICBhbGxlbGVtcy5mb3JFYWNoKCAoZSkgPT4ge1xuICAgICAgICAgIGUuY2xhc3NMaXN0LnJlbW92ZSgndmlzaWJsZScpO1xuICAgICAgICAgIGUuY2xhc3NMaXN0LmFkZCgnaGlkZGVuJyk7XG4gICAgICAgIH0pO1xuICAgICAgfVxuICAgICAgaGVhZGVyLmNsYXNzTGlzdC5yZW1vdmUoJ2hlYWRlci0tc2hhbGxvdycpO1xuICAgIH0gZWxzZSB7XG4gICAgICBpZiAoYm9keS5jbGFzc0xpc3QuY29udGFpbnMoJ3NpbmdsZScpKXtcbiAgICAgICAgYWxsZWxlbXMuZm9yRWFjaCggKGUpID0+IHtcbiAgICAgICAgICBlLmNsYXNzTGlzdC5hZGQoJ3Zpc2libGUnKTtcbiAgICAgICAgICBlLmNsYXNzTGlzdC5yZW1vdmUoJ2hpZGRlbicpO1xuICAgICAgICB9KTtcbiAgICAgIH1cbiAgICAgIGhlYWRlci5jbGFzc0xpc3QuYWRkKCdoZWFkZXItLXNoYWxsb3cnKTtcbiAgICB9XG4gICAgaWYoZ3YubXFfc21hbGwubWF0Y2hlcyl7XG4gICAgICBiYWNrdG9wZnVuYygpO1xuICAgIH1cbiAgfVxufTtcblxuaGlkZXNob3coKTsiLCIvLyBzY3JvbGxiYXIgcHJvZ3Jlc3MgaW5kaWNhdG9yIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG5cbmV4cG9ydCBjb25zdCBwcm9ncmVzc19pbmRpY2F0b3IgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcucHJvZ3Jlc3MtaW5kaWNhdG9yJyk7XG5cbmV4cG9ydCBjb25zdCBzY3JvbGxiYXIgPSAoKSA9PiB7XG4gIHZhciBkaXNwbGF5aGVpZ2h0ID0gd2luZG93LmlubmVySGVpZ2h0O1xuICB2YXIgcGlsbGFyY29udGVudCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5hcnRpY2xlJyk7XG4gIHZhciBib2R5aGVpZ2h0ID0gZG9jdW1lbnQuYm9keS5jbGllbnRIZWlnaHQ7XG4gIHZhciBwaWxsYXJjb250ZW50aGVpZ2h0ID0gcGlsbGFyY29udGVudC5jbGllbnRIZWlnaHQ7XG4gIHZhciBwaWxsYXJjb250ZW50b2Zmc2V0ID0gcGlsbGFyY29udGVudC5vZmZzZXRUb3A7XG4gIHZhciB3aW5TY3JvbGwgPSBkb2N1bWVudC5ib2R5LnNjcm9sbFRvcCB8fCBkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQuc2Nyb2xsVG9wO1xuICB2YXIgd2luU2Nyb2xsX25ldyA9IHdpblNjcm9sbCAtIHBpbGxhcmNvbnRlbnRvZmZzZXQ7XG4gIHZhciB3aW5kU2Nyb2xsX25ld19ib3R0b20gPSB3aW5TY3JvbGxfbmV3ICsgd2luZG93LmlubmVySGVpZ2h0O1xuICB2YXIgc2Nyb2xsZWRwYyA9IHdpbmRTY3JvbGxfbmV3X2JvdHRvbSAvIHBpbGxhcmNvbnRlbnRoZWlnaHQgKiAxMDA7XG4gIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibXlCYXJcIikuc3R5bGUud2lkdGggPSBzY3JvbGxlZHBjICsgXCIlXCI7XG59Il19
