<?php
function custom_price_filtered_products_shortcode($atts)
{
    // Shortcode attributes with default values
    $atts = shortcode_atts(
        array(
            'price_under' => 100, // Default price limit
            'limit' => 10,        // Default product limit
            'id' => 'default-swiper', // Default ID for the Swiper instance
        ),
        $atts,
        'price_filtered_products'
    );

    // Convert attributes to appropriate data types
    $price_limit = floatval($atts['price_under']);
    $product_limit = intval($atts['limit']);
    $unique_id = sanitize_title($atts['id']); // Sanitize the provided ID

    // Query WooCommerce products under the specified price and limit the number of results
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $product_limit, // Limit the number of products
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => '_price',
                'value' => $price_limit,
                'compare' => '<=',
                'type' => 'NUMERIC'
            ),
        ),
    );

    $query = new WP_Query($args);

    // Output buffer to capture HTML
    ob_start();

    if ($query->have_posts()) {
        echo '<div id="' . $unique_id . '" class="swiper price-filtered-products">'; // Start Swiper container
        echo '<div class="swiper-wrapper">';
        while ($query->have_posts()) {
            $query->the_post();

            global $product;

            // Display the product image only
            echo '<div class="swiper-slide">';
            echo '<a href="' . get_permalink() . '">';
            echo woocommerce_get_product_thumbnail();
            echo '</a>';
            echo '</div>';
        }
        echo '</div>'; // Close swiper-wrapper
        // echo '<div class="swiper-button-next"></div><div class="swiper-button-prev"></div>'; // Navigation buttons
        echo '</div>'; // Close Swiper container


    } else {
        echo '<p>No products found under the specified price.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}

// Add the shortcode
add_shortcode('price_filtered_products', 'custom_price_filtered_products_shortcode');
