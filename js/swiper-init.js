document.addEventListener('DOMContentLoaded', function () {

  var recent_swiper = new Swiper(".custom-recently-viewed-products", {
    slidesPerView: 2,
    spaceBetween: 20,
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 4,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 5,
        spaceBetween: 20,
      },
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  var homepageSwiper = new Swiper(".homepage_banner", {
    pagination: {
      el: ".homepage_banner .swiper-pagination",
    },
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
  });

  // Initialize the custom product cards swiper
  var productCardsSwiper = new Swiper(".custom-product-cards", {
    spaceBetween: 20,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      640: { // Mobile devices
        slidesPerView: 2,
      },
      768: { // Tablets
        slidesPerView: 2,
      },
      1024: { // Desktop
        slidesPerView: 4,
      },
    },
  });
  

  // Synchronize the two swipers
  homepageSwiper.on('slideChange', function () {
    productCardsSwiper.slideTo(homepageSwiper.activeIndex * 4);
  });

  productCardsSwiper.on('slideChange', function () {
    homepageSwiper.slideTo(Math.floor(productCardsSwiper.activeIndex / 4));
  });





});
