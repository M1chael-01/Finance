<?php require "./frontend/pages/header.php"; ?>


<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["jmeno"]) && !isset($_SESSION["log"]))  {
    echo "<script>location.href = '?uvod'</script>";
}
?>
<link rel="stylesheet" href="./frontend/styles/app/noOperation.css">
<section>
    <div class="alert-wrapper">
        <div class="alert-box">
            <div class="alert-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="alert-content">
                <h2 class="alert-heading">Transakci nelze vytvořit</h2>
                <p>Nelze vytvořit novou transakci, protože neexistuje žádný cílový uživatel.
                Aby bylo možné vytvořit novou transakci. je potřebat vytvořit uživatele</p>
                <p class="alert-actions">
                    <a href="?hlavni-menu" class="btn btn-secondary">Vraťte se na hlavní panel</a>
                </p>
            </div>
        </div>
    </div>
</section>

<?php require "./frontend/pages/footer.php"; ?>


