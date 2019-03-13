<?php 
/**
 * Simple util function that will print any $object provided in a human readable manner. 
 */
function debug_var($content) {		
    echo '<pre>' . var_export($content, true) . '</pre>';
}

