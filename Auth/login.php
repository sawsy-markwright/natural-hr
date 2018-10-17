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

    if($user = $db->getUser($email, $password)) {

        $_SESSION['user'] = $user;
        header("Location: " . $db->loginOK);

    } else {

        $_SESSION['errors'][] = "Those credentials do no exist in our system";
        header("Location: /");

    }

    exit();

}