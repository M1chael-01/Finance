document.querySelector("#userForm").addEventListener("submit", function(e) {
    e.preventDefault(); 
    const firstName = document.querySelector("#firstName").value;
    const lastName = document.querySelector("#lastName").value;
    const email = document.querySelector("#email").value;
    const password = document.querySelector("#password").value;

    if (firstName && lastName && email && password) {
        const data = {
            add: true,
            firstName: firstName,
            lastName: lastName,
            email: email,
            password: password,
            role: "user"
        };
        const toast = document.querySelector("#toast"),
        toastBody = document.querySelector(".toast-body");

        $.ajax({
            type: "POST",
            url: "./backend/codes/addUser.php",  
            data: data,
            success: function(response) {
                console.log(response);
                if (response.includes("User added successfully.")) {
                    toast.classList.add("show");
                    toastBody.textContent = "Uživatel byl přidán";
                }
                else if (response.includes("User already exists.")) {
                    toast.classList.add("show"); 
                    toastBody.textContent = "Takový uživatel již existuje";  
                }
                else {
                    alert("Něco se stalo, opakujte akci");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", error); 
                alert("An error occurred. Please try again.");
            }
        });
    } else {
        alert("Please fill in all the fields.");
    }
});
