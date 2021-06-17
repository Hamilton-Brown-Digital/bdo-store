// page nav -------------------------------------------------

const pagenav = document.querySelector('.page-nav');
const pagenavtrigger = document.querySelector('.page-nav-trigger');
const pagenavdropdown = document.querySelector('.page-nav__dropdown__dropdown');
const dropdown_link = document.querySelectorAll('.dropdown_link');



const pagenavshow = () => {
  pagenav.classList.remove('hidden');
  pagenav.classList.add('visible');
}
const pagenavhide = () => {
  pagenav.classList.add('hidden');
  pagenav.classList.remove('visible');
}




const makevisible = () => {
    pagenavdropdown.classList.remove('hidden');
    pagenavdropdown.classList.add('visible');
}
const makehidden = () => {
    pagenavdropdown.classList.remove('visible');
    pagenavdropdown.classList.add('hidden');
}



pagenavtrigger.addEventListener('mouseover', () => {
  if (pagenavdropdown.classList.contains('hidden')){
    makevisible();
  }
})

pagenavtrigger.addEventListener('mouseout', () => {
  if (pagenavdropdown.classList.contains('visible')){
    makehidden();
  }
})


dropdown_link.forEach( (e) => {
  e.addEventListener('click', (c) => {
    makehidden();
  })
});



export {pagenav};