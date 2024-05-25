const forms = document.querySelectorAll("form");
const allInputs = document.querySelectorAll("input");

forms.forEach((form) => {
    form.addEventListener("submit", (e) => {
        e.preventDefault(); // Corrected typo
        validateForm(e);
    });
});

function validateForm(e) {
    let form = e.target;
    let inputs = form.querySelectorAll("input");
    let valid = true;

    if (!validateEmail(inputs[0].value)) { // Corrected email validation regex
        valid = false;
        inputs[0].parentElement.classList.add("error");
    }
    if (!validatePassword(inputs[1].value)) {
        valid = false;
        inputs[1].parentElement.classList.add("error");
    }

    if (form.id === "register" && !inputs[2].checked) { // Corrected checkbox validation
        valid = false;
        inputs[2].parentElement.classList.add("error");
    }
    if (valid) {
        alert("Form submitted");
    }
}

allInputs.forEach((input) => {
    input.addEventListener("input", (e) => {
        e.target.parentElement.classList.remove("error");
    });
});


function validateEmail(email) {
    var re = /^\S+@\S+\.\S+$/; // Corrected regex
    return re.test(email);
}

function validatePassword(password) {
    password = password.trim();
    return password.length >= 8; // Simplified password validation
}

const eyes = document.querySelectorAll(".eye");

eyes.forEach((eye) => {
    eye.addEventListener("click", (e) => {
        let input = e.target.parentElement.querySelector("input")
        if (input.type === "password") {
            input.type = "text";
            e.target.setAttribute("name", "eye-outline")
        } else {
            input.type = "password";
            e.target.setAttribute("name", "eye-off-outline")
        }
    });
});
