
let person = "", type = "";


document.querySelector("#person").addEventListener("change", (e) => {
    person = e.target.value;
});


document.querySelector("#transactionType").addEventListener("change", (e) => {
    type = e.target.value;
});

const toast = document.querySelector("#toast"),
      toastBody = document.querySelector(".toast-body");


function createOperation() {
    // Get the input values from the form
    let date = document.querySelector("#transactionDate").value;
    let amount = document.querySelector("#amount").value;
    let description = document.querySelector("#description").value;




    if (person !== "" && type !== "" && date && amount && description) {


        const transactionData = {
            person: person,
            type: type,
            date: date,
            amount: amount,
            description: description
        };



        $.ajax({
            url: "./backend/codes/operation.php", 
            method: "POST", 
            data: JSON.stringify(transactionData), 
            contentType: "application/json", 
            success: function(response) {
                toast.classList.add("show");
                toastBody.textContent = "Transace proběhla úspěšně"; 
                
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                toast.classList.add("show");
                toastBody.textContent = "Chyba při vytváření transakce. Zkuste to znovu.";
            }
        });
    } else {

        toast.classList.add("show");
        toastBody.textContent = "Prosím vyplňte všechna pole."; 
    }
}

document.querySelector("#transactionForm").addEventListener("submit", (e) => {
    e.preventDefault(); 
    createOperation();  
});
