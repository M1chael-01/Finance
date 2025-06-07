<link rel="stylesheet" href="./frontend/styles/pages/home.css">
<?php
    (isset($_SESSION["jmeno"]) && isset($_SESSION["log"])) ?  $login = true : $login = false;

    if($login) {
        $GLOBALS["title"] = "Vítejte ve Vaší aplikaci pro finance";
        $GLOBALS["describe"] = "Tato aplikace vám umožňuje efektivně spravovat vaše finanční transakce a přehledy.";
        $GLOBALS["btn-1"] = "Nová transakce";
        $GLOBALS["btn-2"] = "Výpisy transakcí";
        $GLOBALS["btn-1-href"] = "?transakce";
        $GLOBALS["btn-2-href"] = "?vypisy";
    }
    
    else{
        $GLOBALS["title"] = "Spravujte rodinné finance online";
        $GLOBALS["describe"] = "Získejte nejlepší finanční služby na trhu";
        $GLOBALS["btn-1"] = "Zjistit více";
        $GLOBALS["btn-2"] = "Kontaktovat";
        $GLOBALS["btn-1-href"] = "?o-aplikaci";
        $GLOBALS["btn-2-href"] = "?kontakty";
    }
?>
<section class="hero">
        <div class="hero-content">
            <h1><?=$GLOBALS["title"] ?></h1>
            <p><?= $GLOBALS["describe"]?></p>
            <div class="cta-buttons">
                <a href="<?=$GLOBALS["btn-1-href"] ?>" class="btn"><?= $GLOBALS["btn-1"]?></a>
                <a href="<?=$GLOBALS["btn-2-href"] ?>" class="btn"><?= $GLOBALS["btn-2"]?></a>
               
               
            </div>
        </div>
    </section>