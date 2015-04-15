<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'configuration.php';

/* creates a compressed zip file */

function create_zip($files = array(), $destination = '', $overwrite = false) {
    
    //if the zip file already exists and overwrite is false, return false
    if (file_exists($destination) && !$overwrite) {
        return false;
    }
    //vars
    $valid_files = array();
    //if files were passed in...
    if (is_array($files)) {
        //cycle through each file
        foreach ($files as $file) {
            //make sure the file exists
            if (file_exists(dirname(__DIR__).'/site/phocadownload/'.$file)) {
                $valid_files[] = $file;
            }
        }
    }
    //if we have good files...
    if (count($valid_files)) {
        //create the archive
        $zip = new ZipArchive();
        if ($zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
            return false;
        }
        //add the files
        foreach ($valid_files as $file) {
            $zip->addFile($file, $file);
        }
        
        //debug
        //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
        //close the zip -- done!
        $zip->close();
        //check to make sure the file exists
        return file_exists($destination);
    } else {
        return false;
    }
}

if (isset($_GET) && !empty($_GET['id'])) {
    $title = getTitle($_GET['id']);
}

if (isset($_GET) && !empty($_GET)) {
    
    if (isset($_GET['all']) && $_GET['all'] == true) {
        $list = getList($_GET['id']);
        
        $files_to_zip = array();
        foreach ($list as $l) {
            $files_to_zip[] = $l->filename;
        }

        $result = create_zip($files_to_zip, $title->title . '.zip');
    } else {
        
        $path = $_GET['path'];
        $fileName = basename($path);
        
        header("Location: ".$path);
        
//        header("Content-disposition: attachment; filename=" . $fileName);
//        header("Content-type: application/pdf");
//        readfile($path);
//        flush();
    }
}