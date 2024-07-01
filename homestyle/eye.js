const eyes = document.querySelectorAll(".eye");

eyes.forEach((eye) => {
<<<<<<< HEAD
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
=======
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
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
});


document.addEventListener('DOMContentLoaded', function() {
<<<<<<< HEAD
    const coverImage = document.getElementById('cover-img');
    const checkboxCover = document.getElementById('checkbox-cover');

    if (coverImage && checkboxCover) {
        coverImage.addEventListener('click', function() {
            checkboxCover.checked = !checkboxCover.checked;
        });
    }
=======
const coverImage = document.getElementById('cover-img');
const checkboxCover = document.getElementById('checkbox-cover');

if (coverImage && checkboxCover) {
    coverImage.addEventListener('click', function() {
        checkboxCover.checked = !checkboxCover.checked;
    });
}
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
});