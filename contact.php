<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="game_item trade Template">
        <meta name="keywords" content="마비노기, mabinogi, game, item">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>감자마켓</title>
        <!--CSS style-->
        <link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="../css/style.css" type="text/css">
        <link rel="stylesheet" href="../css/logo.css" type="text/css">
        <link rel="stylesheet" href="../css/index.css" type="text/css">
        <link rel="stylesheet" href="../css/contact.css" type="text/css">
    </head>
    <body>
        <!-- Js Plugin-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.js"></script>

        <?php

            include "./module/header.php";

            include "./module/main_nav.php";

            include "./module/contact/contact_module.php";

            include "./module/footer.php";

        ?>

    </body>
</html>