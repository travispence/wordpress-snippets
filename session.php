<?php

/**
 *  Enable the PHP session. Can then access $_SESSION object.
 *  Can pass options to session_start().. 
 *  > In addition to the normal set of configuration directives, a read_and_close option may also be provided.
 *  > If set to TRUE, this will result in the session being closed immediately after being read, thereby avoiding
 *  > unnecessary locking if the session data won't be changed.
 * 
 * @link http://php.net/manual/en/function.session-start.php
 */

function _startSession()
{
    if (!session_id()) {
        session_start();
    }
}

add_action('init', '_startSession', 1);
