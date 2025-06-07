<?php require "./frontend/pages/header.php";?>
<head>
    <link rel="stylesheet" href="./frontend/styles/app/addUser.css">
</head>

<?php
   

    if(CheckRole::checkRole() != "admin") {
        echo "<script>location.href = '?uvod'</script>";
    }
?>

<body>
<section>
    <div class="container">
        <h2>Přidat nového uživatele</h2>
        <form id="userForm">
            <div class="form-row">
                <div class="form-group">
                    <label for="firstName">Jméno</label>
                    <input  type="text" id="firstName" placeholder="Zadejte jméno" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Příjmení</label>
                    <input type="text" id="lastName" placeholder="Zadejte příjmení" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Zadejte email" required>
                </div>
                <div class="form-group">
                    <label for="password">Heslo</label>
                    <input type="text" id="password" placeholder="Generované heslo" disabled>
                    
                </div>
            </div>
            <button type="button" id="generatePassword">Generovat heslo</button>
            <button type="submit">Přidat uživatele</button>
        </form>
    </div>
</section>

<?php require "./frontend/pages/information.php"; ?>
<?php require "./frontend/pages/footer.php";?>

<script src="./frontend/js/generatePassword.js"></script>
<script src="./frontend/js/addUser.js"></script>

</body>
</html>
