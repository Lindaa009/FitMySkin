function switchMode(mode) {
    const tabLogin = document.getElementById('tab-login');
    const tabRegister = document.getElementById('tab-register');
    const fieldNama = document.getElementById('field-nama');
    const btnSubmit = document.getElementById('btn-submit');

    if (mode === 'register') {
        // Aktifkan tab Register
        tabRegister.style.background = 'white';
        tabRegister.style.color = 'var(--ink)';
        tabRegister.style.boxShadow = '0 2px 8px rgba(0,0,0,0.04)';
        
        tabLogin.style.background = 'transparent';
        tabLogin.style.color = 'var(--muted)';
        tabLogin.style.boxShadow = 'none';

        // Tampilkan field nama lengkap untuk pendaftaran
        if (fieldNama) {
            fieldNama.style.display = 'grid';
        }

        // Ubah teks tombol submit
        if (btnSubmit) {
            btnSubmit.textContent = 'Buat Akun Baru ✨';
        }
    } else {
        // Aktifkan tab Login
        tabLogin.style.background = 'white';
        tabLogin.style.color = 'var(--ink)';
        tabLogin.style.boxShadow = '0 2px 8px rgba(0,0,0,0.04)';
        
        tabRegister.style.background = 'transparent';
        tabRegister.style.color = 'var(--muted)';
        tabRegister.style.boxShadow = 'none';

        // Sembunyikan field nama lengkap saat login
        if (fieldNama) {
            fieldNama.style.display = 'none';
        }

        // Ubah teks tombol submit
        if (btnSubmit) {
            btnSubmit.textContent = 'Masuk Sekarang ✨';
        }
    }
}
