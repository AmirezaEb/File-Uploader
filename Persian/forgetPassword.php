<?php require 'config/init.php'; ?>

<!DOCTYPE html>
<html lang="fa">

<!--
-*- Developed by Hero Expert 
-*- Telegram channel: @HeroExpert_ir
*-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/iranyekan">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/iranyekan">
    <link rel="stylesheet" href="assets/css/forgetPass.css">
    <title>بازیابی رمز عبور</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.11.0/sweetalert2.all.js"></script>
</head>

<body>
    <div class="login-box">
        <h2>فراموشی رمز عبور</h2>
        <form action="controllers/resetPassword" method="post">
            <div class="user-box username-input-div" data-validator="لطفا ایمیل معبتر وارد نمایید">
                <input class="username-input" type="text" name="email">
                <label>ایمیل</label>
            </div>
            <div class="user-box">
                <a class="signIn-text" href="signIn">
                    ورود با ایمیل یا نام کاربری
                </a>
            </div>
            <button class="forget-btn" type="submit" name="forgetPass">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                ارسال رمز عبور جدید
            </button>

        </form>
    </div>
    <script src="assets/js/forgetPass.js"></script>
</body>

</html>
<?php
# Error Handler
if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
    echo alarm('error', $_SESSION['error']);
    unset($_SESSION['error']);
} elseif (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
    echo alarm('success', $_SESSION['message']);
    unset($_SESSION['message']);
}
?>
<!--
-*- Developed by Hero Expert 
-*- Telegram channel: @HeroExpert_ir
*-->