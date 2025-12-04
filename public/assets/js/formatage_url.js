"use strict"

window.addEventListener('load', () => {

    const pageFromHash = window.location.hash.substring(1);

    if(pageFromHash) {
        const section = document.getElementById(pageFromHash);

        if(section) section.style.dysplay = 'block';

        history.replaceState({}, '', '/' + pageFromHash);
    }

});