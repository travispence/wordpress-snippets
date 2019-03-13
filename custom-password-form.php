<?php


/**
 * Custom Password Form. WordPress Allows Pages/Posts to be protected via a password
 * set in the Admin Dashboard. The page needs to implement a call to the method get_the_password_form()
 * This filter allows us to override the default form  with custom markup 
 */

add_filter('the_password_form', 'custom_password_form');
function custom_password_form()
{
    global $post;
    $label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);

    $o = '<div class="custom-password-form" >
            <form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
                <div style="margin: 0 auto;">
                ' . __("This Content is protected") . '
                <label class="pass-label" for="' . $label . '">' . __("PASSWORD") . ' </label>
                <input name="post_password" id="' . $label . '" type="password" size="20" />
                <input type="submit" name="Submit" class="button" value="' . esc_attr__("Submit") . '" />
                </div>
            </form>
            <br/>
            <p class="alert" > ∗∗ Remember, this is a different password than the account password</p>
        </div>
    ';
    return $o;
}
