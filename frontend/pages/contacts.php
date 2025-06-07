<?php require "./frontend/pages/header.php";?>
<link rel="stylesheet" href="./frontend/styles/pages/contact.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<?php require "./frontend/pages/information.php"; ?>


<section>

<div class="new_home_web">
  <div class="responsive-container-block big-container">
    <img class="imgBG" src="./frontend/images/aw65.png">
    <div class="responsive-container-block textContainer">
      <div class="topHead">
        <p class="text-blk heading">
          Kontaktujte 
          <span class="orangeText">
            nás
          </span>
        </p>
        <div class="orangeLine" id="w-c-s-bgc_p-2-dm-id">
        </div>
      </div>
      
    </div>
    <div class="responsive-container-block container">
      <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-7 wk-ipadp-10 line" id="i69b">
        <form class="form-box">
          <div class="container-block form-wrapper">
            <div class="responsive-container-block">
              <div class="left4">
                <div class="responsive-cell-block wk-ipadp-6 wk-tab-12 wk-mobile-12 wk-desk-6" id="i10mt-2">
                  <input class="input" id="ijowk-2" name="FirstName" placeholder="Jméno" required>
                </div>
                <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                  <input class="input" id="indfi-2" name="Last Name" placeholder="Příjmení" required>
                </div>
                <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                  <input class="input" id="ipmgh-2" name="Email" placeholder="E-mailová adresa" required>
                </div>
              
              </div>
              <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12" id="i634i-2">
                <textarea class="textinput" id="i5vyy-2" placeholder="Zpráva" required></textarea>
              </div>
            </div>
            <a class="send" href="#" id="w-c-s-bgc_p-1-dm-id" onclick="sendAJAX()">
              Odeslat
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</section>


<script>
  onload = function() {
    return;
    $.ajax({
      type: "POST",
      url: "./backend/codes/sendEmail.php",
      data: { send: true },
      success: function(response) {
 

        console.log(response);
      },
      error: function(xhr, status, error) {
        alert("Error sending email: " + error);
      }
    });
  }


  function sendAJAX() {

    const toast = document.querySelector("#toast"),
    toastBody = document.querySelector(".toast-body");

    let fName = document.querySelectorAll("input")[0].value;
    let lName = document.querySelectorAll("input")[1].value;
    let email = document.querySelectorAll("input")[2].value;
    let message = document.querySelector(".textinput").value;
    
    if (fName && lName && email && message) {
        let data = {
            fName: fName,
            lName: lName,
            email: email,
            message: message
        };

        $.ajax({
            type: "POST",
            url: "./backend/codes/sendEmail.php",
            data: JSON.stringify(data), // Send as JSON string
            contentType: "application/json", // Set content type as JSON
            dataType: "json", // Expect JSON response
            success: function(response) {
                if (response.status === 'success') {
                toast.classList.add("show");
                toast.style.zIndex = 1000;

                    toastBody.textContent = "E-mail byl odeslán";

                } else {
                  toast.classList.add("show");
                  toastBody.textContent = "Něco se stalo";
                }
            },
            error: function(xhr, status, error) {
              toast.classList.add("show");
              toastBody.textContent = "Něco se stalo";
            }
        });
    } else {
        alert("Please fill in all fields.");
    }
}

</script>



<?php require "./frontend/pages/footer.php";?>

