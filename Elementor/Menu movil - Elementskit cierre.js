
/* Remueve la class active para cerrrar el menu cuando se hace tap */


jQuery(document).ready(function($) {
    $('.elementskit-navbar-nav li a').on('click', function() {
        if ($(window).width() < 768) { // Verifica si es dispositivo móvil
            $('.elementskit-menu-container').removeClass('active');
        }
    });
});