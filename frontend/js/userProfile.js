function save() {
    let fName = document.querySelector("#jmeno"),
        sName = document.querySelector("#prijmeni"),
        email = document.querySelector("#email");


        const toast = document.querySelector("#toast"),
        toastBody = document.querySelector(".toast-body");

    if (fName && sName && email) {
        let data = {
            changes: true,
            name: fName.value,
            surname: sName.value,
            email: email.value
        };

        $.ajax({
            url: './backend/codes/profile.php', 
            type: 'POST',  
            data: data, 
            success: function(response) {
                console.log(response);
                // let jsonResponse = JSON.parse(response)
                if (response.includes("Profile updated successfully")) {

                    toast.classList.add("show");
                    toastBody.textContent = "Nové údaje byly úspěšně uloženy.";
                    // alert("done");
                }
                else if (response.includes("User already exists")) {
                    toast.classList.add("show");
                    toastBody.textContent = "Takový uživatel již existuje";
                }
                else{
                    toast.classList.add("show");
                    toastBody.textContent = "Nastala neočekávaná chyba";
                }
                // if(jsonResponse.status === "success") {

                // }
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                alert("An error occurred while saving changes.");
            }
        });

    } else {
        alert("Vyplňte povinné pole !");
    }
}


function deleteAcc() {
    let right = document.querySelector("#info").getAttribute("user_right");
    if(right) {
        let q = "";

        (right == "user") ? q = "Opravdu chcete smazat Váš účet ?" :
        q = "Opravdu chcete smazat Váš admin účet, pokud tak učiníte tak smažete i účty pro ostatní uživatele ?";  
        
        let conf = confirm(q);
        if(!conf) return;
        $.ajax({
            url: './backend/codes/profile.php',
            type: 'POST',
            data: {delete: true,role:right},
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        })
    }
}

