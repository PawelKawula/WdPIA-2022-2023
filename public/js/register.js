const form = document.getElementById("register_form")
const email_input = form.querySelector('input[name="email"]');
const passwd_input = form.querySelector('input[name="passwd"]');
const c_passwd_input = form.querySelector('input[name="c_passwd"]');
const submit_button = form.querySelector("button");

function is_email(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function is_same(passwd, c_passwd) {
    return passwd === c_passwd;
}

function mark_validation(element, condition) {
    !condition ? element.classList.add('no_valid') : element.classList.remove('no_valid');
    let disabled = email_input.classList.contains("no_valid") || c_passwd_input.classList.contains("no_valid") ? true : false;
    
    submit_button.disabled = disabled
}

function validate_email() {
    setTimeout(function () {
            mark_validation(email_input, is_email(email_input.value));
        },
        1000
    );
}

function validate_password() {
    setTimeout(function () {
            const condition = is_same(
                passwd_input.value,
                c_passwd_input.value
            );
            mark_validation(c_passwd_input, condition);
        },
        1000
    );
}

email_input.addEventListener('keyup', validate_email);
c_passwd_input.addEventListener('keyup', validate_password);
