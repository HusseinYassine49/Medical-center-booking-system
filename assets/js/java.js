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

    if (!Info(inputs[0].value)) { 
        valid = false;
        inputs[0].parentElement.classList.add("error");
    }
    if (!Info(inputs[1].value)) {
        valid = false;
        inputs[1].parentElement.classList.add("error");
    }
    if (!Info(inputs[2].value)) { 
        valid = false;
        inputs[2].parentElement.classList.add("error");
    }
    if (!validateEmail(inputs[3].value)) {
        valid = false;
        inputs[3].parentElement.classList.add("error");
    }
    if (!validatePassword(inputs[4].value)) {
        valid = false;
        inputs[4].parentElement.classList.add("error");
    }
    if (!validatePassword(inputs[5].value)) {
        valid = false;
        inputs[5].parentElement.classList.add("error");
    }
    if (form.id === "register" && !inputs[6].checked) { // Corrected checkbox validation
        valid = false;
        inputs[6].parentElement.classList.add("error");
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

function Info(password) {
    password = password.trim();
    return password.length >= 1; // Simplified Naming validation
}

function mobile(phoneNumber) {
    var re = /^\d{2}\s\d{3}\s\d{3}$/;
    return re.test(phoneNumber);
}

// JavaScript to toggle checkbox state when cover image is clicked
document.addEventListener('DOMContentLoaded', function() {
    const coverImage = document.getElementById('cover-img');
    const checkboxCover = document.getElementById('checkbox-cover');

    if (coverImage && checkboxCover) {
        coverImage.addEventListener('click', function() {
            checkboxCover.checked = !checkboxCover.checked;
        });
    }
});


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