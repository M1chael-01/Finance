function generatePassword() {
    const length = 6; 
    const charset = "abcdefghijklmnopqrstuvwxyz1234567890s";
    let password = "";
    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * charset.length);
        password += charset[randomIndex];
    }
    document.getElementById("password").value = password;
}

document.getElementById("generatePassword").addEventListener("click", function() {
    generatePassword();
});



