<?php
// Hook into WooCommerce initialization to ensure cart and wishlist are loaded
add_action('wp_footer', 'add_cart_and_wishlist_dot_badge', 20);

function add_cart_and_wishlist_dot_badge() {
    // Ensure WooCommerce is active and cart is loaded
    if ( class_exists( 'WooCommerce' ) && WC()->cart ) {
        // Get the cart item count using WooCommerce function
        $cart_count = WC()->cart->get_cart_contents_count();
    } else {
        $cart_count = 0; // Default to 0 if WooCommerce is not active or cart is not loaded
    }

    // Ensure YITH Wishlist is active and get the wishlist item count
    if ( class_exists( 'YITH_WCWL' ) ) {
        $wishlist_count = yith_wcwl_count_products();
    } else {
        $wishlist_count = 0; // Default to 0 if YITH Wishlist is not active
    }

    // Add the badge (dot) for cart and wishlist icons
    addDotBadge('cart-icon-class', $cart_count);      // Replace 'cart-icon-class' with your cart icon class
    addDotBadge('wishlist-icon-class', $wishlist_count); // Replace 'wishlist-icon-class' with your wishlist icon class
}

// Function to add a dot badge on top right corner of the given classes
function addDotBadge($class, $count) {
    if ($count > 0) {
        // Output the CSS with a badge on the top-right corner
        echo "<style>
                .{$class}::after {
                    content: '{$count}';
                    position: absolute;
                    top: -15%;
                    left: -50%;
                    background-color: #42B9A3;
                    color: white;
                    font-size: 1rem;
                    width: 1.25rem;
                    height: 1.25rem;
                    border-radius: 50%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    z-index: 9999;  /* Ensure it's on top */
                }
                @media screen and (max-width : 676px){
                     .{$class}::after {
    left: -30%;
                    }
                }
              </style>";
    }
}
?>
