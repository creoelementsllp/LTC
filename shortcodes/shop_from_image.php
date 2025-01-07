<?php
function interactive_image_hover_shortcode()
{
    // Start output buffering
    ob_start();
?>
    <div class="interactive-image-hover-container">
        <!-- Background Image -->
        <img class="layer jpg" id="background" src="https://demo.littlethingscute.com/wp-content/uploads/2025/01/image_banner-scaled.jpg" alt="Background">

        <!-- Inline SVGs -->
        <svg class="layer svg" data-name="Kids Pencils" data-link="/" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4032 3024">
            <path d="m1857.5 1251-491.5-10.5 5.5 248.5h-103l-7.5 87.5 7.5 16 3 429 291 2.5 8.5 45 275.5-31.5c-9.6-133.2 65.67-180.17 104.5-187-4.8-13.6.67-61.67 4-84l8-7c-4.8.4-6-2.5-6-4-.8-10.4 5.33-23.67 8.5-29 24.4-15.2 33.17-9 34.5-4l-10 96c2-12 20.5-18.67 29.5-20.5-7.2-8.4-9.33-23.17-9.5-29.5l13 8.5c-12.33-133-37.5-404-39.5-424s-21.17-24.67-30.5-24.5l-71-1.5c-.17-8.67-.4-30.4 0-48s-16.17-26-24.5-28" fill="#D9D9D9" />
        </svg>



        <!-- Add more inline SVGs as needed -->
    </div>
    <style>
        .interactive-image-hover-container {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 75%;
            /* Adjust aspect ratio */
            max-width: 100%;
            display: inline-block;
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

        .layer.svg {
            z-index: 2;
            pointer-events: auto;
            /* SVG is not clickable until made interactive */
        }

        .hovered {
            filter: drop-shadow(0px 0px 5px rgba(255, 255, 0, 0.8));
        }

        .grayscale {
            filter: grayscale(100%);
            filter: drop-shadow(0px 0px 0px rgba(255, 255, 0, 0));
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const svgPaths = document.querySelectorAll(".layer.svg path");
            const background = document.getElementById("background");
            const container = document.querySelector(".interactive-image-hover-container");

            // Tooltip logic
            const tooltip = document.createElement("div");
            tooltip.classList.add("tooltip");
            tooltip.style.position = "absolute";
            tooltip.style.background = "rgba(0, 0, 0, 0.7)";
            tooltip.style.color = "white";
            tooltip.style.padding = "5px 10px";
            tooltip.style.borderRadius = "5px";
            tooltip.style.fontSize = "12px";
            tooltip.style.pointerEvents = "none";
            tooltip.style.visibility = "hidden";
            document.body.appendChild(tooltip);

            svgPaths.forEach((path) => {
                path.addEventListener("mouseenter", (e) => {
                    svgPaths.forEach((p) => p.classList.remove("hovered", "grayscale"));
                    path.classList.add("hovered");

                    svgPaths.forEach((p) => {
                        if (p !== path) {
                            p.classList.add("grayscale");
                        }
                    });

                    background.classList.add("grayscale");

                    // Show tooltip
                    const svg = path.closest("svg");
                    tooltip.innerText = svg.dataset.name || "Hovered Element";
                    tooltip.style.visibility = "visible";
                });

                path.addEventListener("mouseleave", () => {
                    svgPaths.forEach((p) => p.classList.remove("hovered", "grayscale"));
                    background.classList.remove("grayscale");

                    // Hide tooltip
                    tooltip.style.visibility = "hidden";
                });

                path.addEventListener("mousemove", (e) => {
                    tooltip.style.left = e.pageX + 10 + "px";
                    tooltip.style.top = e.pageY + 10 + "px";
                });

                path.addEventListener("click", () => {
                    const svg = path.closest("svg");
                    const link = svg.dataset.link;
                    if (link) {
                        window.location.href = link;
                    }
                });
            });

            container.addEventListener("mouseleave", () => {
                svgPaths.forEach((p) => p.classList.remove("hovered", "grayscale"));
                background.classList.remove("grayscale");

                // Hide tooltip
                tooltip.style.visibility = "hidden";
            });
        });
    </script>
<?php
    return ob_get_clean();
}

add_shortcode('shop_from_image', 'interactive_image_hover_shortcode');
