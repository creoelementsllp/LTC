<?php
function interactive_image_hover_shortcode()
{
    // Start output buffering
    ob_start();
?>
    <div class="interactive-image-hover-container">
        <!-- Background Image -->
        <img class="layer jpg" id="background" src="https://demo.littlethingscute.com/wp-content/uploads/2025/01/ltc-product-banner.png" alt="Background">

        <!-- Inline SVGs -->
        <svg class="layer svg" data-name="Diaries" data-link="/product-category/stationery/diaries/" viewBox="0 0 2240 1260" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M985.5 372 751 368.45l-17.5 10.05L739 496l-58.5 3.5L676 555l-21.5 221.651h74l8-14.151h14l-6-8V723l10-12h8v-8l-5.5-8v-15.5l14-9.5 16.5 3 5 16-5 12.5L775 706v3h7.5l7 9.5V749h8.5l14 19.347 3 8.304h12.5V799.5h22l-7-22.849 11.5-8.304L866 749l10.5 1.5-2-16v-21l7-9.5 10.5-4.5V695l-8-1.5-5-5.5v-17.5l13-9 14 2.5 6.5 9v9l-4 7-8 6 1.5 3h4l5 1.5 7 9.5v28l-1.5 5 13.5 2.5 15.5 23.847-7 20.153h9l5.5-9 11.5-5c-5.102-69.132 43.59-91.359 64.23-94.904-2.55-7.058.36-32.007 2.13-43.597l4.25-3.633c-2.55.208-3.19-1.297-3.19-2.076-.42-5.397 2.83-12.285 4.52-15.051 12.97-7.889 17.63-4.671 18.34-2.076L1043 657l3 13.152c1.06-6.228 14.36-15.702 19.14-16.652-3.83-4.36-4.96-13.177-5.05-16.463L1075 643.5c-6.55-69.028-17.94-210.12-19-220.5s-10.54-13.588-15.5-13.5l-36.5-3c1 .056-.21-11.865 0-21s-14.073-12.462-18.5-13.5" fill="#D9D9D900" />
        </svg>

        <svg class="layer svg" data-name="Earings" data-link="/product-category/fashion-accessories/jewellery/earrings-jewellery/" viewBox="0 0 2240 1260" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="m746 756.5.5-30c2.4-8.4 11-11.667 15.5-12l2.5-3v-8c-1.667-.333-4.9-3.3-6.5-12.5-2-11.5 11-13.5 20-14 7.2-.4 11.333 5.5 12.5 8.5v7c0 5.2-7.667 10.5-11.5 12.5h-8v6.289c.657-.032 2.24.007 5.5.211 6.4.4 10.333 6.167 11.5 9v29c0 3.2-2 6-3 7l9-1.5 10.5 8.5L811 777c7.2.8 9 3.667 9 5 10 49-42 64-65.5 59.5s-38-34-38.5-40.5c-.4-5.2 4.5-14.833 7-19l7-2.5 3-8 5.5-7 14-1zM893.5 700v-4.5c-16-1-14.5-18-13.5-20.5s15.5-19 27.5-4.5c9.6 11.6-2 21.5-9 25l1 5.5c-.667.5-.4 1.3 6 .5s10.333 6.333 11.5 10c-.167 7.5-.4 23.3 0 26.5s-2.5 6.333-4 7.5c5-1 15.5 1 16 2.5.4 1.2 7.5 13.167 11 19 1 20.167-6.7 59.7-45.5 56.5-48.5-4-48.5-39.5-47.5-41 .8-1.2 8.667-10.833 12.5-15.5-1.2-7.6 3.5-9.167 6-9l4-4h12v-1c1.667.833 4 1.9 0-.5s-5-5-5-6c.167-7.833.4-25 0-31s10.167-11.167 15.5-13z" fill="#D9D9D900" />
        </svg>

        <svg class="layer svg" data-name="Travel Tags" data-link="/product-category/travel-accessories/travel-tags/" viewBox="0 0 2240 1260" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1028.5 679.5c-51.829 11.593-66.177 68.329-64.171 95.816 8.525.09-16.482-2.004-17.826 21.263-1.076 18.613 11.298 24.095 17.62 24.512-5.299 7.007-10.362 17.679 2.731 28.018 10.475 8.271 22.548.498 27.275-4.422.264 1.049 13.871 15.055 29.081 6.583 12.18-6.778 13.31-18.432 12.35-23.413 2.21-.604 5.72-3.167 7.2-4.371l3.85.041c-9.3 5.343-6.59 15.976-4.07 20.622-7.5 7.245-9.82 18.469-.32 30.34 7.6 9.496 22.06 4.155 28.33.297 13.02 17.087 25.8 5.069 30.56-3.079 4.37 2.923 21.09 8.33 29.21-5.71 6.5-11.232-1.1-26.17-5.71-32.234l-3.99-91.595c-5.38-53.21-51.28-66.457-73.56-66.43-2.46-1.423-6.58-7.498-3.36-20.438 4.02-16.176 6.27-22.423 6.3-25.3.02-2.302-2.85-5.31-4.5-5.5 2.21-.762 7.57-1.47 9-11.5s-10.8-2.633-18 2c-.57 1.736-2.58 5.324-3.5 9.5s-2.5 7 2 8l-4 3.5c-2 10-1.5 4-2.5 18.5-2.76 11.69-1.07 21.677 0 25" fill="#85797900" />
        </svg>

        <svg class="layer svg" data-name="Stationery" viewBox="0 0 2240 1260" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="m436 1098.5-3.5 80.5c3 0 24.5 13.5 53.5 11 23.2-2 60 7.83 75.5 13l255-290.5 16-14-16-3.5v-39.5l-94-14-99 86.5-16-415.5V496h-4v-49.5c0-7.2-6.333-9-9.5-9-32.667.667-99.2 2-104 2s-5.333 4.667-5 7V500h-3l-7.5 18.5 25 471.5c5.2 1.2 24.833 14.83 34 21.5z" fill="#D9D9D900" />
        </svg>

        <svg class="layer svg" data-name="Earings" data-link="/product-category/fashion-accessories/jewellery/earrings-jewellery/" viewBox="0 0 2240 1260" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1331 723.905c-2.74 23.84-27.24 29.045-39.14 28.665-33.36-6.584-38.28-34.148-36.56-47.112 9.49-26.4 25.68-29.113 36.78-28.296-.05-5.835 2.69-7.975 4.07-8.315-2.06-3.633-3.15-6.624-3.43-7.663-1.14-16.143 8.28-15.893 12-16.177 3.71-.284 18.85 7.947 13.71 18.731s-17.43 7.947-17.43 9.082c0 .908-1.9 3.786-2.85 5.109 10.28 1.703 36.28 16.177 32.85 45.976m22.57 37.179c-16.23-10.217-18.57-28.664-17.71-36.611 2.97-15.439 14.38-24.22 19.71-26.678 7.59-3.212 14.61-4.336 20.85-4.2.02-2.214.39-7.192 1.72-8.287 1.71-1.419-11.15-.284-12.86-13.339s15.43-14.474 16.85-13.907c1.43.568 16 4.541 11.43 15.326-3.66 8.628-8 11.539-9.71 11.92.76 1.964 1.66 6.499-.86 8.906 11.21 1.89 19 7.538 21.71 10.393 4.57 4.824 20.57 23.556 9.43 45.409s-40.28 23.84-60.56 11.068" fill="#D9D9D900" />
        </svg>

        <svg class="layer svg" data-name="Fridge Magnets" data-link="/product-category/home-living/fridge-magnets/" viewBox="0 0 2240 1260" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1477 241.5c4.8 4 7.33 1.667 8 0 28.5-25 47.5-56 29.5-66.5-14.4-8.4-27.33 2.167-32 8.5-1.83-5.167-9.4-14.1-25-8.5s-11.83 22.667-8 30.5c7.17 10.333 22.7 32 27.5 36" fill="#D9D9D900" />
            <circle cx="1561" cy="608" r="33" fill="#D9D9D900" />
            <ellipse cx="1466" cy="536" rx="34" ry="35" fill="#D9D9D900" />
            <ellipse cx="1363.5" cy="494.5" rx="29.5" ry="30.5" fill="#D9D9D900" />
            <ellipse cx="1471.5" cy="412" rx="31.5" ry="31" fill="#D9D9D900" />
            <ellipse cx="1576" cy="371.5" rx="33" ry="32.5" fill="#D9D9D900" />
            <circle cx="1586.5" cy="281.5" r="33.5" fill="#D9D9D900" />
            <ellipse cx="1472.5" cy="294" rx="35.5" ry="36" fill="#D9D9D900" />
            <ellipse cx="1384.5" cy="259.5" rx="30.5" ry="31.5" fill="#D9D9D900" />
            <rect x="1535" y="464" width="76" height="73" rx="4" fill="#D9D9D900" />
            <path d="M1334.13 564.168c-.62-3.917 2.14-7.564 6.07-8.041l52.06-6.31a7 7 0 0 1 7.76 5.896l8.35 54.88a7 7 0 0 1-6.34 8.029l-52.05 4.338a6.996 6.996 0 0 1-7.49-5.884z" fill="#D9D9D900" />
            <rect x="1307.94" y="361.776" width="68.945" height="68.945" rx="7" transform="rotate(-32.546 1307.94 361.776)" fill="#D9D9D900" />
        </svg>

        <svg class="layer svg" data-name="Charms" data-link="/product-category/fashion-accessories/charms/" viewBox="0 0 2240 1260" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1195 853c-7.2-2.4 1-13 6-18h20l16 2.5-3.5 17c7.6-2.884 8.17 5.798 7.5 10.5 5.2-2 9.5.833 11 2.5 1-2.167 4.8-3.7 12 7.5s-6 9-13.5 6.5c-12 .8-14-1.667-13.5-3h-5c-1.5 0-6 2.5-8 0-1.6-2 .67-7.167 2-9.5-1.2-3.6.5-8.5 1.5-10.5-7.83-.833-25.3-3.1-32.5-5.5m57-18.5-3 1.5c-6.4.4-9-1.833-9.5-3-4.67.5-13.9.3-13.5-4.5s9.5-5 14-4.5c-.33-.833 0-2.8 4-4s4.33 2.167 4 4c2.5.5 19-1.5 19.5-1 .4.4 2.17 6.167 3 9z" fill="#D9D9D900" />
            <path d="M1283 867.5c-45.6-2.4-27.33-10.667-12.5-14.5.67 0 2.1-.4 2.5-2 .5-2 .5-4 6.5-4.5 4.8-.4 5.33 2.5 5 4-2.17-1.333-5.2-3.1 0 .5s9.5 8.167 11 10c0 2.5.7 7.2 3.5 6 3.5-1.5 9.5.5 13.5 6 3.2 4.4 1.33 6.167 0 6.5l-12 9c3.5 5-3.5 5.5-14.5 3-8.8-2-3.67-6.167 0-8-.4-4 2.83-11.667 4.5-15z" fill="#D9D9D900" />
            <path d="M1263 907c-2.4-6 4.67-7.167 8.5-7-1.6-3.2 4.67-4.667 8-5 9-7.5 8.5 0 10.5.5 1.6.4 3.67 1.5 4.5 2 9.2 2.8 3.83 5.167 0 6l-.5 8c.8 2.8-2.33 4.167-4 4.5h-15.5c-3.2 0-3.67-2.667-3.5-4-1.67.833-5.6 1-8-5m77.5 0c-24.4 2-26.83-7.5-25-12.5l1.5-4c-3.6-5.6 5.83-4.667 11-3.5 10-1.2 16.17 1.833 18 3.5 14.4 1.6 9.67 7.333 5.5 10 .4 4.8-7.17 6.333-11 6.5m-7.5-38.5-23-3.5c-2-2.8 1.17-7.5 3-9.5-3.2-3.2 7-3 12.5-2.5-.4-4.8 7.17-2 11 0-1-6-1-12.5 15-9.5s2.5 15 0 17.5c-2 2-7.17.833-9.5 0-1 1.333-3 4.4-3 6s-4 1.667-6 1.5m-32.5-38.5v18c-1.2 2.4-3.17 0-4-1.5L1286 832c-8-2-2.67-9.167 1-12.5 0-5.5 2.5-9 8-8.5 4.4.4 4.5 6.167 4 9 6.8 3.6 3.83 8.167 1.5 10m41.5-1.5c9.6 9.6.33 9-5.5 7.5-12.5-.333-34.8-2.8-24-10 13.5-9 15.5.5 15.5-2 0-2 3.33-3.5 5-4 9.6-1.2 10 1.5 9 3zm26.5 48c-3.2-7.2 6-6 11-4.5-.8.8-7.67 11.333-11 16.5-11.6-1.6-4.83-8.667 0-12m1.5-12c-.8 3.6 7.67 4.167 12 4l11.5-18.5-8.5-1.5c-17.6.4-13.67 6.833-9.5 10-1.5.5-4.7 2.4-5.5 6" fill="#D9D9D900" />
        </svg>

        <svg class="layer svg" data-name="Charm Rings" data-link="/product-category/fashion-accessories/jewellery/earrings-jewellery/" viewBox="0 0 2240 1260" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1478.26 724.379 1370.3 886.825c-3.99 5.998-5.86 17.678-6.3 22.77l2.58 40.265c8.3 43.874 68.44 93.86 155.78 96.08 69.87 1.78 109.48-35.54 120.55-54.428l84.48-185.493c.1.833.86-2.944 3.15-24.714 2.86-27.213-7.44-36.932-36.94-62.202-29.49-25.269-97.65-33.044-140.6-29.157-34.37 3.111-64.15 24.253-74.74 34.433" fill="#D9D9D900" />
        </svg>


        <!-- Add more inline SVGs as needed -->
    </div>
    <style>
        .interactive-image-hover-container {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56%;
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
            pointer-events: none;
            /* SVG is not clickable until made interactive */
        }

        .layer.svg path {
            pointer-events: all;
        }

        .hovered {
            filter: drop-shadow(0px 0px 5px rgba(255, 255, 0, 0.8));

        }

        .grayscale {
            filter: grayscale(100%);
            filter: drop-shadow(0px 0px 0px rgba(255, 255, 0, 0));
        }

        .tooltip {
            position: absolute;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            pointer-events: none;
            visibility: hidden;
            z-index: 5;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const svgElements = document.querySelectorAll(".layer.svg path, .layer.svg circle, .layer.svg ellipse"); // Include paths, circles, and ellipses
            const background = document.getElementById("background");
            const container = document.querySelector(".interactive-image-hover-container");

            // Tooltip logic
            const tooltip = document.createElement("div");
            tooltip.classList.add("tooltip");
            document.body.appendChild(tooltip);

            svgElements.forEach((element) => {
                element.addEventListener("mouseenter", (e) => {
                    svgElements.forEach((el) => el.classList.remove("hovered", "grayscale"));
                    element.classList.add("hovered");

                    svgElements.forEach((el) => {
                        if (el !== element) {
                            el.classList.add("grayscale");
                        }
                    });

                    background.classList.add("grayscale");

                    // Show tooltip
                    const svg = element.closest("svg");
                    tooltip.innerText = svg.dataset.name || "Hovered Element";
                    tooltip.style.visibility = "visible";
                });

                element.addEventListener("mouseleave", () => {
                    svgElements.forEach((el) => el.classList.remove("hovered", "grayscale"));
                    background.classList.remove("grayscale");

                    // Hide tooltip
                    tooltip.style.visibility = "hidden";
                });

                element.addEventListener("mousemove", (e) => {
                    tooltip.style.left = e.pageX + 10 + "px";
                    tooltip.style.top = e.pageY + 10 + "px";
                });

                element.addEventListener("click", () => {
                    const svg = element.closest("svg");
                    const link = svg.dataset.link;
                    if (link) {
                        window.location.href = link;
                    }
                });
            });

            container.addEventListener("mouseleave", () => {
                svgElements.forEach((el) => el.classList.remove("hovered", "grayscale"));
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
