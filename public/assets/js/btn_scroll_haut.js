"use strict"

const btn_scroll_haut = document.querySelector('.btn-scroll-haut');

window.addEventListener('scroll', () => {
    if(window.scrollY > 300) {
        btn_scroll_haut.classList.remove('invisible');
        btn_scroll_haut.classList.add('visible');
    } else {
        btn_scroll_haut.classList.remove('visible');
        btn_scroll_haut.classList.add('invisible');
    }
})