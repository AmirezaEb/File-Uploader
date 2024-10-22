<?php

require "config/init.php";

if (isset($_GET['Message']) && $_GET['Message'] == 'LogOut') {
    setcookie("Logined", "", time() - 300, "/");
    setMessageAndRedirect('', './');
}
?>

<!--
-*- Developed by Hero Expert 
-*- Telegram channel: @HeroExpert_ir
*-->

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.11.0/sweetalert2.min.css">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/iranyekan">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>فایل آپلودر</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.11.0/sweetalert2.all.js"></script>
</head>

<body>
    <?php if (!isset($_SESSION['error']) && !isset($_SESSION['file']) && !isset($_SESSION['message'])) : ?>
        <div class="loading-wrapper">
            <div class="loading-content"></div>
        </div>
    <?php endif; ?>

    <div class="shadow">
        <div class="header">
            <div class="container">
                <div class="header-nav">
                    <?php if (!isset($_COOKIE['Logined'])) : ?>
                        <div class="header-navbar">
                            <div class="header-text">آپلود عکس و فایل رایگان با لینک مستقیم</div>
                            <div class="register">
                                <a href="signIn" class="login button">ورود</a>
                                <a href="signUp" class="signUp button">ثبت نام</a>
                            </div>
                        </div>
                    <?php else : $cookieValue = explode('-.-', encodeORdecode($_COOKIE['Logined'])['deCode']); ?>
                        <div class="active-head d-flex">
                            <div class="header-text">سلام <span class="username"><?= $cookieValue[0] ?></span> خوش آمدی </div>
                            <div class="register">
                                <a href="userPanel" class="user-panel button">پنل کاربری</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <form action="controllers/upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <i class="fa-solid fa-check check-icon"></i>
            <p>فایل خود را به اینجا بکشید یا در این قسمت کلیک کنید</p>
            <div class="uploaded-div">
                <div class="file-details">
                    <i class="fa-solid fa-file-lines file-details-icon"></i>
                    <span class="file-details-name">
                        <a class="file-details-name-link" href="#"></a>
                    </span>
                    |
                    <span class="file-details-size"></span>
                </div>
                <i class="fas fa-trash delete-icon"></i>
            </div>
            <button id="upload-btn" type="submit" value="Upload" name="submit">آپلود</button>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/clipboard.min.js"></script>
<script src="assets/js/main.js"></script>

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