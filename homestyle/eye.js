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


document.addEventListener('DOMContentLoaded', function() {
const coverImage = document.getElementById('cover-img');
const checkboxCover = document.getElementById('checkbox-cover');

if (coverImage && checkboxCover) {
    coverImage.addEventListener('click', function() {
        checkboxCover.checked = !checkboxCover.checked;
    });
}
});