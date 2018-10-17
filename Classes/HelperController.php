<?php

class HelperController
{

    public $dd = null;
    public $fileLocation = null;
    protected $allowedMimeTypes = array('image/gif', 'image/jpeg', 'image/png', 'image/bmp');

    public function __construct() {

        $this->fileLocation = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';

    }

    /*
     * Function: dd
     * Accepts: String
     * returns: String
     */
    public function dd($var = null)
    {

        echo '<pre>' , var_dump($var) , '</pre>';
        die();

    }

    /*
     * Function: sanitiseInputs
     * Accepts: Array
     * returns: Array
     */
    public function sanitiseInputs($inputs)
    {

        foreach($inputs AS $key => $input) {

            if("file" !== $key) {
                if ("" === $input)
                    $inputs['errors'][] = ucwords($input);
                else {

                    $string = htmlspecialchars($input);
                    $inputs[$key] = filter_var($string, FILTER_SANITIZE_STRING);
                }
            }
        }

        return $inputs;

    }

    /*
     * Function: sanitiseFileInput
     * Accepts: String
     * returns: String
     */
    public function sanitiseFileInput($file)
    {

        if (!empty($file['tmp_name'])) {

            $tmpFile = $file['tmp_name'];
            $mimeType = mime_content_type($tmpFile);

            if(in_array($mimeType, $this->allowedMimeTypes)) {

                $pathInfo = pathinfo($file['name']);
                $fileExt = $pathInfo['extension'];
                $name = md5( date('Y-m-d H:i:s') . $tmpFile);

                if (move_uploaded_file($tmpFile, $this->fileLocation . $name . '.' . $fileExt)) {

                    return array('status' => 'ok', 'file' => $name . '.' . $fileExt);

                } else
                    return array('status' => 'error', 'message' => "Something went wrong");

            } else
                return array('status' => 'error', 'message' => "The file you have uploaded is not allowed. Please ensure the file is a PNG, JPG(JPEG), BMP or GIF");

        } else
            return array('status' => 'error', 'message' => "Please select a file to upload");

    }

}