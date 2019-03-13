<?php

/**
 * Redirect unauthenticated users to the login page. Authenticated Users will
 * be redirected from the login page if they are already signed in. Need to make sure
 * that the redirect does not occur on certain pages and not to break the Admin user login. 
 */
add_action( 'template_redirect', 'redirect_non_logged_users_to' );

function redirect_non_logged_users_to()
{
    // Pages are unique to the WordPress installation
    $LOGIN = 4;
    $LANDING = 1234;

    if (is_user_logged_in() && is_page($LOGIN)) {
        header('Location: ' . get_home_url() . "/dashboard");
        exit;
    }

    if (!is_user_logged_in() && !is_page(array($LOGIN, $LANDING)) && $_SERVER['PHP_SELF'] != '/wp-admin/admin-ajax.php') {
        header('Location: ' . get_home_url() . "/login");
        exit;
    }
}
