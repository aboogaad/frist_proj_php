
function validateUsername() {
    var usernameInput = document.getElementById('username');
    var usernameValid = document.getElementById('usernameValid');
    var username = usernameInput.value.trim();

    if (username === '') {
        usernameValid.textContent = ''; // Clear validation message if username is empty
    } else {
        usernameValid.textContent = '✔️ Username is valid'; // Display validation message
    }
}

function validateEmail() {
    var emailInput = document.getElementById('email');
    var emailValid = document.getElementById('emailValid');
    var email = emailInput.value.trim();

    if (email.includes('@')) {
        emailValid.textContent = '✔️ Email is valid';
        emailValid.classList.remove('invalid-feedback');
        emailValid.classList.add('valid-feedback');
    } else {
        emailValid.textContent = '❌ Email must contain @ sign';
        emailValid.classList.remove('valid-feedback');
        emailValid.classList.add('invalid-feedback');
    }
}

function validatePassword() {
    var passwordInput = document.getElementById('password');
    var passwordValid = document.getElementById('passwordValid');
    var password = passwordInput.value.trim();

    if (password.length >= 6 && password.length <= 12) {
        passwordValid.textContent = '✔️ Password is valid';
        passwordValid.classList.remove('invalid-feedback');
        passwordValid.classList.add('valid-feedback');
    } else {
        passwordValid.textContent = '❌ Password must be between 6 and 12 characters';
        passwordValid.classList.remove('valid-feedback');
        passwordValid.classList.add('invalid-feedback');
    }
}

function validateConfirmPassword() {
    var passwordInput = document.getElementById('password');
    var confPasswordInput = document.getElementById('confpassword');
    var confPasswordValid = document.getElementById('confpasswordValid');
    var password = passwordInput.value.trim();
    var confPassword = confPasswordInput.value.trim();

    if (password === confPassword) {
        confPasswordValid.textContent = '✔️ Passwords match';
        confPasswordValid.classList.remove('invalid-feedback');
        confPasswordValid.classList.add('valid-feedback');
    } else {
        confPasswordValid.textContent = '❌ Passwords do not match';
        confPasswordValid.classList.remove('valid-feedback');
        confPasswordValid.classList.add('invalid-feedback');
    }
}
function saveData(){
    let username = document.getElementById("username").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let role = "user"
    let confPassword = document.getElementById('confpassword').value;

    let user_recoerds =new Array();
    user_recoerds = JSON.parse(localStorage.getItem("users"))?JSON.parse(localStorage.getItem("users")):[]
    if (username.trim() === '' || email.trim() === '' || password.trim() === '' || confPassword.trim() === '') {
        alert('Please fill in all fields.');
        return;
    }

    if (!email.includes('@')) {
        alert('Please enter a valid email address.');
        return;
    }

    if (password.length < 6 || password.length > 12) {
        alert('Password must be between 6 and 12 characters.');
        return;
    }

    if (password !== confPassword) {
        alert('Passwords do not match.');
        return;
    }
    if(user_recoerds.some((v)=>{
        return v.email == email
    })){
        alert("Duuplicate Data");
    }
    else{
        user_recoerds.push({
            "username":username,
            "email":email,
            "password":password,
            "role":role
        })
        localStorage.setItem("users",JSON.stringify(user_recoerds));
        window.location.href = "../html/login.html";
    }
}