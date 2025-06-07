<link rel="stylesheet" href="./frontend/styles/pages/header.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet"
/>
<link rel="shortcut icon" href="icon.ico" type="image/x-icon">
<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    require "./backend/codes/isLogin.php";require "./backend/codes/AES.php";require "./backend/codes/checkRole.php";require "./backend/databases/users.php";
    $role = CheckRole::checkRole();
?>


<?php
$GLOBALS["activeID"] = -1;  // Default active ID
$GLOBALS["title"] = "Rodinné finance - Úvod";  // Default title

if (isset($_GET["uvod"]) || empty($_GET)) {
    $GLOBALS["activeID"] = 0;
    $GLOBALS["title"] = "Rodinné finance - Úvod";
}

if (isset($_GET["hlavni-menu"]) || empty($_GET)) {
    $GLOBALS["activeID"] = 0;
    $GLOBALS["title"] = "Rodinné finance - Hlavní Menu";
}

if (isset($_GET["prihlaseni-do-aplikace"])) {
    $GLOBALS["activeID"] = 1;
    $GLOBALS["title"] = "Rodinné finance - Přihlášení do aplikace";
}

if (isset($_GET["pridat-uzivatele"])) {
    $GLOBALS["activeID"] = 1;
    $GLOBALS["title"] = "Rodinné finance - Přidat uživatele";
}

if (isset($_GET["vytvorit-profil"])) {
    $GLOBALS["activeID"] = 2;
    $GLOBALS["title"] = "Rodinné finance - Vytvořit profil";
}

if (isset($_GET["faq"])) {
    $GLOBALS["activeID"] = 3;
    $GLOBALS["title"] = "Rodinné finance - FAQ";
}

if (isset($_GET["o-aplikaci"])) {
    $GLOBALS["activeID"] = 4;
    $GLOBALS["title"] = "Rodinné finance - O aplikaci";
}

if (isset($_GET["kontakty"])) {
    $GLOBALS["activeID"] = -1;
    $GLOBALS["title"] = "Rodinné finance - Kontakty";
}

if (isset($_GET["o-nas"])) {
    $GLOBALS["activeID"] = -1;
    $GLOBALS["title"] = "Rodinné finance - O nás";
}

if (isset($_GET["muj-profil"])) {
    $GLOBALS["activeID"] = 5;
    $GLOBALS["title"] = "Rodinné finance - Můj profil";
}

if (isset($_GET["transakce"])) {
    $GLOBALS["activeID"] =-1;
    $GLOBALS["title"] = "Rodinné finance - Nová transakce";
}
if (isset($_GET["vypisy"])) {
    $GLOBALS["activeID"] =-1;
    $GLOBALS["title"] = "Rodinné finance - Vaše výpisy";
}

// var_dump(date("Y/m/d"));


// echo $role; 

?>

<title><?=$GLOBALS["title"]?></title>


<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJvZtJr8+Qy8Ifl5xgS0Dg7dw/7Y8tO1Z9lPXXC0KKlzYyAfi7+Jgk5b2jS3" crossorigin="anonymous">

<!-- Bootstrap JS (optional for components like modals, tooltips, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0l2T+jWjp2Vdlm4DsT3k8q9n6Op0z7jN5GRh/Z7AevpXopXf" crossorigin="anonymous"></script>






<header activeID = <?=$GLOBALS["activeID"]?> >
    <nav>
        <ul>
            <?php if (IsLogin::isLogin()): ?>
                <li><a  href="?hlavni-menu">Hlavní stránka</a></li>
                <?php 
                    if ($role != "user") : ?>
                        <li><a href="?pridat-uzivatele">Přidat uživatele</a></li>
                    <?php endif; ?>

                <li><a onclick="logout()">Odhlásit se</a></li>
            <?php else: ?>
                <li><a  href="?uvod">Hlavní stránka</a></li>
                <li><a href="?prihlaseni-do-aplikace">Přihlášení </a></li>
                <li><a href="?vytvorit-profil">Registrace</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="header-buttons">
        <a href="?faq">FAQ</a>
        <a href="?o-aplikaci">O aplikaci</a>

        <?php if (IsLogin::isLogin()): ?>
            <a href="?muj-profil">Můj účet</a> 
            <!-- <a onclick="deleteAcc()" >Smazat účet</a> -->
        <?php endif; ?>
    </div>
    <div onclick="showUl()" id="menu"><i class="ri-menu-line"></i></div>
</header>

<div>
    <span>
        <pre>
            <div class="role" role="<?php echo ($role == 'user') ? 0 : 1; ?>"></div>
        </pre>
    </span>
</div>



<script>

    // Define the showUl function to toggle the visibility of the navigation menu
function showUl() {
    const navMenu = document.querySelector('nav ul');  // Select the <ul> inside the <nav>
    
    // Toggle the display of the menu (show or hide)
    if (navMenu.style.display === 'block') {
        navMenu.style.display = 'none';
    } else {
        navMenu.style.display = "block";
        // navMenu.classList.add("show")
    }
}


    function showToast(message, type = "info", duration = 5000, actionCallback = null, actionText = "OK") {
        // Create toast container
        let toast = document.createElement('div');
        toast.classList.add('toast', type);
        toast.innerHTML = `
            <span>${message}</span>
            <button class="close-btn">&times;</button>
        `;
        
        // If there's an action button
        if (actionCallback) {
            let actionBtn = document.createElement("button");
            actionBtn.textContent = actionText;
            actionBtn.style.backgroundColor = "transparent";
            actionBtn.style.color = "#fff";
            actionBtn.style.border = "1px solid #fff";
            actionBtn.style.marginLeft = "10px";
            actionBtn.style.padding = "5px 10px";
            actionBtn.style.cursor = "pointer";
            actionBtn.onclick = function() {
                actionCallback();
                toast.classList.remove("show");
                document.body.removeChild(toast);
            };
            toast.appendChild(actionBtn);
        }

        // Close button functionality
        toast.querySelector('.close-btn').onclick = function() {
            toast.classList.remove('show');
            document.body.removeChild(toast);
        };

        // Add toast to body
        document.body.appendChild(toast);

        // Show the toast
        setTimeout(() => toast.classList.add('show'), 100);

        // Hide the toast after the specified duration
        setTimeout(() => {
            toast.classList.remove('show');
            document.body.removeChild(toast);
        }, duration);
    }
    function deleteAcc() {
    // Get the role from the element
    let roleElement = document.querySelector(".role");
    if (!roleElement) {
        console.error("Role element not found!");
        return; // Exit if no role element is found
    }

    let role = roleElement.getAttribute("role");
    let msg = "";
    let data;

    // Ensure that the role is either "0" (user) or "1" (admin)
    if (role === "0") {
        msg = "user";
        data = { deleteUser: true };
    } else if (role === "1") {
        msg = "admin";
        data = { deleteAdmin: true };
    } else {
        console.error("Invalid role: " + role);
        return; // Exit if role is invalid
    }

    // Confirm deletion action
    let q = confirm("Are you sure you want to delete the account of the " + msg + "?");
    if (!q) return; // If user cancels, exit function

    // Perform AJAX request to delete the account
    $.ajax({
        type: "POST",
        url: "./backend/codes/deleteAcc.php",  // Ensure this points to the correct PHP file
        data: data, // Sending the data object to the backend
        success: function(response) {
            // Assuming the server sends back a response
            if (response.success) {
                alert(response.message); // Display success message from server
                // Optionally, you can redirect or refresh the page after success
                window.location.reload();
            } else {
                alert("Failed to delete the account: " + response.message);
            }
        },
        error: function(xhr, status, error) {
            // Handle errors if the AJAX request fails
            console.error("An error occurred: " + error);
            alert("There was an error while deleting the account.");
        }
    });
}





</script>


<style>
 /* Base Toast Styles */
.toast {
    visibility: hidden;
    min-width: 300px;
    margin-left: -150px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 8px;
    padding: 15px;
    position: fixed;
    z-index: 1000;
    left: 50%;
    bottom: 30px;
    font-size: 16px;
    opacity: 0;
    transition: opacity 0.5s, visibility 0.5s;
}

/* Show toast */
.toast.show {
    visibility: visible;
    opacity: 1;
}

/* Success Toast */
.toast.success {
    background-color: #4CAF50; /* Green */
}

/* Error Toast */
.toast.error {
    background-color: #f44336; /* Red */
}

/* Info Toast */
.toast.info {
    background-color: #2196F3; /* Blue */
}

/* Custom Positioning */
.toast.top-left {
    top: 30px;
    bottom: unset;
}

/* Close Button for Toast */
.toast .close-btn {
    background: transparent;
    border: none;
    color: #fff;
    font-size: 18px;
    margin-left: 15px;
    cursor: pointer;
    opacity: 0.8;
}

.toast .close-btn:hover {
    opacity: 1;
}


</style>
            
<script src="./frontend/js/header.js"></script>