new WOW().init();
$('.sliders').slick({
    dots: true,
    arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 50000,
    infinite: true
});
$('.button-section').on('click', function(){
    $('ul.top-menu').slideToggle();
});
if($(window).width() > 768) {
    $('.most-popular-products').slick({
        dots: false,
        arrows: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        infinite: true
    });
} else if($(window).width() <= 768 && $(window).width() >=576) {
    $('.most-popular-products').slick({
        dots: false,
        arrows: false,
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        infinite: true
    });
} else {
    $('.most-popular-products').slick({
        dots: false,
        arrows: false,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        infinite: true
    });
}