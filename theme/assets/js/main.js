/**
 * Demo Theme Builder - Main JavaScript
 */

// Mobile Menu Toggle
function dtbToggleMenu() {
    const drawer = document.getElementById('mobileDrawer');
    const overlay = document.getElementById('drawerOverlay');
    const sideMenu = document.getElementById('sideMenu');
    const menuOverlay = document.getElementById('menuOverlay');

    // For mobile drawer
    if (drawer) {
        drawer.classList.toggle('active');
        overlay.classList.toggle('active');
        document.body.style.overflow = drawer.classList.contains('active') ? 'hidden' : '';
    }

    // For side menu (header-3)
    if (sideMenu) {
        sideMenu.classList.toggle('active');
        menuOverlay.classList.toggle('active');
        document.body.style.overflow = sideMenu.classList.contains('active') ? 'hidden' : '';
    }
}

// Theme Selector Toggle
function dtbToggleSelector() {
    const panel = document.getElementById('themeSelectorPanel');
    if (panel) {
        panel.classList.toggle('active');
    }
}

// Style Option Selection
document.addEventListener('DOMContentLoaded', function() {
    const styleOptions = document.querySelectorAll('.style-option input');

    styleOptions.forEach(function(input) {
        input.addEventListener('change', function() {
            const parent = this.closest('.style-options');
            const allOptions = parent.querySelectorAll('.style-option');

            allOptions.forEach(function(opt) {
                opt.classList.remove('active');
            });

            this.closest('.style-option').classList.add('active');
        });
    });
});

// Save Theme Settings
function dtbSaveTheme() {
    const settings = {};
    const components = ['header', 'hero', 'posts', 'footer'];

    components.forEach(function(component) {
        const selected = document.querySelector('input[name="' + component + '"]:checked');
        if (selected) {
            settings[component] = selected.value;
        }
    });

    // Send AJAX request
    const formData = new FormData();
    formData.append('action', 'dtb_save_settings');
    formData.append('nonce', dtbSettings.nonce);

    for (const key in settings) {
        formData.append(key, settings[key]);
    }

    fetch(dtbSettings.ajaxUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Ayarlar kaydedildi! Sayfa yenileniyor...', 'success');
            setTimeout(function() {
                window.location.reload();
            }, 1000);
        } else {
            showNotification('Hata: ' + data.data, 'error');
        }
    })
    .catch(error => {
        showNotification('Bir hata oluştu!', 'error');
        console.error('Error:', error);
    });
}

// Preview Theme (reload with query params)
function dtbPreviewTheme() {
    const settings = {};
    const components = ['header', 'hero', 'posts', 'footer'];

    components.forEach(function(component) {
        const selected = document.querySelector('input[name="' + component + '"]:checked');
        if (selected) {
            settings[component] = selected.value;
        }
    });

    // Build URL with preview params
    const url = new URL(window.location.href);
    for (const key in settings) {
        url.searchParams.set('preview_' + key, settings[key]);
    }

    window.location.href = url.toString();
}

// Show Notification
function showNotification(message, type) {
    // Remove existing notification
    const existing = document.querySelector('.dtb-notification');
    if (existing) {
        existing.remove();
    }

    // Create notification
    const notification = document.createElement('div');
    notification.className = 'dtb-notification ' + type;
    notification.innerHTML = message;

    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 15px 30px;
        background: ${type === 'success' ? '#22c55e' : '#ef4444'};
        color: white;
        border-radius: 8px;
        font: 500 .9rem/1 system-ui;
        z-index: 9999;
        box-shadow: 0 4px 20px rgba(0,0,0,.2);
        animation: slideDown 0.3s ease;
    `;

    document.body.appendChild(notification);

    // Auto remove after 3 seconds
    setTimeout(function() {
        notification.remove();
    }, 3000);
}

// Add animation keyframes
const style = document.createElement('style');
style.textContent = `
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateX(-50%) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
    }
`;
document.head.appendChild(style);

// Close panels on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const drawer = document.getElementById('mobileDrawer');
        const panel = document.getElementById('themeSelectorPanel');
        const sideMenu = document.getElementById('sideMenu');

        if (drawer && drawer.classList.contains('active')) {
            dtbToggleMenu();
        }
        if (panel && panel.classList.contains('active')) {
            dtbToggleSelector();
        }
        if (sideMenu && sideMenu.classList.contains('active')) {
            dtbToggleMenu();
        }
    }
});
