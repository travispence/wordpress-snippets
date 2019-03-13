<?php
/**
 * SEO related tags. These depend on ACF being installed but does have a 
 * fallback just in case it doesnt. PHP short circuits in conditional evaluations 
 * and will not call the get_field() method if the plugin is not installed.
 */
function _set_meta_tag()
{
    $output = '<meta property="author" content="https://example.com" />';
    if ( class_exists('ACF') && get_field('page_description')) {
        $output .= '<meta property="description" content="' . get_field('page_description') . '" />';
    } else {
        $output .= '<meta property="description" content="' . get_bloginfo('description') . '" />';
    }

    if ( class_exists('ACF') && get_field('page_keywords')) {
        $output .= '<meta property="keywords" content="' . get_field('page_keywords') . '" />';
    } else {
        $output .= '<meta property="keywords" content="' . get_bloginfo('name') . '" />';
    }

    echo $output;
}

add_action('wp_head', '_set_meta_tag');


/**
 * Allow the page/post titles to be configured via ACF in the backend. If ACF doesnt exist or
 * the field has not been defined for the page/post fallback to the blog name and description
 * as defined in the options
 */
add_filter('pre_get_document_title', function ($title) {
    if (class_exists('ACF') && get_field('page_title')) {
        $title = get_field('page_title') . ' | ' . get_bloginfo('name');
    } else {
        $title = get_bloginfo('name') . ' ' . get_bloginfo('description');
    }
    return $title;
}, 999, 1);
