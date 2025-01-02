<?php
function custom_product_cards_shortcode($atts)
{
    // Shortcode attributes with default values
    $atts = shortcode_atts(
        array(
            'category' => '',  // Category slug (optional)
            'limit' => 20,      // Number of products to show
        ),
        $atts,
        'product_cards'
    );

    // Query WooCommerce products
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $atts['limit'],
        'post_status' => 'publish',
    );

    if (!empty($atts['category'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $atts['category'],
            ),
        );
    }

    $query = new WP_Query($args);

    // Output buffer to capture HTML
    ob_start();

    if ($query->have_posts()) {
        echo '<div class="swiper custom-product-cards">';
        echo '<div class="swiper-wrapper">';
        while ($query->have_posts()) {
            $query->the_post();

            global $product;
            $product_id = $product->get_id();

            // Add YITH Wishlist button
            echo '<div class="product-card swiper-slide">';
            echo '<div class="wishlist-btn yith-wcwl-add-to-wishlist add_to_wishlist" data-product-id="' . esc_attr($product_id) . '">
                    <span class="heart-icon">&#9825;</span>
                </div>';

            echo '<a href="' . get_permalink() . '" class="product-link">'; // Start the clickable card
            echo woocommerce_get_product_thumbnail();
            echo '<h2 class="product-title">' . get_the_title() . '</h2>';
            echo '<div class="product-price">' . $product->get_price_html() . '</div>';
            echo '</a>'; // Close card

            echo '</div>'; // End product card
        }
        echo '</div>'; // Close swiper-wrapper
        echo '<div class="swiper-button-next"></div><div class="swiper-button-prev"></div>';
        echo '</div>'; // Close swiper
    } else {
        echo '<p>No products found.</p>';
    }

    wp_reset_postdata();

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

    return ob_get_clean();
}

// Add the shortcode
add_shortcode('product_cards', 'custom_product_cards_shortcode');
?>
