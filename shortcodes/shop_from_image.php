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
        <svg class="layer svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4032 3024">
    <path data-name="Diaries" data-link="/product-category/stationery/diaries/" d="M1857.5 1251L..." fill="#00000000" />
    <path data-name="Earings" data-link="/product-category/fashion-accessories/jewellery/earrings-jewellery/" d="M2828 1988.5L..." fill="#D9D9D900" />
    <path data-name="Travel Tags" data-link="/product-category/travel-accessories/travel-tags/" d="M1951.5 1850.5c..." fill="#D9D9D900" />
    <path data-name="Stationery" data-link="/product-category/stationery/" d="M1039 2413.5L..." fill="#D9D9D900" />
    <path data-name="Earings" data-link="/product-category/fashion-accessories/jewellery/earrings-jewellery/" d="M2528.5 1957c..." fill="#D9D9D900" />
    <path data-name="Fridge Magnets" data-link="/product-category/home-living/fridge-magnets/" d="M2717.394 916.883c..." fill="#D9D9D900" />
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
        document.addEventListener('DOMContentLoaded', () => {
    const svgContainer = document.querySelector('.interactive-image-hover-container svg'); // Select the single SVG
    const paths = svgContainer.querySelectorAll('path'); // Get all the paths inside the SVG

    // Attach event listeners to each path
    paths.forEach((path) => {
        // Extract the `data-name` and `data-link` attributes from the parent SVG element
        const dataName = svgContainer.getAttribute('data-name');
        const dataLink = svgContainer.getAttribute('data-link');

        // Add hover effect for paths
        path.addEventListener('mouseenter', () => {
            // Highlight the hovered path
            path.style.fill = 'rgba(0, 0, 0, 0.5)'; // Change the color on hover
            path.style.cursor = 'pointer';

            // Display tooltip or some UI to show `data-name`
            showTooltip(path, dataName);
        });

        path.addEventListener('mouseleave', () => {
            // Reset the path style
            path.style.fill = '';
            hideTooltip();
        });

        // Add click event to navigate to the link
        path.addEventListener('click', () => {
            if (dataLink) {
                window.location.href = dataLink; // Navigate to the `data-link`
            }
        });
    });

    // Tooltip logic
    function showTooltip(path, text) {
        const tooltip = document.createElement('div');
        tooltip.className = 'tooltip';
        tooltip.innerText = text;
        document.body.appendChild(tooltip);

        // Position tooltip near the cursor
        path.addEventListener('mousemove', (e) => {
            tooltip.style.left = e.pageX + 10 + 'px';
            tooltip.style.top = e.pageY + 10 + 'px';
        });
    }

    function hideTooltip() {
        const tooltip = document.querySelector('.svg-tooltip');
        if (tooltip) {
            tooltip.remove();
        }
    }
});

    </script>
<?php
    return ob_get_clean();
}

add_shortcode('shop_from_image', 'interactive_image_hover_shortcode');
