"use strict"

let formContact = document.forms["contact-form"];
let champsContact = document.querySelectorAll(".element-form");
let mail = document.getElementById("mail");
let nom = document.getElementById("nom");
let objet = document.getElementById("object");
let message = document.getElementById("message");
let errors = document.querySelectorAll("p.errors");

let minLength = 2;
let maxLength = 50;

let minLgth = 3;
let maxLgth = 80;

let min = 10;
let max = 800;

formContact.addEventListener("submit", (event) => {

        event.preventDefault();
        let isValid = true;

        errors.forEach(err => err.textContent = "");


  champsContact.forEach(champContact => {


    const errorElement = champContact.nextElementSibling;
    const errorMail = mail.nextElementSibling;
    const errorNom = nom.nextElementSibling;
    const errorObjet = objet.nextElementSibling;
    const errorMessage = message.nextElementSibling;

    if(champContact.value.trim() === "" && message.value.trim() === "") {
        errorElement.innerText = "* Ce champ ne peut pas être vide.";
        isValid = false;
    }

    if(nom.value != "" && nom.value.length < minLength || nom.value.length > maxLength) {
        errorNom.innerText = "* Le nom doit contenir entre "+ minLength + " et " + maxLength +  " caractères.";
        isValid = false;
    } 
    
    if(mail.value != "" && !isEmailValid(mail.value)) {
        errorMail.innerText = "* Email non valide";
        isValid = false;
    } 

    if(objet.value != "" && objet.value.length < minLgth || objet.value.length > maxLgth) {
        errorObjet.innerText = "* L'objet doit contenir entre "+ minLgth + " et " + maxLgth +  " caractères.";
        isValid = false;
    }

    if(message.value != "" && message.value.length < min || message.value.length > max) {
        errorMessage.innerText = "* Le message doit contenir entre "+ min + " et " + max +  " caractères.";
        isValid = false;
    }



  });

    if(isValid) {
        formContact.submit();
    }

},
);

function isEmailValid(mail) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(mail);
}
