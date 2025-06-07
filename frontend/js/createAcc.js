document.querySelector("#myform").addEventListener("submit", (e) => {
    e.preventDefault();  

    let firstName = document.querySelector("#first_name"),
        lastName = document.querySelector("#last_name"),
        date = document.querySelector("#date"),
        email = document.querySelector("#email"),
        password = document.querySelector("#password");

    const toast = document.querySelector("#toast"),
        toastBody = document.querySelector(".toast-body");

    if (firstName && lastName && date && email && password) {

        let birthDate = new Date(date.value);
        let today = new Date();
        
        if (birthDate > today) {
            toast.classList.add("show");
            toastBody.textContent = "Datum narození nesmí být větší než aktuální datum.";
            return;
        }

        let age = today.getFullYear() - birthDate.getFullYear();
        let month = today.getMonth() - birthDate.getMonth();
        
        // Adjust age if the birthday hasn't occurred yet this year
        if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }


        if (age < 18) {
            toast.classList.add("show");
            toastBody.textContent = "Musíte mít alespoň 18 let k registraci.";
            return;
        }

    

        let data = {
            createAcc: true,
            first_name: firstName.value,
            last_name: lastName.value,
            date_of_birth: date.value,
            email: email.value,
            password: password.value,
        };


        $.ajax({
            type: "POST",
            url: "./backend/codes/createUser.php", 
            data: data,
            success: function(response) {
                let jsonResponse = (response); 
                console.log(jsonResponse);
          

                if (jsonResponse.status === "error") {
                    alert(jsonResponse.message); 
                } else {
                    if (response.includes("names")) {
                        toast.classList.add("show");
                        toastBody.textContent = "Uživatel existuje se jménem nebo příjmením";
                    } else if (response.includes("email")) {
                        toast.classList.add("show");
                        toastBody.textContent = "Uživatel s takovým email existuje";
                    } else if (response.includes("User already exists.")) {
                        toast.classList.add("show");
                        toastBody.textContent = "Uživatel již existuje";
                    } else {
                        toast.classList.add("show");
                        toastBody.textContent = "Váš účet byl úspěšně registrován";
                        location.href = "?prihlaseni-do-aplikace";  
                    }
                }
            },
            error: function(xhr, status, error) {
                console.log("Error:", error);
                alert("Došlo k chybě při odesílání požadavku. Zkuste to znovu.");
            }
        });
    } else {
        toast.classList.add("show");
        toastBody.textContent = "Prosím, vyplňte všechna pole.";
    }
});
