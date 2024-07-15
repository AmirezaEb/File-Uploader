<?php

require '../config/init.php';

if (isset($_POST['signIn']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        # Params and CheckParams
        $key = trim($_POST['key']);
        $password = trim($_POST['password']);
        $user = receiveUser($key, $password);
        $userName = receiveUserName($key);

        if ($user) {
            # Successful User SignIn Or Set Cookie
            $cookieValues = encodeORdecode($userName->username . '-.-' . $userName->id)['enCode'];
            setcookie('Logined', $cookieValues, time() + (86400), "/"); // 86400 = 1 Horse
            setMessageAndRedirect('You have successfully logged in!','./');
        } else {
            throw new Exception();
        }
    } catch (Exception $e) {
        # NotLogin
        setErrorAndRedirect('Username or password is incorrect','signIn');
    }
}
