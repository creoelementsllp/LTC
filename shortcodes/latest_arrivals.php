<?php
function latest_arrivals_shortcode($atts)
{
    // Shortcode attributes with default values
    $atts = shortcode_atts(
        array(
            'category' => '',  // Category slug (optional)
            'limit' => 10,     // Number of products to show
            'columns' => 4,    // Number of products per row
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
        $count = 0;
        $columns = intval($atts['columns']);
        $show_more_added = false; // To track if we already added the "See More" button

        echo '<div class="latest-arrivals">';

        // Open the first row
        echo '<div class="row">';

        while ($query->have_posts()) {
            $query->the_post();

            global $product;
            
            $product_id = $product->get_id();
            // Render a product card
            echo '<a href="' . get_permalink() . '" class="product-card">';
                // Add YITH Wishlist button
            echo '<div class="wishlist-btn yith-wcwl-add-to-wishlist add_to_wishlist" data-product-id="' . esc_attr($product_id) . '">
                    <span class="heart-icon">&#9825;</span>
                </div>';

            
            
            
            
            echo woocommerce_get_product_thumbnail();
            echo '<h2 class="product-title">' . get_the_title() . '</h2>';
            echo '<div class="product-price">' . $product->get_price_html() . '</div>';
            echo '</a>';

            $count++;

            // Add the "See More" button as the last column of the second row
            if ($count === $columns * 2 - 1 && !$show_more_added) {
                // Start "See All Products" card
                echo '<a href="' . get_permalink(woocommerce_get_page_id('shop')) . '" class="see-more-btn product-card see-more-card">
                        See All Products';
                
                // Fetch the remaining products for the gallery (up to 4)
                $remaining_args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4, // Limit to 4 products for the gallery
                    'post_status' => 'publish',
                    'offset' => $atts['limit'], // Skip the already displayed products
                );

                if (!empty($atts['category'])) {
                    $remaining_args['tax_query'] = array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => $atts['category'],
                        ),
                    );
                }

                $remaining_query = new WP_Query($remaining_args);

                if ($remaining_query->have_posts()) {
                    echo '<div class="product-gallery">';
                    // echo '<h3>Other Products</h3>'; // Gallery heading
                    echo '<div class="gallery-row">';

                    // while ($remaining_query->have_posts()) {
                    //     $remaining_query->the_post();

                    //     echo woocommerce_get_product_thumbnail();
                    // }

                    echo '</div>'; // Close gallery row
                    echo '</div>'; // Close product-gallery container
                }

                wp_reset_postdata();
                
                // End "See All Products" card
                echo '</a>';
                
                $show_more_added = true;
                $count++;
            }

            // Close the current row and start a new one after every $columns products
            if ($count % $columns === 0 && $count < $atts['limit']) {
                echo '</div>'; // Close the current row
                echo '<div class="row">'; // Start a new row
            }
        }

        // Close any unclosed row
        if ($count % $columns !== 0) {
            echo '</div>';
        }

        echo '</div>'; // Close the container
    } else {
        echo '<p>No products found.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}

// Add the shortcode
add_shortcode('latest_arrivals', 'latest_arrivals_shortcode');
