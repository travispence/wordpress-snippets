<?php

/**
 * @param files
 * @link http://php.net/manual/en/class.ziparchive.php
 *
 * @return String the path of the newly created zip archive. 
 */

function tcp_zip_files($filenames, $imagesFolderPath)
{
    $zip = new ZipArchive();
    $dir = get_template_directory();

    // The should be a directory /zip in the theme template directory. 
    $newFile = "/zip/files_" . date('d_m_h-i-s') . ".zip";

    $filename = $dir . $newFile;

    if ($zip->open($filename, ZIPARCHIVE::CREATE) !== true) {
        exit("cannot open <$filename>\n");
    }

    foreach ($filenames as $key => $file) {

        if (!$zip->addFile($file, basename($key))) {
            if (!file_exists($file)) {
                echo "<span style='color: red;' >" . $key . ": File does not exist. </span><br/>";
            } else {
                echo "<span style='color: red;' >" . $key . ": File exists, but can't add to zip archive</span><br/>";
            }
        }
    }

    $zip->close();
    return $newFile;
}
