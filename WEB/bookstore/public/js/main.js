document.addEventListener('DOMContentLoaded', function () {
    // 1. Auto dismiss alerts after 4s
    const alerts = document.querySelectorAll('.alert');
    if (alerts.length) {
        setTimeout(() => {
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-6px)';
                setTimeout(() => alert.remove(), 250);
            });
        }, 4000);
    }

    // 2. Header shadow on scroll
    const header = document.querySelector('.site-header');
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                header.style.boxShadow = '0 4px 20px -2px rgba(24, 24, 27, 0.08)';
            } else {
                header.style.boxShadow = 'var(--shadow-sm)';
            }
        }, { passive: true });
    }
});

// Confirmation helper for delete actions
function confirmDelete(url, message) {
    const msg = message || 'Bạn có chắc chắn muốn xóa mục này khỏi giỏ hàng / danh sách không?';
    if (window.confirm(msg)) {
        window.location.href = url;
    }
}

function scrollToTopSmooth() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
