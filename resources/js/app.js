// Import bootstrap
import './bootstrap';

// Kode untuk menangani alert
document.addEventListener('DOMContentLoaded', function() {
    // Efek fade untuk alert
    const alerts = document.querySelectorAll('.alert');
    if (alerts.length > 0) {
        alerts.forEach(alert => {
            setTimeout(() => {
                if (alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        });
    }
    
    // Menambahkan class active pada menu yang aktif
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href && currentPath.includes(href)) {
            link.classList.add('active', 'fw-bold');
        }
    });
});

// Validasi form sederhana
const validationForms = document.querySelectorAll('.needs-validation');
if (validationForms.length > 0) {
    Array.from(validationForms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
}