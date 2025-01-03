<?php

function interactive_image_hover_shortcode() {
    // Return HTML with inline CSS
    ob_start(); ?>
    <div class="interactive-image-hover-container">
        <!-- Background JPG -->
        <img class="layer jpg" id="background" src="https://demo.littlethingscute.com/wp-content/uploads/2024/12/bg-model-scaled.jpg" alt="Background">

        <!-- Transparent PNGs -->
        <img class="layer png" id="png1" src="https://demo.littlethingscute.com/wp-content/uploads/2024/12/item-1.png" alt="Overlay 1">
        <img class="layer png" id="png2" src="https://demo.littlethingscute.com/wp-content/uploads/2024/12/item2.png" alt="Overlay 2">
        <img class="layer png" id="png3" src="https://demo.littlethingscute.com/wp-content/uploads/2024/12/item3.png" alt="Overlay 3">
        <img class="layer png" id="png4" src="https://demo.littlethingscute.com/wp-content/uploads/2024/12/item4.png" alt="Overlay 4">
    </div>
    <style>
        .interactive-image-hover-container {
            position: relative;
            width: 100%; /* Default to 100% width */
            height: 0;
            padding-bottom: 66.5%; /* Aspect ratio for 2048x1365 image */
            max-width: 100%; /* Adjust this to control container size */
            display: inline-block; /* To make it respect parent container's width */
            border-radius: 20px;
            overflow: hidden;
        }

        .layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transition: filter 0.5s ease;
        }

        .layer.jpg {
            z-index: 1;
        }

        .layer.png {
            z-index: 2;
            pointer-events: none;
            transition: filter 0.5s ease;
        }

        .hovered {
            filter: drop-shadow(0px 0px 15px rgba(255, 255, 0, 0.8));
        }

        .grayscale {
            filter: grayscale(100%);
            filter: drop-shadow(0px 0px 0px rgba(255, 255, 0, 0));
        }
    </style>
    <script>
        const pngLayers = document.querySelectorAll(".layer.png");
        const background = document.getElementById("background");
        const container = document.querySelector(".interactive-image-hover-container");

        pngLayers.forEach((png) => {
            const canvas = document.createElement("canvas");
            const ctx = canvas.getContext("2d");
            const img = new Image();

            img.src = png.src;
            img.onload = () => {
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);

                // Add mousemove event to detect hover over visible parts of PNG
                container.addEventListener("mousemove", (e) => {
                    const rect = container.getBoundingClientRect();

                    // Check if the container is scaled
                    const scaleX = img.width / rect.width;
                    const scaleY = img.height / rect.height;

                    // Calculate the position within the image
                    const x = (e.clientX - rect.left) * scaleX;
                    const y = (e.clientY - rect.top) * scaleY;

                    // Get pixel data at the mouse position
                    const pixel = ctx.getImageData(x, y, 1, 1).data;
                    const alpha = pixel[3];

                    if (alpha > 0) {
                        pngLayers.forEach((layer) => layer.classList.remove("hovered", "grayscale"));
                        png.classList.add("hovered");

                        pngLayers.forEach((layer) => {
                            if (layer !== png) {
                                layer.classList.add("grayscale");
                            }
                        });

                        background.classList.add("grayscale");
                        // console.log(`Hovered over visible area of: ${png.id}`);
                    }
                });
            };
        });

        container.addEventListener("mouseleave", () => {
            pngLayers.forEach((layer) => layer.classList.remove("hovered", "grayscale"));
            background.classList.remove("grayscale");
        });
    </script>
    <?php
    return ob_get_clean();
}

add_shortcode('shop_from_image', 'interactive_image_hover_shortcode');
