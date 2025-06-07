<link rel="stylesheet" href="./frontend/styles/app/profile.css">

<?php require "./frontend/pages/header.php"; ?>



<?php

// if()



// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION["id"]) && !isset($_SESSION["log"]) && !isset($_SESSION["jmeno"])) {
    echo "<script> location.href='?uvod';</script>";
}


function get() {
    if (isset($_SESSION["jmeno"])) {
        $jmeno = $_SESSION["jmeno"]; 
        $con = users(); 

        $sql = "SELECT id, jmeno, prijmeni, email,role FROM uzivatel";
        if ($stmt = mysqli_prepare($con, $sql)) {

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);


                while ($row = mysqli_fetch_assoc($result)) {

                    $decrypted_jmeno = AES::decryption($row["jmeno"]);

                    if ($decrypted_jmeno === $jmeno) {

                        // FIX THE NAME 
                        // Store the data in session variables for later use
                        $_SESSION["fName"] = AES::decryption($row["jmeno"]);
                        $_SESSION["name"] = AES::decryption($row["jmeno"]);
                        $_SESSION["lName"] =AES::decryption( $row["prijmeni"]);
                        $_SESSION["email"] = AES::decryption($row["email"]);
                        $_SESSION["id"] = $row["id"];
                        $_SESSION["role"] = $row["role"];

                    }
                }

                if (!isset($_SESSION["fName"])) {
                    echo "No user found with the specified username.";
                }
            } else {
                die("Error executing query: " . mysqli_error($con));
            }
        } else {
            // Error handling if the SQL statement preparation fails
            die("Error preparing SQL statement: " . mysqli_error($con));
        }
    } else {
        // Handle the case when the session variable "jmeno" is not set
        echo "Session variable 'jmeno' is not set.";
    }
    
}

get();

if( $_SESSION["fName"] == "" || !isset($_SESSION["fName"])) {
    session_destroy();
    echo "<script> location.href='?uvod';</script>";
}
// $_SESSION["role"] = "admin";

?>
   <?php require "./frontend/pages/information.php"; ?>

   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<section>
    <div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <!-- Profile section -->
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <h2>Váš osobní profil</h2>
                            </div>
                        </div>

                        <!-- Account Information section -->
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 id="h6">Informace o účtu</h6>
                                <form>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="jmeno">Křestní jméno</label>
                                            <input  type="text" id="jmeno" name="jmeno" value="<?php echo $_SESSION["fName"] ?? ''; ?>" class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="prijmeni">Příjmení</label>
                                            <input type="text" id="prijmeni" name="prijmeni" value="<?php echo $_SESSION["lName"] ?? ''; ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="email">E-mail</label>
                                            <input type="email" id="email" name="email" value="<?php echo $_SESSION["email"] ?? ''; ?>" class="form-control">
                                        </div>
                                    </div>

                                    
                                </form>

                                <!-- Active Section -->
                               
                                <ul class="social-link list-unstyled m-t-40 m-b-10">
                                    <li><a href="#!" class="social-icon facebook" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="mdi mdi-facebook"></i></a></li>
                                    <li><a href="#!" class="social-icon twitter" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="mdi mdi-twitter"></i></a></li>
                                    <li><a href="#!" class="social-icon instagram" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="mdi mdi-instagram"></i></a></li>
                                </ul>
                            </div>

                            <!-- Save Button -->
                            <div class="text-center">
                                <button type="button" class="btn btn-save-changes" onclick="save()" >Uložit změny</button>
                                <button onclick="deleteAcc()" class="delete">Smazat účet</button>
                            </div>
                        </div>
                    </div>
                    <div><div><div id="info" user_right = <?=$_SESSION["role"] ?>></div></div></div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>
<?php require "./frontend/pages/footer.php"; ?>
<script src="./frontend/js/userProfile.js"></script>

