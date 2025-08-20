(function(){
    const swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        480:{
            slidesPerView: 1
        },
        768: {
            slidesPerView: 3
        },
        1024: {
            slidesPerView: 4
        }
    },
    autoplay: {
        delay: 5000,
    }
    
    });
})();