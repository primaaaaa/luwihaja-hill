// Custom Alert Functions
const CustomAlert = {
    // Success Alert
    success: function(message, title = 'Berhasil!') {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'custom-alert custom-alert-success';
        alertDiv.innerHTML = `
            <div class="custom-alert-content">
                <div class="custom-alert-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div class="custom-alert-text">
                    <h3>${title}</h3>
                    <p>${message}</p>
                </div>
                <button class="custom-alert-close" onclick="this.parentElement.parentElement.remove()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;
        document.body.appendChild(alertDiv);
        setTimeout(() => alertDiv.classList.add('show'), 10);
        setTimeout(() => {
            alertDiv.classList.remove('show');
            setTimeout(() => alertDiv.remove(), 300);
        }, 3000);
    },

    // Error Alert
    error: function(message, title = 'Oops!') {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'custom-alert custom-alert-error';
        alertDiv.innerHTML = `
            <div class="custom-alert-content">
                <div class="custom-alert-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <div class="custom-alert-text">
                    <h3>${title}</h3>
                    <p>${message}</p>
                </div>
                <button class="custom-alert-close" onclick="this.parentElement.parentElement.remove()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;
        document.body.appendChild(alertDiv);
        setTimeout(() => alertDiv.classList.add('show'), 10);
        setTimeout(() => {
            alertDiv.classList.remove('show');
            setTimeout(() => alertDiv.remove(), 300);
        }, 3000);
    },

    // Warning Alert
    warning: function(message, title = 'Perhatian!') {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'custom-alert custom-alert-warning';
        alertDiv.innerHTML = `
            <div class="custom-alert-content">
                <div class="custom-alert-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div class="custom-alert-text">
                    <h3>${title}</h3>
                    <p>${message}</p>
                </div>
                <button class="custom-alert-close" onclick="this.parentElement.parentElement.remove()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;
        document.body.appendChild(alertDiv);
        setTimeout(() => alertDiv.classList.add('show'), 10);
        setTimeout(() => {
            alertDiv.classList.remove('show');
            setTimeout(() => alertDiv.remove(), 300);
        }, 3000);
    },

    // Info Alert
    info: function(message, title = 'Informasi') {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'custom-alert custom-alert-info';
        alertDiv.innerHTML = `
            <div class="custom-alert-content">
                <div class="custom-alert-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="custom-alert-text">
                    <h3>${title}</h3>
                    <p>${message}</p>
                </div>
                <button class="custom-alert-close" onclick="this.parentElement.parentElement.remove()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;
        document.body.appendChild(alertDiv);
        setTimeout(() => alertDiv.classList.add('show'), 10);
        setTimeout(() => {
            alertDiv.classList.remove('show');
            setTimeout(() => alertDiv.remove(), 300);
        }, 3000);
    }
};

window.showAlert = CustomAlert;