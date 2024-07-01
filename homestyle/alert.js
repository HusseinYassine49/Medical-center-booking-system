<<<<<<< HEAD
=======

>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
let isEmailValid = false;
let isPasswordValid = false;
let isRegisterEmailValid = false;
let isRegisterPasswordValid = false;
let isRegisterFnameValid = false;
let isRegisterLnameValid = false;
let isRegisterConfirmValid = false;
let dobValid = false;

/* HERE THE CODE FOR THE LOGIN FORM VALIDATION */
document.addEventListener('DOMContentLoaded', function() {
<<<<<<< HEAD
    let email = document.getElementById('login-email');
    let password = document.getElementById('login-password');
    let button = document.getElementById('Login-Button');

    email.addEventListener('blur', function() {
        em = email.value;
=======
    let email =document.getElementById('login-email');
    let password =document.getElementById('login-password');
    let button =  document.getElementById('Login-Button');
    
    email.addEventListener('blur', function() {
        em = email.value; 
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
        if (!validateEmail(em)) {
            valid = false;
            email.parentElement.classList.add("error");
            isEmailValid = false;
<<<<<<< HEAD
        } else {
=======
        }else{
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
            email.parentElement.classList.remove("error");
            isEmailValid = true;
        }
        updateLoginButton();
    });

    password.addEventListener('blur', function() {
<<<<<<< HEAD
        pass = password.value;
=======
        pass =password.value;
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
        if (!validatePassword(pass)) {
            valid = false;
            password.parentElement.classList.add("error");
            isPasswordValid = false;
<<<<<<< HEAD
        } else {
=======
        }else{
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
            password.parentElement.classList.remove("error");
            isPasswordValid = true;
        }
        updateLoginButton();
    });

    function updateLoginButton() {
        if (isEmailValid && isPasswordValid) {
            button.disabled = false;
        } else {
            button.disabled = true;
        }
    }
});



/* HERE THE CODE FOR THE REIGSTER FORM VALIDATION */
document.addEventListener('DOMContentLoaded', function() {
    let fname = document.getElementById('Register-Fname');
    let lname = document.getElementById('Register-Lname');
    let email = document.getElementById('Register-Email');
    let password = document.getElementById('Register-Password');
    let confirm = document.getElementById('Confirm-Password');
    let button = document.getElementById('Register-Button');
    let dob = document.getElementById('dob');
<<<<<<< HEAD


    email.addEventListener('blur', function() {
        let em = email.value;
=======
    
    
    email.addEventListener('blur', function() {
        let em = email.value; 
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
        if (!validateEmail(em)) {
            email.parentElement.classList.add("error");
            isRegisterEmailValid = false;
        } else {
            email.parentElement.classList.remove("error");
            isRegisterEmailValid = true;
        }
        updateButtonState();
    });

    password.addEventListener('blur', function() {
        let pass = password.value;
        if (!validatePassword(pass)) {
            password.parentElement.classList.add("error");
            isRegisterPasswordValid = false;
        } else {
            password.parentElement.classList.remove("error");
            isRegisterPasswordValid = true;
        }
        updateButtonState();
    });

    fname.addEventListener('blur', function() {
        let fn = fname.value;
        if (!Info(fn)) {
            fname.parentElement.classList.add("error");
            isRegisterFnameValid = false;
        } else {
            fname.parentElement.classList.remove("error");
            isRegisterFnameValid = true;
        }
        updateButtonState();
    });

    lname.addEventListener('blur', function() {
        let ln = lname.value;
        if (!Info(ln)) {
            lname.parentElement.classList.add("error");
            isRegisterLnameValid = false;
        } else {
            lname.parentElement.classList.remove("error");
            isRegisterLnameValid = true;
        }
        updateButtonState();
    });

    confirm.addEventListener('blur', function() {
        let passwo = password.value;
        let confirmPass = confirm.value;
<<<<<<< HEAD

=======
        
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
        if (passwo !== confirmPass) {
            confirm.parentElement.classList.add("error");
            isRegisterConfirmValid = false;
        } else {
            confirm.parentElement.classList.remove("error");
            isRegisterConfirmValid = true;
        }
<<<<<<< HEAD

=======
        
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
        updateButtonState()
    });

    dob.addEventListener('blur', function() {
        let datetimeValue = dob.value;
        if (datetimeValue.trim() === '') {
            dob.parentElement.classList.add("error");
            dobValid = false;
        } else {
            dob.parentElement.classList.remove("error");
            dobValid = true;
        }
        updateButtonState()
    });


    function updateButtonState() {
        if (isRegisterEmailValid && isRegisterPasswordValid && isRegisterFnameValid && isRegisterLnameValid && isRegisterConfirmValid && dobValid) {
            button.disabled = false;
        } else {
            button.disabled = true;
        }
    }
});



function validateEmail(email) {
    var re = /^\S+@\S+\.\S+$/;
    return re.test(email);
}

function validatePassword(password) {
    password = password.trim();
    const hasNumber = /\d/;
    const hasAlphabet = /[a-zA-Z]/;
    return (password.length >= 6 && hasNumber.test(password) && hasAlphabet.test(password));

}

function Info(name) {
    name = name.trim();
<<<<<<< HEAD
    return name.length >= 1;
=======
    return name.length >= 1; 
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
}






/* HERE THE CODE FOR THE REIGSTER FORM VALIDATION */
document.addEventListener('DOMContentLoaded', function() {
    let doctorfname = document.getElementById('doctor-Fname');
    let doctorlname = document.getElementById('doctor-Lname');
    let doctoremail = document.getElementById('doctor-email');
    let doctorpassword = document.getElementById('doctor-password');
    let doctorconfirm = document.getElementById('doctor-confirm-password');
    let doctorbutton = document.getElementById('doctor-reg');
    let doctordob = document.getElementById('doctor-dob');
<<<<<<< HEAD


    doctoremail.addEventListener('blur', function() {
        let dem = doctoremail.value;
=======
    
    
    doctoremail.addEventListener('blur', function() {
        let dem = doctoremail.value; 
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
        if (!validateEmail(dem)) {
            doctoremail.parentElement.classList.add("error");
            isRegisterEmailValid = false;
        } else {
            doctoremail.parentElement.classList.remove("error");
            isRegisterEmailValid = true;
        }
        updateButtonState();
    });

    doctorpassword.addEventListener('blur', function() {
        let dpass = doctorpassword.value;
        if (!validatePassword(dpass)) {
            doctorpassword.parentElement.classList.add("error");
            isRegisterPasswordValid = false;
        } else {
            doctorpassword.parentElement.classList.remove("error");
            isRegisterPasswordValid = true;
        }
        updateButtonState();
    });

    doctorfname.addEventListener('blur', function() {
        let dfn = doctorfname.value;
        if (!Info(dfn)) {
            doctorfname.parentElement.classList.add("error");
            isRegisterFnameValid = false;
        } else {
            doctorfname.parentElement.classList.remove("error");
            isRegisterFnameValid = true;
        }
        updateButtonState();
    });

    doctorlname.addEventListener('blur', function() {
        let dln = doctorlname.value;
        if (!Info(dln)) {
            doctorlname.parentElement.classList.add("error");
            isRegisterLnameValid = false;
<<<<<<< HEAD
        } else {
=======
        } else { 
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
            doctorlname.parentElement.classList.remove("error");
            isRegisterLnameValid = true;
        }
        updateButtonState();
    });

    doctorconfirm.addEventListener('blur', function() {
        let passwo = doctorpassword.value;
        let confirmPass = doctorconfirm.value;
<<<<<<< HEAD

=======
        
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
        if (passwo !== confirmPass) {
            doctorconfirm.parentElement.classList.add("error");
            isRegisterConfirmValid = false;
        } else {
            doctorconfirm.parentElement.classList.remove("error");
            isRegisterConfirmValid = true;
        }
<<<<<<< HEAD

=======
        
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
        updateButtonState()
    });

    doctordob.addEventListener('blur', function() {
        let datetimeValue = doctordob.value;
        if (datetimeValue.trim() === '') {
            doctordob.parentElement.classList.add("error");
            dobValid = false;
        } else {
            doctordob.parentElement.classList.remove("error");
            dobValid = true;
        }
        updateButtonState()
    });


    function updateButtonState() {
        if (isRegisterEmailValid && isRegisterPasswordValid && isRegisterFnameValid && isRegisterLnameValid && isRegisterConfirmValid && dobValid) {
            doctorbutton.disabled = false;
        } else {
            doctorbutton.disabled = true;
        }
    }
<<<<<<< HEAD
});
=======
});


>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
