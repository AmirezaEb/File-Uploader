<?php require "config/init.php"; ?>

<!--
-*- Developed by Hero Expert 
-*- Telegram channel: @HeroExpert_ir
*-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/page404.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body>
    <!-- about -->
    <div class="about">
        <a class="bg_links social github" href="<?= $media->github ?>" target="_blank">
            <i class="ri-github-fill custom-icons"></i>
        </a>
        <a class="bg_links social telegram" href="<?= $media->telegram ?>" target="_blank">
            <i class="ri-telegram-fill custom-icons"></i>
        </a>
        <a class="bg_links social linkedin" href="<?= $media->linkedin ?>" target="_blank">
            <span class="icon"></span>
        </a>
        <a class="bg_links logo"></a>
    </div>
    <!-- end about -->

    <nav>
        <div class="menu">
            <p class="website_name">Hero Expert ir</p>
        </div>
    </nav>

    <section class="wrapper">

        <div class="container">

            <div id="scene" class="scene" data-hover-only="false">


                <div class="circle" data-depth="1.2"></div>

                <div class="one" data-depth="0.9">
                    <div class="content">
                        <span class="piece"></span>
                        <span class="piece"></span>
                        <span class="piece"></span>
                    </div>
                </div>

                <div class="two" data-depth="0.60">
                    <div class="content">
                        <span class="piece"></span>
                        <span class="piece"></span>
                        <span class="piece"></span>
                    </div>
                </div>

                <div class="three" data-depth="0.40">
                    <div class="content">
                        <span class="piece"></span>
                        <span class="piece"></span>
                        <span class="piece"></span>
                    </div>
                </div>

                <p class="p404" data-depth="0.50">404</p>
                <p class="p404" data-depth="0.10">404</p>

            </div>

            <div class="text">
                <article>
                    <p>Oh, you seem to be lost my fmriend <br>Please return to the main page</p>
                    <a href="<?= BASE_URL ?>"><button>Maine Page</button></a>
                </article>
            </div>

        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="<?= BASE_URL ?>assets/js/page404.js"></script>
</body>

</html>

<!--
-*- Developed by Hero Expert 
-*- Telegram channel: @HeroExpert_ir
*-->