<?php
function swiper_video_shortcode()
{
    // Output the HTML
    ob_start();
?>
    <div class="swiper video-swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="https://littlethingscute.com/wp-content/uploads/2025/01/ezgif-frame-001.jpg" alt="Luggage Tags">
                <video src="https://littlethingscute.com/wp-content/uploads/2025/01/Untitled-video-Made-with-Clipchamp-13.mp4" preload="metadata" muted></video>
                <div class="play-button"></div>
                <a href="/product-category/travel-accessories/luggage-tags/" class="video-category-title">Luggage Tags</a>
            </div>
            <div class="swiper-slide">
                <img src="https://littlethingscute.com/wp-content/uploads/2024/12/ltc-first-frame.jpg" alt="Earrings">
                <video src="https://littlethingscute.com/wp-content/uploads/2024/12/ltc-video.mp4" preload="metadata" muted></video>
                <div class="play-button"></div>
                <a href="/product-category/fashion-accessories/earrings/" class="video-category-title">Earrings</a>
            </div>
            <div class="swiper-slide">
                <img src="https://littlethingscute.com/wp-content/uploads/2025/01/charms_frame.jpg" alt="Charms">
                <video src="https://littlethingscute.com/wp-content/uploads/2025/01/charms.mp4" preload="metadata" muted></video>
                <div class="play-button"></div>
                <a href="/product-category/fashion-accessories/charms/" class="video-category-title">Charms</a>
            </div>
            <div class="swiper-slide">
                <img src="https://littlethingscute.com/wp-content/uploads/2025/01/magnets_frame.jpg" alt="Fridge Magnets">
                <video src="https://littlethingscute.com/wp-content/uploads/2025/01/magnets.mp4" preload="metadata" muted></video>
                <div class="play-button"></div>
                <a href="/product-category/home-living/fridge-magnets/" class="video-category-title">Fridge Magnets</a>
            </div>
            <div class="swiper-slide">
                <img src="https://littlethingscute.com/wp-content/uploads/2025/01/ltc-new-video.jpg" alt="hair accessories">
                <video src="https://littlethingscute.com/wp-content/uploads/2025/01/LTC-video-new.mp4" preload="metadata" muted></video>
                <div class="play-button"></div>
                <a href="/product-category/fashion-accessories/hair-accessories/" class="video-category-title">Hair Accessories</a>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <style>
        .swiper.video-swiper .swiper-slide {
            border-radius: 20px !important;
            overflow: hidden;
        }

        .swiper {
            width: 100%;
            margin: 0 auto;
        }

        .swiper.video-swiper {
            margin: 0px;
        }

        .swiper.video-swiper .swiper-slide {
            width: calc(18vw - 20px);
            display: flex;
            flex-direction: column;
            background-color: #dee8e7;
        }

        .swiper.video-swiper .swiper-slide img {
            border-radius: 20px;
        }

        .swiper-slide video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;

            border-radius: 20px !important;
        }

        .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            z-index: 2;
        }

        .play-button::before {
            content: '';
            display: block;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 10px 0 10px 20px;
            border-color: transparent transparent transparent white;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Preload videos in the background
            const videos = document.querySelectorAll('.video-swiper video');
            videos.forEach(video => {
                video.load(); // Ensure all videos are prepared to play instantly
            });

            var swiper = new Swiper(".video-swiper", {
                slidesPerView: 2,
                spaceBetween: 20,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 4,
                        spaceBetween: 40,
                    },
                    1024: {
                        slidesPerView: 5,
                        spaceBetween: 50,
                    },
                }
            });

            document.querySelectorAll('.video-swiper .swiper-slide').forEach(slide => {
                const video = slide.querySelector('video');
                const thumbnail = slide.querySelector('img');
                const playButton = slide.querySelector('.play-button');

                // Add event listener for video load
                video.addEventListener('canplay', () => {
                    // Ensure the thumbnail is hidden only when the video is ready
                    thumbnail.style.display = 'none';
                    video.style.display = 'block';
                });

                // Toggle video on click
                slide.addEventListener('click', () => {
                    if (video.style.display === 'block' && !video.paused) {
                        video.pause();
                        playButton.style.display = 'flex';
                    } else {
                        // Show video only when it's ready
                        if (video.readyState >= 3) { // Ready state 3 ensures the video is ready to play
                            thumbnail.style.display = 'none';
                            video.style.display = 'block';
                            video.play();
                            playButton.style.display = 'none';
                        }
                    }
                });

                // Hover functionality (larger screens only)
                slide.addEventListener('mouseenter', () => {
                    if (window.innerWidth >= 768) {
                        if (video.readyState >= 3) {
                            thumbnail.style.display = 'none';
                            video.style.display = 'block';
                            video.play();
                            playButton.style.display = 'none';
                        }
                    }
                });

                slide.addEventListener('mouseleave', () => {
                    if (window.innerWidth >= 768) {
                        video.pause();
                        playButton.style.display = 'flex';
                    }
                });
            });
        });
    </script>
<?php
    return ob_get_clean();
}
add_shortcode('ltc_videos', 'swiper_video_shortcode');
