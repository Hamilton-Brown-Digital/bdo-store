// scrollbar progress indicator -----------------------------

export const progress_indicator = document.querySelector('.progress-indicator');

export const scrollbar = () => {
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
}