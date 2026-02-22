<?php
/**
 * Simple Breadcrumbs for WordPress
 * 
 * Displays a basic breadcrumb trail:
 * - Home » Category » Post Title
 * - Home » Parent Page » Current Page
 * - Home » Search: "query"
 * - etc.
 * 
 * Safe, escaped, no plugin required.
 *
 * @package Your_Theme_Name
 */

/**
 * Output breadcrumbs
 * Call this in your templates: <?php rd3_breadcrumbs(); ?>
 */
/* ==========================================================================
   Simple Breadcrumbs
   ========================================================================== */
function rd3_breadcrumbs() {
    // Skip front page and blog index
    if ( is_front_page() || is_home() ) {
        return;
    }

    $separator = ' » ';
    $home_link = esc_url( home_url( '/' ) );
    $home_text = esc_html__( 'Home', 'your-text-domain' );

    $output  = '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'your-text-domain' ) . '">';
    $output .= '<p>';
    $output .= '<a href="' . $home_link . '">' . $home_text . '</a>' . $separator;

    if ( is_category() ) {
        // Category archive
        $category = get_queried_object();
        $output .= esc_html( $category->name );

    } elseif ( is_single() || is_singular() ) {
        // Single post / custom post type
        $post_type = get_post_type();

        if ( 'post' === $post_type ) {
            // Show only the first category (cleanest for most sites)
            $categories = get_the_category();
            if ( ! empty( $categories ) ) {
                $first_cat = $categories[0];
                $output .= '<a href="' . esc_url( get_category_link( $first_cat->term_id ) ) . '">' 
                        .  esc_html( $first_cat->name ) 
                        . '</a>' . $separator;
            }
        }
        // Current item (not linked)
        $output .= esc_html( get_the_title() );

    } elseif ( is_page() && ! is_front_page() ) {
        // Pages with hierarchy
        global $post;
        $ancestors = get_post_ancestors( $post->ID );
        $ancestors = array_reverse( $ancestors ); // oldest parent first

        foreach ( $ancestors as $ancestor_id ) {
            $output .= '<a href="' . esc_url( get_permalink( $ancestor_id ) ) . '">' 
                    .  esc_html( get_the_title( $ancestor_id ) ) 
                    . '</a>' . $separator;
        }

        // Current page
        $output .= esc_html( get_the_title() );

    } elseif ( is_search() ) {
        $output .= esc_html__( 'Search', 'your-text-domain' ) . ': "' 
                .  esc_html( get_search_query() ) . '"';

    } elseif ( is_404() ) {
        $output .= esc_html__( '404 Not Found', 'your-text-domain' );

    } elseif ( is_tag() ) {
        $tag = single_tag_title( '', false );
        $output .= esc_html__( 'Tag', 'your-text-domain' ) . ': ' . esc_html( $tag );

    } elseif ( is_author() ) {
        $author = get_the_author();
        $output .= esc_html__( 'Author', 'your-text-domain' ) . ': ' . esc_html( $author );

    } else {
        // Fallback for archives, dates, custom taxonomies…
        $output .= esc_html( wp_title( '', false ) );
    }

    $output .= '</p>';
    $output .= '</nav>';

    // Only output if there's actual content beyond just "Home"
    if ( strlen( $output ) > 100 ) {
        echo $output;
    }
}