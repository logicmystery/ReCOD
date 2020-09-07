<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed dc ');

class Uploader extends MY_Controller {

    public $publicAccess = array('index');

    public function __construct() {

        parent::__construct();
    }

    /**
     * 
     * add detail
     */
    public function index() {
        if($_REQUEST['FilePath']==""){
            $targetFolder = 'uploads/'.NODE.'/'; // Relative to the root

        }else{
            $targetFolder = 'uploads/'.NODE.'/'.$_REQUEST['FilePath'].'/'; // Relative to the root

        }
        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = ROOTPATH.$targetFolder;
            $generatedFileName = time().strstr($_FILES['Filedata']['name'], '.');

            $targetFile = rtrim($targetPath, '/').'/'.$generatedFileName;

            // Validate the file type
            $fileTypes = array('jpg', 'jpeg', 'gif', 'png','mp4'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array(strtolower($fileParts['extension']), $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);
                echo $generatedFileName;
            } else {
                echo 'Invalid file type.';
            }
        } else {
            show_404();
        }
    }

}
