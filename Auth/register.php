<?php

require ('../Includes/Include.php');

//Make sure we are only looking at the POST var
if($_POST) {

    $baseController = new BaseController();
    $db = $baseController->db;
    $helper = $baseController->helper;
    $post = $helper->sanitiseInputs($_POST);
    $email = $post['email'];
    $password = $post['password'];
    $fullname = $post['fullname'];

    if (isset($_FILES["file"]["name"])) {

        $file = $helper->sanitiseFileInput($_FILES["file"]);

        if(!empty($file) && $file['status'] === "error") {

            $_SESSION['errors'][] = $file['message'];
            header("Location: /Views/register.php");
            exit();

        } else {

            if ($db->setUser($email, $password, $fullname, $file)) {

                header("Location: /");

            } else {

                $_SESSION['errors'][] = "Something went wrong. Please ensure all fields are complete and try again!";
                header("Location: /Views/register.php");

            }

        }

    } else {
        die('no');
    }

    exit();

}