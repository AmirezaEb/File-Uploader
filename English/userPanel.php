<?php

require 'config/init.php';

/* 
* Developed by Hero Expert 
* Telegram channel: @HeroExpert_ir
*/

if (isset($_COOKIE['Logined'])) {
    $cookieExplode = explode('-.-', encodeORdecode($_COOKIE['Logined'])['deCode']);
    $chekUser = checkUserName($cookieExplode[0]);
    if ($chekUser != 1) {
        setcookie("Logined", "", time() - 300,"/");
        redirect('signIn');
    }
} else {
    redirect('signIn');
}

if (isset($_GET['delete'])) {
    deleteFile($_GET['delete']);
    unlink('uploads/' . $_GET['delete']);
    redirect('userPanel');
}
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$pagination = receiveRowFile($cookieExplode[1]);
$files = receiveFile($cookieExplode[1], $page);
$num = 1;
$copyUrlClass  = 1;
$spans = ['D','e','v','e','l','o','p','e','d',' ','B','y',' ','H','e','r','o','E','x','p','e','r','t',' ','T','e','a','m'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link href="https://fonts.cdnfonts.com/css/tough-love" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/userPanel.css">
</head>

<body>

    <div class="table-div">
        <header class="header">
            <div class="header-div">
                <h2 class="header-title">
                    <a href="<?= $media->telegram?>" class="HeroExpert">
                        <?php foreach($spans as $span):?>
                        <span><?= $span ?></span>
                        <?php endforeach; ?>
                    </a>
                </h2>
            </div>
            <a href="./?Message=LogOut" class="logOut">
                LogOut
                <i class="	fa fa-sign-out pl-1"></i>
            </a>
            <a href="./" class="comeBackBtn">
                <i class="fa fa-arrow-left pr-1"></i>
                Go Back
            </a>
        </header>

        <table class="table">
            <thead class="table-header">
                <tr>
                    <th class="column1">#</th>
                    <th class="column2">type</th>
                    <th class="column3">File Name</th>
                    <th class="column4">File Size</th>
                    <th class="column5">operation</th>
                </tr>
            </thead>

            <?php foreach ($files as $file) : $formatFile = explode('.', $file->name); ?>
                <tbody class="table-body">
                    <tr>
                        <td class="column1"><?= $num++ ?></td>
                        <td class="column2">
                            <a class="preview-link" href="<?= $file->url ?>">
                                <?php if ($formatFile[1] == 'jpg' || $formatFile[1] == 'png' || $formatFile[1] == 'jpeg') { ?>
                                    <i class="fa fa-file-image-o preview-icon"></i>
                                    <?php }
                                if ($formatFile[1] == 'zip' || $formatFile[1] == 'rar') { ?>
                                    <i class="fa fa-file-zip-o preview-icon"></i>
                                <?php }
                                if ($formatFile[1] == 'mp4') { ?>
                                    <i class="fa fa-file-movie-o preview-icon"></i>
                                <?php }
                                if ($formatFile[1] == 'mp3' || $formatFile[1] == 'mkv') { ?>
                                    <i class="fa fa-file-audio-o preview-icon"></i>
                                <?php } ?>
                            </a>
                        </td>
                        <td class="column3"><?= $file->name;?></td>
                        <td class="column4"><?= GetSize($file->url) ?></td>
                        <td class="column5">
                            <div class="Buttons">
                                <p class="file-URL i<?= ++$copyUrlClass ?>"><?= $file->url ?></p>
                                <button type="button" class="copy-link" data-clipboard-demo="" data-clipboard-target=".i<?= $copyUrlClass ?>" data-clipboard-action="copy" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-content="copied!">
                                    <span>Copy</span>
                                    <i class="fa fa-clone copy-icon"></i>
                                </button>
                                <a class="delete-btn" style="color:aliceblue;text-decoration:none;" href="?delete=<?= $file->name ?>">
                                    <span>Delete</span>
                                    <i class="fa fa-trash delete-icon"></i>
                                </a>
                            </div>
                        </td>
                        
                    </tr>
                <?php endforeach ?>
                </tbody>
        </table>
    </div>

    <?php if ($pagination > 1) : ?>
        <div class="pagination">
            <ul class="page-list">
                <li class="<?= ($page == 1) ? "page-item disabled" : "page-item" ?>">
                    <a href="<?= '?page=' . ($page - 1) ?>" class="page-link">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
                <?php for ($pages = 1; $pages <= $pagination; $pages++) { ?>
                    <li class="<?= ($page == $pages) ? "page-item disabled" : "page-item" ?>">
                        <a href="<?= "userPanel?page=$pages" ?>" class="page-link"><?= $pages ?></a>
                    </li>
                <?php } ?>
                <li class="<?= ($pagination <= $page) ? "page-item disabled" : "page-item" ?>">
                    <a href="<?= 'userPanel?page=' . ($page + 1) ?>" class="page-link">
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
            </ul>
        </div>
    <?php endif ?>
    <script src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
    <script src="assets/js/clipboard.min.js"></script>
    <script src="assets/js/userPanel.js"></script>

</body>

</html>

<!--* 
 * Developed by Hero Expert 
 * Telegram channel: @HeroExpert_ir
*-->