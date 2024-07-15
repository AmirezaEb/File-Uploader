<?php

/* 
 * Developed by Hero Expert 
 * Telegram channel: @HeroExpert_ir
*/

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
            setMessageAndRedirect('The new password has been successfully sent to your email','./');

        } else {
            throw new Exception();
        }
    } catch (Exception $e) {
        setErrorAndRedirect('The desired email was not found. Please register','forgetPassword');
    }
}

/* 
 * Developed by Hero Expert 
 * Telegram channel: @HeroExpert_ir
*/
?>
