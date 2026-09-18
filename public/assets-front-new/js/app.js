
(() => {
    const menuToggle = document.getElementById('menuToggle');
    const mobilePanel = document.getElementById('mobilePanel');
    const mobileLinks = mobilePanel ? mobilePanel.querySelectorAll('a') : [];

    if (menuToggle && mobilePanel) {
        menuToggle.addEventListener('click', () => {
            const open = mobilePanel.classList.toggle('open');
            document.body.classList.toggle('menu-open', open);
            menuToggle.textContent = open ? '✕' : '☰';
            menuToggle.setAttribute('aria-expanded', String(open));
        });
        mobileLinks.forEach(link => link.addEventListener('click', () => {
            mobilePanel.classList.remove('open');
            document.body.classList.remove('menu-open');
            menuToggle.textContent = '☰';
            menuToggle.setAttribute('aria-expanded', 'false');
        }));
    }

    const page = document.body.dataset.page;
    document.querySelectorAll('[data-nav]').forEach(link => {
        link.classList.toggle('active', link.dataset.nav === page);
    });

    const weatherDate = document.getElementById('weatherDate');
    if (weatherDate) {
        weatherDate.textContent = new Intl.DateTimeFormat('id-ID', {
            weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
        }).format(new Date());
    }

    const realtimeDay = document.getElementById('realtime-day');
    if (realtimeDay) {
        const updateClock = () => {
            const now = new Date();
            const set = (id, value) => {
                const el = document.getElementById(id);
                if (el) el.textContent = value;
            };
            set('realtime-day', now.toLocaleDateString('id-ID', { weekday: 'long' }));
            set('realtime-date', now.toLocaleDateString('id-ID', { day:'numeric', month:'long', year:'numeric' }));
            set('realtime-time', now.toLocaleTimeString('id-ID', { hour:'2-digit', minute:'2-digit', second:'2-digit', hour12:false }) + ' WIB');
            set('realtime-zone', 'Kabupaten Bogor');
        };
        updateClock();
        window.setInterval(updateClock, 1000);
    }
})();

function showToast(message) {
    const toast = document.getElementById('toast');
    if (!toast) return;
    toast.textContent = message;
    toast.classList.add('show');
    clearTimeout(window.__toastTimer);
    window.__toastTimer = setTimeout(() => toast.classList.remove('show'), 2800);
}

function buy(product) {
    showToast(product + ' ditambahkan ke keranjang.');
}

function handleSearch(event) {
    event.preventDefault();
    const input = event.currentTarget.querySelector('input');
    const query = input ? input.value.trim() : '';
    showToast(query ? 'Pencarian: “' + query + '”' : 'Masukkan kata kunci pencarian.');
}

