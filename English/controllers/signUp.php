<?php

require '../config/init.php';

if (isset($_POST['signUp']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        # Params and CheckParams
        $userName = trim(strip_tags($_POST['username']));
        $passWord = trim(strip_tags($_POST['password']));
        $email = trim(strip_tags($_POST['email']));
        $EmailVr = checkEmail($email);
        $UserVr = checkUserName($userName);
        $PassVr = checkPassword($passWord);

        # Duplicate Email
        if ($EmailVr) {
            throw new Exception('The entered email is duplicate!!');
        }

        # Duplicate Username
        if ($UserVr) {
            throw new Exception('The entered username is duplicate!!');
        }

        # Duplicate Password
        if ($PassVr) {
            throw new Exception('The password entered is weak!!');
        }

        $addUser = addUser($userName, $passWord, $email);
        if ($addUser) {
            # Successful User SignIn Or Set Cookie
            $cookieValues = encodeORdecode($userName . '-.-' . $addUser)['enCode'];
            setcookie('Logined', $cookieValues, time() + (86400), "/"); // 86400 = 1 Day
            setMessageAndRedirect('You have successfully logged in!', './');
        }
    } catch (Exception $e) {
        setErrorAndRedirect($e->getMessage(), 'signUp');
    }
}
