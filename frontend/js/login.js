document.querySelector("form").addEventListener("submit", (e) => {
    e.preventDefault();

    let username = document.querySelector("#username"),
        password = document.querySelector("#password");

    const toast = document.querySelector("#toast"),
        toastBody = document.querySelector(".toast-body");

    if (username.value === "" || password.value === "") {
        toast.classList.add("show");
        toastBody.textContent = "Prosím, vyplňte formulář";
    } else {
        let data = {
            login: true,
            "name": username.value,
            "password": password.value
        };


        $.ajax({
            type: "POST",
            url: "./backend/codes/login.php",
            data: data,
            success: function(response) {
                console.log(response);
                if (response.includes("User found and logged in")) {
                    location.href = "?hlavni-menu"; 
                }
                else if (response.includes("Incorrect password.")) {
                    toast.classList.add("show");
                    toastBody.textContent = "Bylo zadánou špatné heslo"; 
                }
                else {
                    toast.classList.add("show");
                    toastBody.textContent = "Uživatel neexistuje"; 
                }
            },
            error: function(xhr, status, error) {
                // Handle any error
                console.log("Error:", error);
                alert("An error occurred. Please try again.");
            }
        });
    }
});
