// script.js

window.addEventListener('DOMContentLoaded', function() {
    const formElements = document.querySelectorAll('.formulaire input, .formulaire select, .formulaire label, .formulaire input[type="submit"]');
    
    formElements.forEach((element, index) => {
        setTimeout(() => {
            element.style.animation = 'fadeInUp 0.8s forwards';
        }, index * 100); // Adjust the delay to your preference
    });
});