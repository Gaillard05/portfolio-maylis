"use strict"

let identite = document.querySelector(".identite");
let contenu_identite = identite.innerHTML;
let profession = document.querySelector(".profession");
let contenu_profession = profession.innerHTML;

identite.innerHTML = '';
profession.innerHTML = '';

let index = 0;

let timer  = setInterval(function(){
    if(index < contenu_identite.length || index < contenu_profession.length) {
        identite.innerHTML += contenu_identite.charAt(index);
        profession.innerHTML += contenu_profession.charAt(index);
        index++;
    } else {
        clearInterval(timer);
    }
}, 150)