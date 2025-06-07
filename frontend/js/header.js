function logout() {
    $.ajax({
        type: "POST",
        url: "./backend/codes/logout.php",
        data: {logout: true},
        success: function(data) {
                location.href = "?uvod";
        },
        error: function(xhr, status, error) {
            console.error(xhr, status, error);
        }
    })
}

let activeID = document.querySelector("header").getAttribute("activeID") || -1;

if (activeID != -1) {
if (activeID <= 2 && activeID >= 0) {
document.querySelectorAll("header nav ul li a")[activeID].classList.add("active");
}
else{
if(activeID >=3 && activeID <6) {
    document.querySelectorAll(".header-buttons a")[activeID-3].classList.add("active");
}

}
}