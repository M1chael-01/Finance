<head>
    <link rel="stylesheet" type="text/css" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="./frontend/styles/pages/createAcc.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="form-v10">
    <?php require "./frontend/pages/header.php";?>

    <div class="page-content">
        <div class="form-v10-content">
            <form class="form-detail" action="#" method="post" id="myform">
                <div class="form-left">
                    <h2>Nová registrace</h2>
                    <div class="form-row">
                        <span class="select-btn">
                            <i class="zmdi zmdi-chevron-down"></i>
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="form-row form-row-1">
                            <input type="text" name="first_name" id="first_name" class="input-text" placeholder="Křestní jméno" required>
                        </div>
                        <div class="form-row form-row-2">
                            <input type="text" name="last_name" id="last_name" class="input-text" placeholder="Přijmení" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <input type="email" name="email" class="email" id="email" placeholder="E-mail" required>
                    </div>
                    <div class="form-row">
                        <input type="password" name="password" class="password" id="password" placeholder="Heslo" required>
                    </div>
                    <div class="form-row">
                        <input type="date" name="date" class="date" id="date" required>
                    </div>
                    <button type="submit" class="login">Vytvořit si účet</button>
                </div>
                <div class="form-right">
                    <!-- Empty section -->
                </div>
            </form>
        </div>
    </div>

    <?php require "./frontend/pages/information.php"; ?>

    <?php require "./frontend/pages/footer.php";?>

    <script src="./frontend/js/createAcc.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>

</body>
</html>
