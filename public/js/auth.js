// Fungsi untuk menampilkan alert
function showAlert(message, type = 'success') {
    // Hapus alert yang sudah ada
    const existingAlert = document.querySelector('.alert');
    if (existingAlert) {
        existingAlert.remove();
    }

    // Buat alert baru
    const alert = document.createElement('div');
    alert.className = `alert alert-${type}`;
    alert.textContent = message;

    // Masukkan setelah form
    const form = document.getElementById('loginForm') || document.getElementById('registerForm');
    if (form) {
        form.parentNode.insertBefore(alert, form.nextSibling);
        
        // Auto hide setelah 5 detik
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // ============= LOGIN FORM =============
    const loginForm = document.getElementById('loginForm');

    if (loginForm) {
        loginForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            clearErrors();

            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const loginBtn = document.getElementById('loginBtn');

            // Validasi
            let hasError = false;

            if (!email) {
                showError('email', 'Email harus diisi');
                hasError = true;
            } else if (!isValidEmail(email)) {
                showError('email', 'Format email tidak valid');
                hasError = true;
            }

            if (!password) {
                showError('password', 'Password harus diisi');
                hasError = true;
            }

            if (hasError) return;

            // Disable button
            loginBtn.disabled = true;
            loginBtn.textContent = 'Loading...';

            try {
                const csrfToken =
                    document.querySelector('meta[name="csrf-token"]')?.content ||
                    document.querySelector('input[name="_token"]')?.value;

                const response = await fetch('/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ email, password }),
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    // Tampilkan alert sukses
                    showAlert('Login berhasil!', 'success');
                    
                    // Redirect setelah 1.5 detik
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1500);
                } else {
                    if (data.errors) {
                        Object.keys(data.errors).forEach((key) => {
                            showError(key, data.errors[key][0]);
                        });
                    } else if (data.message) {
                        // Tampilkan alert error
                        showAlert(data.message, 'error');
                    }

                    loginBtn.disabled = false;
                    loginBtn.textContent = 'Login';
                }
            } catch (error) {
                console.error('Error:', error);
                showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
                loginBtn.disabled = false;
                loginBtn.textContent = 'Login';
            }
        });
    }

    const registerForm = document.getElementById('registerForm');

    if (registerForm) {
        registerForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            clearErrors();

            const nama = document.getElementById('nama').value.trim();
            const noTelepon = document.getElementById('noTelepon').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const password_confirmation = document.getElementById('password_confirmation').value;
            const registerBtn = document.getElementById('registerBtn');

            // Validasi client-side
            let hasError = false;

            if (!nama) {
                showError('nama', 'Nama harus diisi');
                hasError = true;
            }

            if (!noTelepon) {
                showError('noTelepon', 'No. Telepon harus diisi');
                hasError = true;
            }

            if (!email) {
                showError('email', 'Email harus diisi');
                hasError = true;
            } else if (!isValidEmail(email)) {
                showError('email', 'Format email tidak valid');
                hasError = true;
            }

            if (!password) {
                showError('password', 'Password harus diisi');
                hasError = true;
            } else if (password.length < 6) {
                showError('password', 'Password minimal 6 karakter');
                hasError = true;
            }

            if (!password_confirmation) {
                showError('password_confirmation', 'Konfirmasi password harus diisi');
                hasError = true;
            } else if (password !== password_confirmation) {
                showError('password_confirmation', 'Konfirmasi password tidak cocok');
                hasError = true;
            }

            if (hasError) return;

            // Disable button
            registerBtn.disabled = true;
            registerBtn.textContent = 'Loading...';

            try {
                const csrfToken =
                    document.querySelector('meta[name="csrf-token"]')?.content ||
                    document.querySelector('input[name="_token"]')?.value;

                const response = await fetch('/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        nama,
                        noTelepon,
                        email,
                        password,
                        password_confirmation,
                    }),
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showAlert('Registrasi berhasil!', 'success');
                    
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1500);
                } else {
                    if (data.errors) {
                        Object.keys(data.errors).forEach((key) => {
                            showError(key, data.errors[key][0]);
                        });
                    } else if (data.message) {
                        // Tampilkan alert error
                        showAlert(data.message, 'error');
                    }

                    registerBtn.disabled = false;
                    registerBtn.textContent = 'Register';
                }
            } catch (error) {
                console.error('Error:', error);
                showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
                registerBtn.disabled = false;
                registerBtn.textContent = 'Register';
            }
        });

        // Real-time validation untuk konfirmasi password
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');

        if (confirmPasswordInput) {
            confirmPasswordInput.addEventListener('input', function () {
                if (this.value && passwordInput.value !== this.value) {
                    showError('password_confirmation', 'Konfirmasi password tidak cocok');
                } else {
                    clearError('password_confirmation');
                }
            });
        }
    }

    // Real-time validation untuk email
    const emailInput = document.getElementById('email');
    if (emailInput) {
        emailInput.addEventListener('blur', function () {
            const email = this.value.trim();
            if (email && !isValidEmail(email)) {
                showError('email', 'Format email tidak valid');
            }
        });

        emailInput.addEventListener('input', function () {
            clearError('email');
        });
    }
});

// Helper functions
function showError(fieldName, message) {
    const wrapper = document.getElementById(fieldName + 'Wrapper');
    const errorDiv = document.getElementById(fieldName + 'Error');

    if (wrapper) wrapper.classList.add('error');
    if (errorDiv) {
        errorDiv.textContent = message;
        errorDiv.style.display = 'block';
    }
}

function clearError(fieldName) {
    const wrapper = document.getElementById(fieldName + 'Wrapper');
    const errorDiv = document.getElementById(fieldName + 'Error');

    if (wrapper) wrapper.classList.remove('error');
    if (errorDiv) errorDiv.style.display = 'none';
}

function clearErrors() {
    document.querySelectorAll('.input-wrapper').forEach((wrapper) => {
        wrapper.classList.remove('error');
    });
    document.querySelectorAll('.error-message').forEach((error) => {
        error.style.display = 'none';
    });
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}