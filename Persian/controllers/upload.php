<?php

require '../config/init.php';

# Check If Image File Is A Actual Image Or Fake Image
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit'] == 'Upload') {
    try {

        if (!isset($_COOKIE['Logined'])) {
            setErrorAndRedirect('برای آپلود باید ثبت نام کنید یا وارد حساب خود شوید!', './');
        }

        $target_dir = '../uploads/';
        $fileName = $_FILES["fileToUpload"]["name"];
        $fileType = explode('/', $_FILES['fileToUpload']['type']);

        if ($fileType[1] == 'x-zip-compressed') {
            $fileType[1] = 'zip';
        } elseif ($fileType[1] == 'mpeg') {
            $fileType[1] = 'mp3';
        } elseif ($fileType[1] == 'octet-stream') {
            $fileType[1] = 'rar';
        }

        if (file_exists($target_dir . $fileName) || stripos($fileName, ' ') || strlen($fileName) > 10) {
            $fileName = fileNameCreate() . '.' . $fileType[1];
        }

        $targetFile = $target_dir . $fileName;
        $uploadOk = 1;


        # Check File Size
        if ($_FILES["fileToUpload"]["size"] > Limit) {
            $uploadOk = 0;
            setErrorAndRedirect('اندازه فایل انتخابی از حد مجاز بیشتر است!', './');
        }

        # Allow Certain File Formats
        if (!in_array($fileType[1], AllowedFormat)) {
            $uploadOk = 0;
            $message = 'فقط فایل های ';
            foreach (AllowedFormat as $AllowedFormat) {
                $message .=  '<b>' . strtoupper($AllowedFormat) . '</b> ';
            }
            setErrorAndRedirect($message . ' مجاز هستند!', './');
        }

        # Check If Upload Ok is Set To 0 By An Error
        if ($uploadOk == 0) {
            setErrorAndRedirect('با عرض پوزش، هنگام آپلود فایل شما خطایی رخ داد!','./');

            # If Everything Is Ok, Try To Upload File
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                $cookieValue = explode('-.-', encodeORdecode($_COOKIE['Logined'])['deCode']);
                seveFile($cookieValue[1], BASE_URL . 'uploads/' . $fileName, $fileName);
                setMessageAndRedirect('آپلود با موفقیت انجام شد!','./');
            } else {
                setErrorAndRedirect('با عرض پوزش، هنگام آپلود فایل شما خطایی رخ داد!','./');
            }
        }
    } catch (Exception $e) {
        setErrorAndRedirect('با عرض پوزش، هنگام آپلود فایل شما خطایی رخ داد!','./');
    }
}
