<?php
function custom_product_cards_shortcode()
{
    // Define the categories you want to fetch products from
    $categories = array('diy-art-supplies', 'stationery', 'personalised');
    $products_per_category = 4; // Number of products per category
    $output = '';

    // Output buffer to capture HTML
    ob_start();

    echo '<div class="swiper custom-product-cards">';
    echo '<div class="swiper-wrapper">';

    foreach ($categories as $category) {
        // Query WooCommerce products for each category
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $products_per_category,
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $category,
                ),
            ),
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                global $product;
                $product_id = $product->get_id();

                // Product card HTML
                echo '<div class="product-card swiper-slide">';
                echo '<div class="wishlist-btn yith-wcwl-add-to-wishlist add_to_wishlist" data-product-id="' . esc_attr($product_id) . '">
                        <span class="heart-icon">&#9825;</span>
                    </div>';

                echo '<a href="' . get_permalink() . '" class="product-link">'; // Start the clickable card
                echo woocommerce_get_product_thumbnail();
                echo '<h3 class="product-title">' . get_the_title() . '</h3>';
                echo '<div class="product-price">' . $product->get_price_html() . '</div>';
                echo '</a>'; // Close card

                echo '</div>'; // End product card
            }
        }

        wp_reset_postdata();
    }

    echo '</div>'; // Close swiper-wrapper
    echo '<div class="swiper-button-next"></div><div class="swiper-button-prev"></div>';
    echo '</div>'; // Close swiper

    // Add custom CSS for the heart icon
    ?>
    <style>
        .wishlist-btn {
            position: absolute;
            top: 0px;
            left: 10px;
            cursor: pointer;
            font-size: 3rem;
            color: #42B9A3;
            height: 24px;
            width: 24px;
            margin-top: 5px;
        }

        .wishlist-btn .heart-icon {
            transition: color 0.3s ease;
        }

        .wishlist-btn .heart-icon.filled {
            color: red;
        }
    </style>
    <?php

    $output = ob_get_clean();
    return $output;
}

// Add the shortcode
add_shortcode('product_cards', 'custom_product_cards_shortcode');
?>
