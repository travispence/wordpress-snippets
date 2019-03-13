<?php
/**
 * Template Name: Download Documents.
 * 
 * To enable this, a page must be set to use this template. 
 * 
 * This template exists to handle downloading attachment files that have been associated with another
 * post (via the post_parent). It grabs the ID from the GET query param id. If there is only one attachment,
 * the template will download the single file, for multiple attachments it creates a zip archive to download.
 * 
 * The zip files are not cleaned up and need to be managed separately. 
 * 
 * 
 * @uses tcp_zip_files See method definition for further info.
 */

$custom_post_id = $_GET['id'];

$argsAttachments = array(
    'post_type' => 'attachment',
    'post_parent' => $custom_post_id,
    'post_status' => 'inherit',
);
$queryAttachments = new WP_Query($argsAttachments);

$files = [];

while ($queryAttachments->have_posts()): $queryAttachments->the_post();
    global $post;
    $attachment = $post;

    $attachmentPath = $attachment->guid;
    // Not quite sure why this needs to happen. Could be due  to a missing slash
    // in the path name.
    $uploadDir = explode("wp-content/uploads", $attachmentPath);
    $files[$attachment->guid] = realpath('.') . "/wp-content/uploads" . $uploadDir[1];

endwhile;

if (count($files) > 1) {
    $name = tcp_zip_files($files, $imagesFolderPath);
    $filePath = get_template_directory_uri() . $name;
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . basename($filePath) . "\"");
    readfile($filePath);

} else if (count($files) == 1) {
    // Download Single File. No need to Create a Zip
    // Reset Pointer of $files array to beginning
    // may or may not be necessary. Need to test if the array state is mutated somewhere.
    $filePath = reset($files);
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . basename($filePath) . "\"");
    readfile($filePath);
} else {
    echo '<h2>No Files attached</h2>';
}
