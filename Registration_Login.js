function showRegistration() {
    window.location.href = 'Registration Form.html';
}

function validateForm() {
    let isValid = true;

    // Validate Username
    const username = document.getElementById('username').value.trim();
    const usernameError = document.getElementById('usernameError');
    if (username.length < 4 || username.length > 15) {
        usernameError.textContent = 'Username must be between 4 and 15 characters.';
        isValid = false;
    } else {
        usernameError.textContent = '';
    }

    // Validate Name
    const name = document.getElementById('name').value.trim();
    const nameError = document.getElementById('nameError');
    if (name.length < 4) {
        nameError.textContent = 'Name must be at least 4 characters long.';
        isValid = false;
    } else {
        nameError.textContent = '';
    }

    // Validate Email
    const email = document.getElementById('email').value.trim();
    const emailError = document.getElementById('emailError');
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!emailPattern.test(email)) {
        emailError.textContent = 'Please enter a valid email address.';
        isValid = false;
    } else {
        emailError.textContent = '';
    }

    // Validate Password
    const password = document.getElementById('password').value;
    const passwordError = document.getElementById('passwordError');
    if (password.length < 6 || password.length > 12) {
        passwordError.textContent = 'Password must be between 6 and 12 characters.';
        isValid = false;
    } else {
        passwordError.textContent = '';
    }

    return isValid;
}

function validateRegistrationForm() {
    return validateForm(); // Call the shared validation function
}
