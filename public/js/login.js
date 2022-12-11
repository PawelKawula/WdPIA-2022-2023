const form = document.getElementById("login_form")
const email_input = form.querySelector('input[name="email"]');
const passwd_input = form.querySelector('input[name="passwd"]');
const submit_button = form.querySelector("button");

function is_email(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function mark_validation(element, condition) {
    !condition ? element.classList.add('no_valid') : element.classList.remove('no_valid');
    disabled = email_input.classList.contains("no_valid") || passwd_input.classList.contains("no_valid") ? true : false;
    
    submit_button.disabled = disabled
}

function validate_email() {
    setTimeout(function () {
            mark_validation(email_input, is_email(email_input.value) || email_input.value === "admin");
        },
        1000
    );
}

function validate_password() {
    setTimeout(function () {
            mark_validation(passwd_input, passwd_input.value.length);
        },
        1000
    );
}

email_input.addEventListener('keyup', validate_email);
passwd_input.addEventListener('keyup', validate_password);
