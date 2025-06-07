<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./frontend/styles/pages/index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

<?php


    if(isset($_GET["prihlaseni-do-aplikace"])) {require "./frontend/pages/login.php"; exit; }
    if(isset($_GET["vytvorit-profil"])) {require "./frontend/pages/createAcc.php"; exit; }

    if(isset($_GET["hlavni-menu"])) {require "./frontend/pages/app/main.php"; exit;}

  
    if(isset($_GET["o-aplikaci"])) {require "./frontend/pages/about.php"; exit;}
    if(isset($_GET["kontakty"])) {require "./frontend/pages/contacts.php"; exit;}
    if(isset($_GET["vice-informaci"])) {require "./frontend/pages/moreInfo.php"; exit;}
    if(isset($_GET["faq"])) {require "./frontend/pages/faq.php"; exit;}
    if(isset($_GET["o-nas"])) {require "./frontend/pages/team.php"; exit;}


        // only 4 logged 
    if(isset($_GET["transakce"])) {require "./frontend/pages/app/transaction.php"; exit;}    
    if(isset($_GET["muj-profil"])) {require "./frontend/pages/app/profile.php"; exit;}
    if(isset($_GET["pridat-uzivatele"])) {require "./frontend/pages/app/addUser.php"; exit;}


    if(isset($_GET["vypisy"]) ){require "./frontend/pages/app/statement.php"; exit;}
    if(isset($_GET["zadny-uzivatele"]) ){require "./frontend/pages/app/noOperation.php"; exit;}


?>



</head>
<body>
    <?php require "./frontend/pages/header.php"; ?>
    <?php require "./frontend/pages/home.php"; ?>
    <?php require "./frontend/pages/footer.php"; ?>
</body>
</html>
