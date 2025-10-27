const btn_scroll_haut = document.querySelector('.btn-scroll-haut');
const section_accueil = document.getElementById('accueil');
const section_a_propos = document.getElementById('a-propos');


section_a_propos.addEventListener('touchstart', () => {
    if(section_a_propos){
        btn_scroll_haut.classList.remove('scroll-haut-hidden');
    }  
});

section_accueil.addEventListener('touchend', () => {
    if(section_accueil) {
        btn_scroll_haut.classList.add('scroll-haut-hidden');
    }
});

btn_scroll_haut.addEventListener('click', () => {
        btn_scroll_haut.classList.add('scroll-haut-hidden');
});
