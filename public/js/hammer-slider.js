var slideIndex = 1;

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
}

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

showSlides(slideIndex);

$(document).ready(function() {
    $('.next-slide').on('click', function(e) {
        var valid = true;
        var $currentSlide, $inputs;

        e.preventDefault();

        if ($(this).hasClass('verify-slide')) {
            console.log('clicked');
            $currentSlide = $(this).parents('.mySlides');

            $inputs = $currentSlide.find('input,textarea,select');

            $inputs.each(function() {
                if(!this.reportValidity()) {
                    valid = false;
                }
            });
        }

        if (valid) {
            plusSlides(1);
        }
    });

    $('.prev-slide').on('click', function(e) {
        e.preventDefault();
        plusSlides(-1);
    })
});
