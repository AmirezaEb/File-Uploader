<?php require 'config/init.php'; ?>

<!--* 
 * Developed by Hero Expert 
 * Telegram channel: @HeroExpert_ir
*-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/tough-love" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/forgetPass.css">
    <title>Password Recovery</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.11.0/sweetalert2.all.js"></script>
</head>

<body>
    <div class="login-box">
        <h2>forget password</h2>
        <form action="controllers/resetPassword" method="post">
            <div class="user-box username-input-div" data-validator="Please Enter a Valid Email">
                <input class="username-input" type="text" name="email">
                <label>Email</label>
            </div>
            <div class="user-box">
                <a class="signIn-text" href="signIn">
                    Login With Email Or Username
                </a>
            </div>
            <!-- class="forget-btn" -->
            <button class="forget-btn" type="submit" name="forgetPass">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Send New Password
            </button>

        </form>
    </div>
    <script src="assets/js/forgetPass.js"></script>
</body>

</html>
<?php
if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
    echo alarm('error', $_SESSION['error']);
    unset($_SESSION['error']);
} elseif (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
    echo alarm('success', $_SESSION['message']);
    unset($_SESSION['message']);
}
?>

<!--* 
 * Developed by Hero Expert 
 * Telegram channel: @HeroExpert_ir
*-->