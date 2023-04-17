/**
 * Set display to none of selected HTMLElement in condition that class 'hiden{display:none;}' exists
 * @param {HTMLElement} element 
 */

function hide(element) {
    element.classList.toggle('hidden');
};

hide(document.getElementById('room'));