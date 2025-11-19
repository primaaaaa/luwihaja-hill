document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('loginForm');
    if (!form) return;

    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const emailWrapper = document.getElementById('emailWrapper');
    const passwordWrapper = document.getElementById('passwordWrapper');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        let isValid = true;

        // reset
        [emailWrapper, passwordWrapper].forEach(w => w.classList.remove('error'));
        [emailError, passwordError].forEach(el => el.classList.remove('show'));

        if (!email.value.trim()) {
            emailWrapper.classList.add('error');
            emailError.classList.add('show');
            isValid = false;
        }

        if (!password.value.trim()) {
            passwordWrapper.classList.add('error');
            passwordError.classList.add('show');
            isValid = false;
        }

        if (isValid) {
            alert('Login berhasil!');
            form.submit();
        }
    });

    email.addEventListener('input', () => {
        if (email.value.trim()) {
            emailWrapper.classList.remove('error');
            emailError.classList.remove('show');
        }
    });

    password.addEventListener('input', () => {
        if (password.value.trim()) {
            passwordWrapper.classList.remove('error');
            passwordError.classList.remove('show');
        }
    });
});
