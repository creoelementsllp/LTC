document.addEventListener('DOMContentLoaded', function () {
  let productCardsSwiper;

  // Function to initialize the Swiper based on screen size
  function initializeSwiper() {
    const screenWidth = window.innerWidth;

    // Destroy existing Swiper instance if it exists
    if (productCardsSwiper) {
      productCardsSwiper.destroy(true, true);
    }

    // Initialize Swiper with different slidesPerView based on screen width
    if (screenWidth < 768) {
      productCardsSwiper = new Swiper(".custom-product-cards", {
        slidesPerView: 2,
        spaceBetween: 20,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    } else {
      productCardsSwiper = new Swiper(".custom-product-cards", {
        slidesPerView: 4,
        spaceBetween: 20,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    }
  }

  // Initialize the Swiper on page load
  initializeSwiper();

  // Reinitialize the Swiper on window resize
  window.addEventListener('resize', function () {
    initializeSwiper();
  });
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

  

  // Synchronize the two swipers
  homepageSwiper.on('slideChange', function () {
    productCardsSwiper.slideTo(homepageSwiper.activeIndex * 4);
  });

  productCardsSwiper.on('slideChange', function () {
    homepageSwiper.slideTo(Math.floor(productCardsSwiper.activeIndex / 4));
  });





});

