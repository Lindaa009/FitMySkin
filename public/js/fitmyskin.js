(() => {
    const PRODUCT_KEY = 'fitmyskin.products.v1';
    const JOURNAL_KEY = 'fitmyskin.journals.v1';
    const categories = {
        cleanser: 'Pembersih',
        toner: 'Toner',
        serum: 'Serum',
        moisturizer: 'Pelembap',
        sunscreen: 'Sunscreen',
        exfoliator: 'Eksfoliasi',
    };
    const routineLabels = {
        both: 'Pagi & malam',
        morning: 'Pagi',
        evening: 'Malam',
    };
    const starterProducts = [
        { id: 'starter-cleanser', name: 'Niacinamide Serum Facial Wash', brand: 'Skincare routine', category: 'cleanser', ingredient: 'Niacinamide', routine: 'both', status: 'active' },
        { id: 'starter-toner', name: 'Toner Brightly Essence', brand: 'Skincare routine', category: 'toner', ingredient: 'Brightening essence', routine: 'both', status: 'active' },
        { id: 'starter-serum', name: 'Scarlett Brightly Ever After Serum', brand: 'Scarlett', category: 'serum', ingredient: 'Brightening serum', routine: 'evening', status: 'active' },
        { id: 'starter-exfoliator', name: 'Glycolic Acid Exfoliating Brightening', brand: 'SKINTIFIC', category: 'exfoliator', ingredient: '10% AHA · 1% BHA · 0.5% PHA', routine: 'evening', status: 'paused' },
    ];

    const toast = document.querySelector('#app-toast');
    let toastTimer;
    let storageAvailable = true;

    async function apiCall(url, method, data = null) {
        const token = document.querySelector('meta[name="csrf-token"]')?.content;
        const options = {
            method,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token || '',
            },
        };
        if (data) {
            options.headers['Content-Type'] = 'application/json';
            options.body = JSON.stringify(data);
        }
        const response = await fetch(url, options);
        if (!response.ok) {
            const err = await response.json().catch(() => ({}));
            throw new Error(err.message || 'Request gagal');
        }
        return response.json();
    }

        function showConfirm(message, onConfirm, options = {}) {
        const modal = document.getElementById('confirm-modal');
        if (!modal) {
            // Fallback ke confirm bawaan kalau modal nggak ada
            if (window.confirm(message)) onConfirm();
            return;
        }

        window.showConfirm = showConfirm;

        const title = options.title || 'Konfirmasi';
        const icon = options.icon || '⚠️';
        const okText = options.okText || 'Ya, Lanjutkan';
        const danger = options.danger !== false; // default merah

        document.getElementById('confirm-title').textContent = title;
        document.getElementById('confirm-message').textContent = message;
        document.getElementById('confirm-icon').textContent = icon;

        const okBtn = document.getElementById('confirm-ok');
        const cancelBtn = document.getElementById('confirm-cancel');

        okBtn.textContent = okText;
        okBtn.style.background = danger ? 'var(--rose)' : 'var(--green)';

        modal.style.display = 'flex';

        // Clone button biar event listener lama kehapus
        const newOk = okBtn.cloneNode(true);
        const newCancel = cancelBtn.cloneNode(true);
        okBtn.replaceWith(newOk);
        cancelBtn.replaceWith(newCancel);

        const close = () => { modal.style.display = 'none'; };

        newOk.addEventListener('click', () => {
            close();
            onConfirm();
        });
        newCancel.addEventListener('click', close);

        // Close kalau klik backdrop
        modal.addEventListener('click', (e) => {
            if (e.target === modal) close();
        });

        // Close kalau tekan ESC
        const escHandler = (e) => {
            if (e.key === 'Escape') {
                close();
                document.removeEventListener('keydown', escHandler);
            }
        };
        document.addEventListener('keydown', escHandler);
    }

        function setLoading(button, isLoading, loadingText = 'Memproses...') {
        if (!button) return;
        if (isLoading) {
            button.dataset.originalText = button.textContent;
            button.disabled = true;
            button.style.opacity = '0.6';
            button.style.cursor = 'not-allowed';
            button.textContent = loadingText;
        } else {
            button.disabled = false;
            button.style.opacity = '1';
            button.style.cursor = '';
            button.textContent = button.dataset.originalText || button.textContent;
        }
    }

    function notify(message) {
        if (!toast) return;
        toast.textContent = message;
        toast.classList.add('is-visible');
        window.clearTimeout(toastTimer);
        toastTimer = window.setTimeout(() => toast.classList.remove('is-visible'), 3600);
    }

    function loadCollection(key, isValid) {
        try {
            const raw = window.localStorage.getItem(key);
            if (raw === null) return null;
            const value = JSON.parse(raw);
            if (!Array.isArray(value) || !value.every(isValid)) {
                throw new Error('Format data tidak sesuai.');
            }
            return value;
        } catch (error) {
            storageAvailable = false;
            notify('Data lokal tidak dapat dibaca. Periksa penyimpanan browser sebelum melanjutkan.');
            console.error('FitMySkin gagal membaca penyimpanan lokal.', error);
            return [];
        }
    }

    function saveCollection(key, value) {
        try {
            window.localStorage.setItem(key, JSON.stringify(value));
            return true;
        } catch (error) {
            storageAvailable = false;
            notify('Perubahan belum tersimpan. Aktifkan penyimpanan browser lalu coba lagi.');
            console.error('FitMySkin gagal menyimpan data.', error);
            return false;
        }
    }

    const isProduct = (item) => item && typeof item.id === 'string'
        && typeof item.name === 'string' && typeof item.brand === 'string'
        && typeof item.category === 'string' && typeof item.ingredient === 'string'
        && typeof item.routine === 'string' && ['active', 'paused'].includes(item.status);
    const isJournal = (item) => item && typeof item.id === 'string'
        && ['morning', 'evening'].includes(item.type) && typeof item.date === 'string'
        && typeof item.condition === 'string' && Array.isArray(item.products)
        && Array.isArray(item.symptoms) && typeof item.note === 'string';

    let products = window.__INITIAL_PRODUCTS__ ?? loadCollection(PRODUCT_KEY, isProduct);
    let journals = window.__INITIAL_JOURNALS__ ?? loadCollection(JOURNAL_KEY, isJournal) ?? [];
    if (products === null) {
        products = starterProducts;
        saveCollection(PRODUCT_KEY, products);
    }

    function makeId() {
        return typeof crypto !== 'undefined' && typeof crypto.randomUUID === 'function'
            ? crypto.randomUUID()
            : `${Date.now()}-${Math.random().toString(16).slice(2)}`;
    }

    function localDateValue(date = new Date()) {
        const offset = date.getTimezoneOffset() * 60000;
        return new Date(date.getTime() - offset).toISOString().slice(0, 10);
    }

    function setText(selector, value) {
        document.querySelectorAll(selector).forEach((element) => {
            element.textContent = String(value);
        });
    }

    function createElement(tag, className, text) {
        const element = document.createElement(tag);
        if (className) element.className = className;
        if (text !== undefined) element.textContent = text;
        return element;
    }

    function createEmptyState(title, copy, buttonLabel, action) {
        const state = createElement('div', 'empty-state');
        state.append(createElement('span', 'empty-state-icon', '✿'));
        state.append(createElement('h3', '', title));
        state.append(createElement('p', '', copy));
        if (buttonLabel && action) {
            const button = createElement('button', 'button button-primary', buttonLabel);
            button.type = 'button';
            button.addEventListener('click', action);
            state.append(button);
        }
        return state;
    }

    function saveProducts() {
        return saveCollection(PRODUCT_KEY, products);
    }

    function saveJournals() {
        return saveCollection(JOURNAL_KEY, journals);
    }

    function productMatchesRoutine(product, type) {
        return product.routine === 'both' || product.routine === type;
    }

    function renderProductCount() {
        setText('[data-product-count]', products.length);
    }

    function renderCatalog() {
        const grid = document.querySelector('#product-grid');
        if (!grid) return;

        const query = (document.querySelector('#product-search')?.value ?? '').trim().toLocaleLowerCase('id');
        const category = document.querySelector('#product-filter')?.value ?? 'all';
        const status = document.querySelector('#product-status-filter')?.value ?? 'all';
        const visibleProducts = products.filter((product) => {
            const searchableText = `${product.name} ${product.brand} ${product.ingredient}`.toLocaleLowerCase('id');
            return (category === 'all' || product.category === category)
                && (status === 'all' || product.status === status)
                && searchableText.includes(query);
        });

        renderProductCount();
        grid.replaceChildren();
        if (visibleProducts.length === 0) {
            grid.append(createEmptyState(
                products.length === 0 ? 'Katalogmu masih kosong' : 'Produk tidak ditemukan',
                products.length === 0 ? 'Tambahkan produk skincare yang kamu gunakan untuk memulai.' : 'Coba kata kunci atau filter yang lain.',
                products.length === 0 ? 'Tambah produk pertama' : null,
                openProductDialog,
            ));
            return;
        }

        visibleProducts.forEach((product) => {
            const card = createElement('article', 'product-card');
            const visual = createElement('div', 'product-visual');
            const statusBadge = createElement('span', `product-status${product.status === 'paused' ? ' is-paused' : ''}`, product.status === 'active' ? 'Sedang digunakan' : 'Diistirahatkan');
            const icon = createElement('span', '', categoryIcon(product.category));
            const bottle = createElement('span', 'product-bottle');
            const categoryBadge = createElement('span', 'product-category-chip', categories[product.category] ?? 'Produk');
            bottle.append(icon);
            visual.append(statusBadge, bottle, categoryBadge);

            const info = createElement('div', 'product-info');
            info.append(createElement('p', 'product-brand', product.brand));
            info.append(createElement('h3', 'product-name', product.name));
            info.append(createElement('p', 'product-ingredient', product.ingredient || 'Kandungan belum ditambahkan'));

            const actions = createElement('div', 'product-actions');
            actions.append(createElement('span', 'product-routine', routineLabels[product.routine] ?? 'Pagi & malam'));
            const actionButtons = createElement('div', 'product-action-buttons');
            const toggle = createElement('button', 'product-toggle', product.status === 'active' ? 'Istirahatkan' : 'Gunakan lagi');
            toggle.type = 'button';
            toggle.setAttribute('aria-label', `${product.status === 'active' ? 'Istirahatkan' : 'Gunakan kembali'} ${product.name}`);
            toggle.addEventListener('click', async () => {
                const newStatus = product.status === 'active' ? 'paused' : 'active';
                setLoading(toggle, true, '...');
                try {
                    await apiCall(`/products/${product.id}`, 'PUT', { status: newStatus });
                    products = products.map((item) => item.id === product.id
                        ? { ...item, status: newStatus }
                        : item);
                    notify(`${product.name} ${newStatus === 'paused' ? 'diistirahatkan' : 'digunakan kembali'}.`);
                    renderCatalog();
                } catch (error) {
                    notify('Gagal update status produk. Coba lagi.');
                    console.error(error);
                    setLoading(toggle, false);
                }
            });
            const remove = createElement('button', 'product-delete', 'Hapus');
            remove.type = 'button';
            remove.setAttribute('aria-label', `Hapus ${product.name}`);
            remove.addEventListener('click', () => {
                showConfirm(
                    `Produk "${product.name}" akan dihapus permanen dari katalogmu. Tindakan ini tidak dapat dibatalkan.`,
                    async () => {
                        try {
                            await apiCall(`/products/${product.id}`, 'DELETE');
                            products = products.filter((item) => item.id !== product.id);
                            renderCatalog();
                            notify('Produk berhasil dihapus dari katalog.');
                        } catch (error) {
                            notify('Gagal hapus produk. Coba lagi.');
                            console.error(error);
                        }
                    },
                    {
                        title: 'Hapus Produk?',
                        icon: '🗑️',
                        okText: 'Ya, Hapus',
                    }
                );
            });

            actionButtons.append(toggle, remove);
            actions.append(actionButtons);
            info.append(actions);
            card.append(visual, info);
            grid.append(card);
        });
    }

    function categoryIcon(category) {
        return {
            cleanser: '◉',
            toner: '✿',
            serum: '♡',
            moisturizer: '☁',
            sunscreen: '☼',
            exfoliator: '✧',
        }[category] ?? '✿';
    }

    function openProductDialog() {
        const dialog = document.querySelector('#product-dialog');
        if (dialog && typeof dialog.showModal === 'function') dialog.showModal();
    }

    function setupProductForm() {
        const dialog = document.querySelector('#product-dialog');
        const form = document.querySelector('#product-form');
        if (!dialog || !form) return;

        document.querySelectorAll('[data-open-product-form]').forEach((button) => {
            button.addEventListener('click', openProductDialog);
        });
        dialog.querySelectorAll('[data-close-dialog]').forEach((button) => {
            button.addEventListener('click', () => dialog.close());
        });
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            if (!form.reportValidity()) return;

            const values = new FormData(form);
            const payload = {
                name: String(values.get('name') ?? '').trim(),
                brand: String(values.get('brand') ?? '').trim(),
                category: String(values.get('category')),
                ingredient: String(values.get('ingredient') ?? '').trim(),
                routine: String(values.get('routine')),
            };

            if (products.some((product) => product.name.toLocaleLowerCase('id') === payload.name.toLocaleLowerCase('id'))) {
                notify('Produk dengan nama tersebut sudah ada di katalog.');
                return;
            }

            const submitBtn = form.querySelector('button[type="submit"]');
            setLoading(submitBtn, true, 'Menyimpan...');

            try {
                const result = await apiCall('/products', 'POST', payload);
                products.unshift(result.product);
                renderCatalog();
                notify('Produk berhasil ditambahkan ke katalog.');
                form.reset();
                dialog.close();
                setLoading(submitBtn, false);
            } catch (error) {
                notify('Gagal menambah produk. Coba lagi.');
                console.error(error);
                setLoading(submitBtn, false);
            }
        });
    }

    function renderJournalProducts(type) {
        const container = document.querySelector('#journal-products');
        if (!container) return;
        container.replaceChildren();

        // Filter produk aktif yang cocok routine
        const availableProducts = products.filter((product) =>
            product.status === 'active' && productMatchesRoutine(product, type)
        );

        if (availableProducts.length === 0) {
            container.append(createEmptyState(
                'Belum ada produk untuk rutinitas ini',
                'Tambahkan produk aktif dari katalog, atau tetap simpan catatan kondisi kulitmu.',
                'Buka katalog produk',
                () => window.location.assign('/katalog'),
            ));
            return;
        }

        // ─── Urutin produk sesuai routine user ───
        const routineOrder = window.__ROUTINE_CATEGORIES__ || [];
        const ordered = [...availableProducts].sort((a, b) => {
            const idxA = routineOrder.indexOf(a.category);
            const idxB = routineOrder.indexOf(b.category);
            const posA = idxA === -1 ? 999 : idxA;
            const posB = idxB === -1 ? 999 : idxB;
            return posA - posB;
        });

        // Header info urutan
        if (routineOrder.length > 0) {
            const header = document.createElement('div');
            header.style.cssText = 'font-size: 9px; font-weight: 800; color: var(--muted); text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 8px; padding: 0 4px;';
            header.textContent = '✨ Mengikuti urutan rutinitasmu';
            container.append(header);
        }

        // ─── Render tiap produk dengan step number ───
        let stepCounter = 0;

        ordered.forEach((product) => {
            const idxInRoutine = routineOrder.indexOf(product.category);
            const isOrdered = idxInRoutine !== -1;
            if (isOrdered) stepCounter++;

            const label = createElement('label', 'journal-product-option');
            label.style.cssText = 'display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: 14px; border: 1px solid var(--line); background: white; cursor: pointer;';

            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'products';
            checkbox.value = product.id;
            checkbox.style.cssText = 'accent-color: var(--rose); width: 16px; height: 16px; flex-shrink: 0;';

            if (isOrdered) {
                const stepBadge = createElement('span', '', String(stepCounter).padStart(2, '0'));
                stepBadge.style.cssText = 'background: var(--rose-pale); color: var(--rose); width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; font-size: 10px; font-weight: 800; flex-shrink: 0;';
                label.append(checkbox, stepBadge);
            } else {
                const dot = createElement('span', '', '•');
                dot.style.cssText = 'width: 28px; text-align: center; color: var(--muted); font-size: 16px; flex-shrink: 0;';
                label.append(checkbox, dot);
            }

            const copy = createElement('span', 'journal-product-copy');
            copy.append(createElement('strong', '', product.name));
            copy.append(createElement('span', '', `${product.brand} · ${categories[product.category] ?? 'Produk'}`));
            label.append(copy);

            container.append(label);
        });

        // Info produk yang nggak masuk urutan
        const unorderedCount = ordered.filter(p => !routineOrder.includes(p.category)).length;
        if (unorderedCount > 0) {
            const info = document.createElement('div');
            info.style.cssText = 'font-size: 9px; color: var(--muted); font-style: italic; margin-top: 8px; padding: 0 4px;';
            info.textContent = `+${unorderedCount} produk lain yang belum ada di urutan rutinitasmu`;
            container.append(info);
        }
    }

    function countStreak(entries) {
        const dates = [...new Set(entries.map((entry) => entry.date))].sort().reverse();
        if (dates.length === 0) return 0;
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        const mostRecent = new Date(`${dates[0]}T00:00:00`);
        const daysSinceLast = Math.floor((today - mostRecent) / 86400000);
        if (daysSinceLast > 1) return 0;
        let streak = 1;
        for (let index = 1; index < dates.length; index += 1) {
            const current = new Date(`${dates[index - 1]}T00:00:00`);
            const previous = new Date(`${dates[index]}T00:00:00`);
            if ((current - previous) / 86400000 !== 1) break;
            streak += 1;
        }
        return streak;
    }

    function renderStreak() {
        // Kalau server udah kasih streak, pakai itu
        if (typeof window.__STREAK__ === 'number') {
            setText('[data-journal-streak]', window.__STREAK__);
            return;
        }
        setText('[data-journal-streak]', countStreak(journals));
    }

    function setupJournalForm() {
        const form = document.querySelector('#journal-form');
        if (!form) return;
        const type = form.dataset.journalType;
        const dateInput = form.elements.namedItem('date');
        if (dateInput) dateInput.value = localDateValue();
        renderJournalProducts(type);
        renderStreak();

        document.querySelectorAll('[data-condition]').forEach((button) => {
            button.addEventListener('click', () => {
                document.querySelectorAll('[data-condition]').forEach((choice) => choice.setAttribute('aria-pressed', 'false'));
                button.setAttribute('aria-pressed', 'true');
            });
        });

        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const selectedCondition = form.querySelector('[data-condition][aria-pressed="true"]');
            if (!selectedCondition) {
                notify('Pilih kondisi kulitmu sebelum menyimpan jurnal.');
                form.querySelector('[data-condition]')?.focus();
                return;
            }

            const values = new FormData(form);
            const payload = {
                type,
                date: String(values.get('date')),
                condition: selectedCondition.dataset.condition,
                products: values.getAll('products').map(String),
                symptoms: values.getAll('symptoms').map(String).filter((s) => s !== 'Tidak ada'),
                note: String(values.get('note') ?? '').trim(),
            };

            const submitBtn = form.querySelector('button[type="submit"]');
            setLoading(submitBtn, true, 'Menyimpan...');

            try {
                await apiCall('/journals', 'POST', payload);
                notify(`Jurnal ${type === 'morning' ? 'pagi' : 'malam'} berhasil disimpan.`);
                window.setTimeout(() => window.location.assign('/jurnal/riwayat'), 650);
                setLoading(submitBtn, false);
            } catch (error) {
                notify('Gagal menyimpan jurnal. Coba lagi.');
                console.error(error);
                setLoading(submitBtn, false);
            }
        });
    }

    function formatDate(dateString) {
        const date = new Date(`${dateString}T00:00:00`);
        if (Number.isNaN(date.getTime())) return dateString;
        return new Intl.DateTimeFormat('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }).format(date);
    }

    function renderHistory() {
        const list = document.querySelector('#history-list');
        if (!list) return;

        const query = (document.querySelector('#history-search')?.value ?? '').trim().toLocaleLowerCase('id');
        const type = document.querySelector('#history-type-filter')?.value ?? 'all';
        const filtered = journals.filter((entry) => {
            const searchableText = `${entry.condition} ${entry.note} ${entry.symptoms.join(' ')} ${entry.products.join(' ')}`.toLocaleLowerCase('id');
            return (type === 'all' || entry.type === type) && searchableText.includes(query);
        }).sort((first, second) => second.date.localeCompare(first.date));

        setText('[data-history-count]', journals.length);
        setText('#history-result-count', `${filtered.length} catatan`);
        renderStreak();
        list.replaceChildren();
        if (filtered.length === 0) {
            list.append(createEmptyState(
                journals.length === 0 ? 'Belum ada jurnal tersimpan' : 'Catatan tidak ditemukan',
                journals.length === 0 ? 'Mulai dengan menulis jurnal pagi atau malam untuk mengenali kondisi kulitmu.' : 'Coba kata kunci atau jenis jurnal yang lain.',
                journals.length === 0 ? 'Tulis jurnal pagi' : null,
                () => window.location.assign('/jurnal/pagi'),
            ));
            return;
        }

        filtered.forEach((entry) => {
            const card = createElement('article', 'history-entry');
            const date = new Date(`${entry.date}T00:00:00`);
            const dateBadge = createElement('div', 'history-date-badge');
            dateBadge.append(createElement('strong', '', Number.isNaN(date.getTime()) ? '–' : date.getDate()));
            dateBadge.append(createElement('span', '', Number.isNaN(date.getTime()) ? '' : new Intl.DateTimeFormat('id-ID', { month: 'short' }).format(date)));
            const content = createElement('div', 'history-entry-content');
            const heading = createElement('div', 'history-entry-heading');
            heading.append(createElement('h3', '', formatDate(entry.date)));
            heading.append(createElement('span', 'routine-badge', entry.type === 'morning' ? 'Jurnal pagi' : 'Jurnal malam'));
            content.append(heading);
            content.append(createElement('p', 'history-products', `Kondisi kulit: ${entry.condition}`));

            const meta = createElement('div', 'history-entry-meta');
            (entry.symptoms.length > 0 ? entry.symptoms : ['Tidak ada keluhan tambahan']).forEach((symptom) => meta.append(createElement('span', '', symptom)));
            content.append(meta);
            if (entry.products.length > 0) content.append(createElement('p', 'history-products', `Produk: ${entry.products.join(', ')}`));
            if (entry.note) content.append(createElement('p', 'history-entry-note', entry.note));

            const remove = createElement('button', 'history-delete', 'Hapus catatan');
            remove.type = 'button';
            remove.addEventListener('click', () => {
                showConfirm(
                    'Catatan jurnal ini akan dihapus permanen. Tindakan ini tidak dapat dibatalkan.',
                    async () => {
                        const idsToDelete = entry.ids || [entry.id];
                        try {
                            for (const jid of idsToDelete) {
                                await apiCall(`/journals/${jid}`, 'DELETE');
                            }
                            journals = journals.filter((item) => item.id !== entry.id);
                            notify('Catatan jurnal berhasil dihapus.');
                            renderHistory();
                        } catch (error) {
                            notify('Gagal menghapus jurnal. Coba lagi.');
                            console.error(error);
                        }
                    },
                    {
                        title: 'Hapus Catatan Jurnal?',
                        icon: '📖',
                        okText: 'Ya, Hapus',
                    }
                );
            });

            card.append(dateBadge, content, remove);
            list.append(card);
        });
    }

    function setupNavigation() {
        const toggle = document.querySelector('.nav-toggle');
        const navigation = document.querySelector('.main-navigation');
        if (!toggle || !navigation) return;
        toggle.addEventListener('click', () => {
            const isOpen = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', String(!isOpen));
            toggle.setAttribute('aria-label', isOpen ? 'Buka navigasi' : 'Tutup navigasi');
            navigation.classList.toggle('is-open', !isOpen);
        });
    }

    function init() {
        setupNavigation();
        setupProductForm();
        document.querySelector('#product-search')?.addEventListener('input', renderCatalog);
        document.querySelector('#product-filter')?.addEventListener('change', renderCatalog);
        document.querySelector('#product-status-filter')?.addEventListener('change', renderCatalog);
        document.querySelector('#history-search')?.addEventListener('input', renderHistory);
        document.querySelector('#history-type-filter')?.addEventListener('change', renderHistory);
        renderCatalog();
        setupJournalForm();
        renderHistory();
        window.addEventListener('storage', (event) => {
            if (![PRODUCT_KEY, JOURNAL_KEY].includes(event.key) || event.newValue === null) return;
            try {
                const value = JSON.parse(event.newValue);
                if (!Array.isArray(value)) throw new Error('Format data tidak sesuai.');
                if (event.key === PRODUCT_KEY && value.every(isProduct)) {
                    products = value;
                    renderCatalog();
                    renderJournalProducts(document.querySelector('#journal-form')?.dataset.journalType);
                } else if (event.key === JOURNAL_KEY && value.every(isJournal)) {
                    journals = value;
                    renderHistory();
                    renderStreak();
                } else {
                    throw new Error('Format data tidak sesuai.');
                }
            } catch (error) {
                notify('Data dari tab lain tidak dapat dibaca dan tidak diterapkan.');
                console.error('FitMySkin gagal memperbarui data dari tab lain.', error);
            }
        });
        if (!storageAvailable) notify('Penyimpanan browser bermasalah; perubahan mungkin tidak tersimpan.');
    }

    init();
})();