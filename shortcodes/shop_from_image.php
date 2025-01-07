<?php

function interactive_image_hover_shortcode() {
    ob_start(); ?>
    <div class="interactive-image-hover-container">
        <!-- Background JPG -->
        <img class="layer jpg" id="background" src="https://demo.littlethingscute.com/wp-content/uploads/2025/01/image_banner-scaled.jpg" alt="Background">

        <!-- Transparent PNGs -->
        <?php
        $overlays = [
            ['name' => 'Kids Pencils', 'link' => '/', 'src' => 'https://demo.littlethingscute.com/wp-content/uploads/2025/01/pencil_banner_part.png'],
            ['name' => 'Earrings', 'link' => '/', 'src' => 'https://demo.littlethingscute.com/wp-content/uploads/2025/01/earings_banner_part.png'],
            ['name' => 'Travel Tag', 'link' => '/', 'src' => 'https://demo.littlethingscute.com/wp-content/uploads/2025/01/travel_Tag_banner_part.png'],
            ['name' => 'Charms 2', 'link' => '/', 'src' => 'https://demo.littlethingscute.com/wp-content/uploads/2025/01/charms_2_banner_part.png'],
            ['name' => 'Diary', 'link' => '/', 'src' => 'https://demo.littlethingscute.com/wp-content/uploads/2025/01/diary_banner_part.png'],
            ['name' => 'Charms', 'link' => '/', 'src' => 'https://demo.littlethingscute.com/wp-content/uploads/2025/01/charms_banner_part.png'],
            ['name' => 'Magnets', 'link' => '/', 'src' => 'https://demo.littlethingscute.com/wp-content/uploads/2025/01/magnets_banner_part.png'],
            ['name' => 'Earrings 2', 'link' => '/', 'src' => 'https://demo.littlethingscute.com/wp-content/uploads/2025/01/earrings_2_banner_part.png'],
        ];

        foreach ($overlays as $index => $overlay) {
            echo '<img class="layer png" data-name="' . $overlay['name'] . '" data-link="' . $overlay['link'] . '" src="' . $overlay['src'] . '" alt="Overlay ' . ($index + 1) . '">';
        }
        ?>
    </div>
    <style>
        .interactive-image-hover-container {
            position: relative;
            width: 100%;
            padding-bottom: 66.5%; /* Maintain aspect ratio */
            border-radius: 20px;
            overflow: hidden;
            display: inline-block;
        }

        .layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transition: filter 0.3s ease;
        }

        .layer.jpg {
            z-index: 1;
        }

        .layer.png {
            z-index: 2;
            pointer-events: none;
        }

        .hovered {
            filter: drop-shadow(0px 0px 5px rgba(255, 255, 0, 0.8));
        }

        .grayscale {
            filter: grayscale(100%);
        }

        .tooltip {
            position: absolute;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            pointer-events: none;
            visibility: hidden;
            transition: opacity 0.2s ease;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const container = document.querySelector(".interactive-image-hover-container");
            const pngLayers = document.querySelectorAll(".layer.png");
            const background = document.getElementById("background");

            // Create a tooltip
            const tooltip = document.createElement("div");
            tooltip.classList.add("tooltip");
            document.body.appendChild(tooltip);

            // Single canvas for pixel detection
            const canvas = document.createElement("canvas");
            const ctx = canvas.getContext("2d");

            let activeLayer = null;

            container.addEventListener("mousemove", (e) => {
                const rect = container.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                pngLayers.forEach((layer) => {
                    if (!activeLayer || activeLayer !== layer) {
                        const img = new Image();
                        img.src = layer.src;

                        img.onload = () => {
                            canvas.width = img.width;
                            canvas.height = img.height;
                            ctx.drawImage(img, 0, 0);

                            const scaleX = img.width / rect.width;
                            const scaleY = img.height / rect.height;
                            const pixel = ctx.getImageData(x * scaleX, y * scaleY, 1, 1).data;

                            if (pixel[3] > 0) {
                                // Show hovered state
                                layer.classList.add("hovered");
                                pngLayers.forEach((l) => l !== layer && l.classList.add("grayscale"));
                                background.classList.add("grayscale");

                                // Update tooltip
                                tooltip.innerText = layer.dataset.name;
                                tooltip.style.left = e.pageX + 10 + "px";
                                tooltip.style.top = e.pageY + 10 + "px";
                                tooltip.style.visibility = "visible";
                                activeLayer = layer;
                            } else {
                                // Remove hovered state
                                if (activeLayer) {
                                    activeLayer.classList.remove("hovered");
                                    pngLayers.forEach((l) => l.classList.remove("grayscale"));
                                    background.classList.remove("grayscale");
                                    tooltip.style.visibility = "hidden";
                                    activeLayer = null;
                                }
                            }
                        };
                    }
                });
            });

            container.addEventListener("mouseleave", () => {
                pngLayers.forEach((layer) => layer.classList.remove("hovered", "grayscale"));
                background.classList.remove("grayscale");
                tooltip.style.visibility = "hidden";
            });

            pngLayers.forEach((layer) => {
                layer.addEventListener("click", () => {
                    const link = layer.dataset.link;
                    if (link) {
                        window.location.href = link;
                    }
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

add_shortcode('shop_from_image', 'interactive_image_hover_shortcode');
