$(document).ready(function(){
    $('.slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });
});

function disable() {
    var myDiv = document.getElementById("xclik");
    myDiv.style.display = "none";
}

setTimeout(function() {
    var alertElement = document.getElementById("alert");
    if (alertElement) {
      alertElement.style.display = "none";
    }
}, 3000);