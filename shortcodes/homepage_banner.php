<?php
function homepage_banner_shortcode() {
    ?>
    <div class="swiper homepage_banner">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="https://demo.littlethingscute.com/wp-content/uploads/2025/01/2.png" alt="Little Things Cute Banner">
            </div>
            <div class="swiper-slide">
                <img src="https://demo.littlethingscute.com/wp-content/uploads/2025/01/3.png" alt="Little Things Cute Banner">
            </div>
            <div class="swiper-slide">
                <img src="https://demo.littlethingscute.com/wp-content/uploads/2025/01/4.png" alt="Little Things Cute Banner">
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <style>
        .swiper {
            min-height: 60vh;
            width: 100%;
            height: 100%;
        }
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .swiper.homepage_banner {
    border-radius: 20px;
}
        @media screen and (max-width: 1024px) {
            .swiper {
                min-height: 100%;
                width: 100%;
                height: 100%;
            }
            .swiper {
                min-height: 32vw;
                width: 100%;
                height: 100%;
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var homepage_banner_swiper = new Swiper(".homepage_banner", {
                pagination: {
                    el: ".homepage_banner .swiper-pagination",
                },
            });
        });
    </script>
    <?php
}
add_shortcode('hompeage_banner', 'homepage_banner_shortcode');
