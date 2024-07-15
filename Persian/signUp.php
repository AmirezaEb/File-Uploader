<?php
require 'config/init.php';
?>

<!DOCTYPE html>
<html lang="fa">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/iranyekan">
  <link rel="stylesheet" href="assets/css/signUp.css">
  <title>ثبت نام</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.11.0/sweetalert2.all.js"></script>
</head>

<body>
  <div class="login-box">
    <h2>ثبت نام</h2>
    <form action="controllers/signUp" method="post">
      <div class="user-box username-input-div" data-validator="فقط حروف a-z مجاز هستند">
        <input class="username-input" id="username-input" type="text" name="username">
        <label>نام کاربری</label>
      </div>
      <div class="user-box email-input-div" data-validator="لطفا ایمیل معتبر وارد کنید">
        <input class="email-input" id="email-input" type="text" name="email">
        <label>ایمیل</label>
      </div>
      <div class="user-box password-input-div" data-validator="لطفا رمز عبور را وارد کنید">
        <input class="password-input" id="password-input" type="password" name="password">
        <label>رمز عبور</label>
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
        <a class="Login-text" href="signIn">
          ورود با نام کاربری یا ایمیل
        </a>
      </div>
      <!--  -->
      <button class="signUp-btn" id="signUp-btn" type="submit" name="signUp">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        ثبت نام
      </button>
    </form>
  </div>

  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/clipboard.min.js"></script>
  <script src="assets/js/signUp.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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