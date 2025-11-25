"use strict"

let formContact = document.getElementById("form-contact");
let champsContact = document.querySelectorAll(".element-form");
let mail = document.getElementById("mail");
let errors = document.querySelectorAll("p.errors");

formContact.addEventListener("submit", (event) => {
        event.preventDefault();

        let isValid = true;

        errors.forEach(err => err.textContent = "");


  champsContact.forEach(champContact => {

    const errorElement = champContact.nextElementSibling;
    const errorMail = mail.nextElementSibling;

    if(champContact.value.trim() === "" && message.value.trim() === "") {
        errorElement.innerText = "* Ce champ ne peut pas être vide.";
        isValid = false;
    }

    if(mail.value != "" && !isEmailValid(mail.value)) {
        errorMail.innerText = "* Email non valide";
    } 

  });

    if(!isValid) {
        formContact.submit();
    }

},
);

function isEmailValid(mail) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(mail);
}
