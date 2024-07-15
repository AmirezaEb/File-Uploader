<?php

require '../config/init.php';

if (isset($_POST['signUp']) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {
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
            throw new Exception('ایمیل وارد شده تکراری می باشد!!');
        }

        # Duplicate Username
        if ($UserVr) {
            throw new Exception('نام کاربری وارد شده تکراری می باشد!!');
        }

        # Duplicate Password
        if ($PassVr) {
            throw new Exception('رمزعبور وارد شده ضعیف می باشد!!');
        }

        $addUser = addUser($userName, $passWord, $email);
        if ($addUser) {
            # Successful User SignIn Or Set Cookie
            $cookieValues = encodeORdecode($userName . '-.-' . $addUser)['enCode'];
            setcookie('Logined', $cookieValues, time() + (86400), "/"); // 86400 = 1 Day
            setMessageAndRedirect('شما با موفقیت وارد شدید!','./');
        }
    } catch (Exception $e) {
        setErrorAndRedirect($e->getMessage(),'signUp');
    }
}
