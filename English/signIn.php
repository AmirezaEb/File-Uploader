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
    <link rel="stylesheet" href="assets/css/signIn.css">
    <link href="https://fonts.cdnfonts.com/css/tough-love" rel="stylesheet">
    <title>Sign In</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.11.0/sweetalert2.all.js"></script>
</head>

<body>
    <div class="login-box">
        <h2>Sign In</h2>
        <form action="controllers/signIn" method="post">
            <div class="user-box username-input-div" data-validator="Letters a-z Are Allowed">
                <input class="username-input" type="text" name="key">
                <label>Username | Email</label>
            </div>
            <div class="user-box password-input-div" data-validator="Please Enter Your Password">
                <input class="password-input" type="password" name="password">
                <label>Password</label>
                <div class="icons d-none">
                    <p class="eye-icon-container">
                        <i id="eye-icon" class="fa-solid fa-eye eye-icon"></i>
                    </p>
                    <p class="eye-slash-icon-container show-icon">
                        <i id="eye-slash-icon" class="fa-solid fa-eye-slash eye-slash-icon"></i>
                    </p>
                </div>
            </div>
            <div class="user-box">
                <a class="signUp-text" href="signUp">
                    Sign Up
                </a>
            </div>
            <button class="signIn-btn" type="submit" name="signIn">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Sign In
            </button>
            <div class="user-box">
                <a class="forget-link" href="forgetPassword">
                    forgot your password ?
                </a>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/signIn.js"></script>
    <script src="assets/js/clipboard.min.js"></script>
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

<!--* 
 * Developed by Hero Expert 
 * Telegram channel: @HeroExpert_ir
*-->