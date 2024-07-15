<?php

require '../config/init.php';


if (isset($_POST['forgetPass']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        # Params and CheckParams
        $email = trim($_POST['email']);
        $newPassword = newPassword();
        $verifyEmail = checkEmail($email);
        
        if ($verifyEmail && !empty($email)) {

            resetPassword($email, $newPassword);
            sendEmail($email,$newPassword);
            setMessageAndRedirect('رمز عبور جدید با موفقیت به ایمیل شما ارسال شد','./');

        } else {
            throw new Exception();
        }
    } catch (Exception $e) {
        setErrorAndRedirect('ایمیل مورد نظر یافت نشد لطفا ثبت نام کنید','forgetPassword');
    }
}
