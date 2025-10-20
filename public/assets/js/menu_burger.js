const menu = document.querySelector('.fa-bars');
const nav = document.querySelector('.menu-hidden');

menu.addEventListener('click', () => {
    if(nav.classList.contains('menu-hidden')) {
        nav.classList.remove('menu-hidden');
        nav.classList.add('manu-active');
        menu.classList.remove('fa-bars');
        menu.classList.add('fa-xmark');
    } else {
        nav.classList.remove('menu-active');
        nav.classList.add('menu-hidden');
        menu.classList.remove('fa-xmark');
        menu.classList.add('fa-bars');
    }
});