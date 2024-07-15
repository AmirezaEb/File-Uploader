<?php

/* 
 * Developed by Hero Expert 
 * Telegram channel: @HeroExpert_ir
*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

# Redirect The User To Another Page
function redirect(string $Url): void
{
    if (!headers_sent()) {
        header("Location: $Url");
    } else {
        echo "<script type='text/javascript'>window.location.href='$Url'</script>";
        echo "<noscript><meta http-equiv='refresh' content='0;url=$Url'/></noscript>";
    }
    exit;
}

# Set Success Message Session
function setMessageAndRedirect(string $message, string $target): void
{
    $_SESSION['message'] = $message;
    redirect(BASE_URL . $target);
}

# Set Error Message Session
function setErrorAndRedirect(string $message, string $target): void
{
    $_SESSION['error'] = $message;
    redirect(BASE_URL . $target);
}

# Create A New Random Name For The Files
function fileNameCreate(): string
{
    $length = rand(5, 11);
    $characters = 'aA0bBcC1dDeE2fFgG3hHiI4jJkK5lLmM6nNoO7pPqQ8rRsS9tTuUvVwWxXyYzZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

# Inserting Information Into The DataBase
function seveFile(int $user_id, string $url, string $name): bool
{
    global $connect;
    $sql = "INSERT INTO file_upload (user_id,url,name) VALUES (:user_id,:url,:name);";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':url', $url, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->rowCount() ? true : false;
}

# Get The Download Link Of The Available File
function receiveFileUrl(string $fileName): string
{
    global $connect;
    $sql = "SELECT * FROM file_upload WHERE name = :fileName;";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':fileName', $fileName, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result->url;
}

# Create A New User Account
function addUser(string $userName, string $passWord, string $email): int
{
    global $connect;
    $sql = "INSERT INTO users (username,password,email) VALUES (:username,:password,:email);";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':username', $userName, PDO::PARAM_STR);
    $stmt->bindParam(':password', $passWord, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $connect->lastInsertId();
    return $result;
}

# Check If The Email Exists
function checkEmail(string $email): bool
{
    global $connect;
    $sql = "SELECT * FROM users WHERE (email = :email);";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->rowCount() ? true : false;
}

# Check If Username ExistsCheck If Username Exists
function checkUserName(string $Username): bool
{
    global $connect;
    $sql = "SELECT * FROM users WHERE (username = :username);";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':username', $Username, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->rowCount() ? true : false;
}

# Check If The Password Is Strong
function checkPassword(string $passWord): int
{
    $hero = 0;
    $size = strlen($passWord);
    foreach (count_chars($passWord, 1) as $v) {
        $p = $v / $size;
        $hero -= $p * log($p) / log(2);
    }
    $strength = ($hero / 3.2) * 100;
    if ($strength > 100) {
        $strength = 100;
    }
    if (!preg_match("#[0-9]+#", $passWord)) {
        return 1;
    }
    if (!preg_match("#[A-Z]+#", $passWord)) {
        return 1;
    }
    if ($strength < 60) {
        return 1;
    }
    return 0;
}

# Find And Check Email And Password
function receiveUser(string $key, string $passWord): bool
{
    global $connect;
    $sql = "SELECT * FROM users WHERE (username = :username OR email = :email) AND (password = :password);";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':username', $key, PDO::PARAM_STR);
    $stmt->bindParam(':email', $key, PDO::PARAM_STR);
    $stmt->bindParam(':password', $passWord, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->rowCount() ? true : false;
}

/* 
 * Developed by Hero Expert 
 * Telegram channel: @HeroExpert_ir
*/

# Find And Check UserName Or Email
function receiveUserName(string $key)
{
    global $connect;
    $sql = "SELECT * FROM users WHERE (username = :username OR email = :email);";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':username', $key, PDO::PARAM_STR);
    $stmt->bindParam(':email', $key, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
}

# Send A New Password To The User
function sendEmail(string $sendToo, string $newPassword): void
{
    global $emailServer;
    global $media;
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = $emailServer->secure;
    $mail->Port = $emailServer->port;
    $mail->Host = $emailServer->host;
    $mail->Username = $emailServer->userName;
    $mail->Password = $emailServer->passWord;
    $mail->From = $emailServer->userName;
    $mail->FromName = "DO NOT REPLY";
    $mail->addAddress($sendToo, "");
    $mail->isHTML(true);
    $mail->Subject = "NewPassword";
    $mail->Body = "<html dir='rtl'> 
 
<head> 
    <title>HTML email</title>
    <style> 
        * { 
            direction: rtl;
            text-align: center; 
        } 
        body { 
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .div-container {
            max-width: 480px;
            background-color: #fff;
            width: 360px;
            margin: 3rem auto;
            border-top: 4px solid #713dea;
            border-bottom: 4px solid #713dea;
            border-radius: 1rem;
        }
        
        .header {
   	        text-align: center;
        }

        b { 
            display: block; 
            width: 50%; 
            text-align: center; 
            padding: 1rem; 
            margin: 1rem auto; 
            background-color: #713dea; 
            font-size: 1.2rem; 
            border-radius: .5rem; 
            cursor: pointer; 
            color: #fff;
        } 
 
        h2 { 
            color: #713dea; 
        } 
        .logo-a {
            direction: ltr;
            position: absolute!important;
            left: 15px;
            top: 15px;
        }
        .logo {
            width: 75px;
            height: 40px;
        }
 
        p { 
            margin: 1rem 0; 
            text-align: center; 
            width: 100%; 
        } 
        .resetLogo { 
            max-height: 180px; 
            color: #333; 
        }
        h5 { 
            display: flex;
            text-align: center!important;
            padding: 0rem 100px;
            width: 100%;
            margin: 0rem;
        } 
        .icon-link {
            margin: 16px 4px;
            display: inline;
        }
        .icon { 
            margin: 0 8px; 
            display: inline;
            width: 25px;
            height: 25px;
            max-height: 25px;
            max-width: 25px;   
        }
        .icon-telegram {
            width: 31px;
            height: 31px;
            margin: 0 8px; 
            display: inline;
            max-height: 35px;
            max-width: 35px;  
        }
    </style> 
</head> 
 
<body> 
    <div class='div-container'>
    	<div class='header'>
    	    <h2>Hero Expert</h2> 
    	</div>
        <p>
            <img class='resetLogo' src='" . BASE_URL . "assets/images/reset-image.png'> 
        </p>
        <h2>Welcome,</h2> 
        <h3>Your New Account Password Is : <b class='password'>$newPassword</b></h3> 
        <h5> 
            <a class='icon-link' href='$media->telegram'><img src='" . BASE_URL . "assets/images/telegram-image.png' class='icon-telegram'></a> 
            <a class='icon-link' href='$media->github'><img src='" . BASE_URL . "assets/images/github-image.png' class='icon'></a> 
            <a class='icon-link' href='$media->linkedin'><img src='" . BASE_URL . "assets/images/linkedin-image.png' class='icon'></a> 
        </h5> 
    </div>
</body> 
 
</html>";
    $mail->AltBody = "";
    $mail->send();
}

# Encryption And Encryption Operations
function encodeORdecode(string $str): array
{
    $result = [
        'deCode' => openssl_decrypt($str, 'AES-128-ECB', '@HeroExpert_ir'),
        'enCode' => openssl_encrypt($str, 'AES-128-ECB', '@HeroExpert_ir')
    ];
    return $result;
}

# Creating A New Password
function newPassword(int $length = 8): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#-_&!?*][}{\/+)(&%$';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

# Placing The New Password In The DataBase
function resetPassword(string $email, string $NewPassword): bool
{
    global $connect;
    $sql = "UPDATE users SET password=:passWord WHERE (email = :email);";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':passWord', $NewPassword, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->rowCount() ? true : false;
}

# Get The Number Of User Uploaded Files For Pagination
function receiveRowFile(string $id): int
{
    global $connect;
    $pagination = 6;
    $sql = "SELECT * FROM file_upload WHERE user_id = :id;";
    $stmt = $connect->prepare($sql);
    $stmt->execute([':id' => $id]);
    $res = $stmt->rowCount();
    $result = ceil($res / $pagination);
    if ($result > 10) {
        $result = 10;
    }
    return $result;
}

# Receive Files Uploaded By tThe User
function receiveFile(string $id, string $page): array
{
    global $connect;
    $pagination = 6;
    $page_first_result = ($page - 1) * $pagination;
    $sql = "SELECT * FROM file_upload WHERE user_id = :id LIMIT  $page_first_result , $pagination;";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchall(PDO::FETCH_OBJ);
    return $result;
}

# The Operation Of Deleting The Uploaded File In The DataBase
function deleteFile(string $nameFile): bool
{
    global $connect;
    $sql = "DELETE FROM file_upload WHERE name = :name;";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':name', $nameFile, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->rowCount() ? true : false;
}

# Get The File Size
function GetSize(string $url): string
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); # Not necessary unless the file redirects
    $data = curl_exec($ch);
    curl_close($ch);
    if ($data === false) {
        return -1;
    }
    $size = 0;
    if (preg_match('#Content-Length: (\d+)#i', $data, $matches)) {
        if (trim($matches[1]) >= 1000024) {
            $size = ceil(trim($matches[1]) / 1000024) . ' Mb'; # 1000000 = 1Mb
        } elseif (trim($matches[1]) < 1000024) {
            $size = ceil(trim($matches[1]) / 1024) . ' Kb'; # 1000000 = 1Mb
        }
    }
    return $size;
}

# Display Messages And Errors
function alarm(string $mode, string $message): string
{
    $alarm = "<script>
    Swal.fire({
        title: '$message',
        icon: '$mode',
        toast: true,
        width: '31em',
        position: 'top-start',
        showConfirmButton: false,
        timer: 3500,
        background: '#a586f0',
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    })
    </script>";
    return $alarm;
}

/* 
 * Developed by Hero Expert 
 * Telegram channel: @HeroExpert_ir
*/

?>