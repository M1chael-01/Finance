<link rel="stylesheet" href="./frontend/styles/pages/login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

<?php require "./frontend/pages/header.php";?>

    <?php require "./frontend/pages/information.php"; ?>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form >
        <h3>Přihlašte se</h3>

        <label for="username">Jméno</label>
        <input type="text" placeholder="Zadejte křestní jméno" id="username">

        <label for="password">Heslo</label>
        <input type="password" placeholder="Zadejte heslo" id="password">

        <button>Vstoupit</button>
        <?php 
            // souhlasm se zpracováním udajue 
        ?>
       
    </form>

    <?php require "./frontend/pages/footer.php";?>

    <script src="./frontend/js/login.js"></script>
</body>
</html>


