<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login PAK Wi Online</title>
    <style>
        body { font-family: 'Inter', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f3f4f6; margin: 0; padding: 1rem; }
        .card { padding: 2.5rem; background: white; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); width: 100%; max-width: 420px; }
        .card h2 { text-align: center; font-size: 1.75rem; font-weight: 700; color: #1f2937; margin-top: 0; margin-bottom: 0.5rem; }
        .card .subtitle { text-align: center; color: #6b7280; margin-bottom: 2rem; font-size: 0.95rem; line-height: 1.4; }
        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; margin-top: 2%; font-weight: 600; color: #374151; }
        .password-wrapper { position: relative; }
        .form-control { width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; box-sizing: border-box; font-size: 1rem; transition: border-color 0.2s; }
        .form-control:focus { border-color: #3b82f6; outline: none; box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2); }
        .credential-input { font-family: inherit; }
        .input-type-indicator { position: absolute; right: 2.5rem; top: 50%; transform: translateY(-50%); font-size: 0.75rem; color: #6b7280; padding: 0.25rem 0.5rem; background-color: #f9fafb; border-radius: 4px; transition: all 0.2s; }
        .toggle-password { position: absolute; top: 50%; right: 0.75rem; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 0.25rem; color: #6b7280; }
        .btn { width: 100%; padding: 0.85rem; border: none; background-color: #3b82f6; color: white; border-radius: 8px; cursor: pointer; font-size: 1rem; font-weight: 600; transition: background-color 0.2s; }
        .btn:hover:not(:disabled) { background-color: #2563eb; }
        .btn:disabled { background-color: #9ca3af; cursor: not-allowed; }
        .link { text-align: center; margin-top: 1.5rem; font-size: 0.875rem; color: #6b7280; line-height: 1.4; }
        .link a { color: #3b82f6; text-decoration: none; font-weight: 600; }
        .link a:hover { text-decoration: underline; }
        .error-message { background-color: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 0.75rem; border-radius: 6px; font-size: 0.875rem; margin-bottom: 1rem; }
        .info-box { background-color: #eff6ff; border-left: 4px solid #3b82f6; padding: 1rem; margin-bottom: 1.5rem; font-size: 0.875rem; color: #1e40af; line-height: 1.4; }
        .example-item { margin: 0.25rem 0; }
        .loading-spinner { border: 2px solid #f3f3f3; border-top: 2px solid #3b82f6; border-radius: 50%; width: 16px; height: 16px; animation: spin 1s linear infinite; display: inline-block; margin-right: 8px; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        
        /* Gemini Feature Styles */
        .gemini-feature { text-align: center; margin-top: 2rem; border-top: 1px solid #e5e7eb; padding-top: 1.5rem; }
        .gemini-btn { display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.5rem 1rem; border: 1px solid #d1d5db; background-color: #f9fafb; color: #374151; border-radius: 8px; cursor: pointer; font-size: 0.875rem; font-weight: 500; transition: all 0.2s; }
        .gemini-btn:hover:not(:disabled) { background-color: #f3f4f6; border-color: #3b82f6; }
        .tip-box { margin-top: 1rem; padding: 1rem; background-color: #eff6ff; border-left: 4px solid #3b82f6; color: #1e40af; font-size: 0.875rem; text-align: left; border-radius: 4px; display: none; line-height: 1.4; }
        
        /* Responsive Design */
        @media (max-width: 480px) {
            .card { padding: 1.5rem; margin: 0.5rem; }
            .card h2 { font-size: 1.5rem; }
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="card">
        <h2>Login PAK Wi Online</h2>
        <p class="subtitle">
            Masuk menggunakan <strong>NIP</strong> atau <strong>Email</strong> Anda<br>
            Sistem akan otomatis mendeteksi jenis kredensial yang Anda masukkan
        </p>
        
        <!-- Info Box untuk panduan login fleksibel -->
        <div class="info-box">
            <strong>🔑 Login Fleksibel:</strong><br>
            Anda dapat login menggunakan NIP (Nomor Induk Pegawai) atau Email. 
            Sistem akan secara otomatis mendeteksi jenis kredensial yang Anda masukkan.
        </div>

        <!-- Error Messages -->
        <div id="error-container" style="display: none;">
            <div class="error-message" id="error-message"></div>
        </div>

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            <div class="form-group">
                <label for="credential">NIP atau Email</label>
                <div style="position: relative;">
                    <input 
                        id="credential" 
                        type="text" 
                        class="form-control credential-input" 
                        name="credential" 
                        placeholder="Masukkan NIP atau alamat email Anda" 
                        required 
                        autofocus
                        autocomplete="username"
                    >
                    <span id="input-type-indicator" class="input-type-indicator" style="display: none;"></span>
                </div>


            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-wrapper">
                    <input 
                        id="password" 
                        type="password" 
                        class="form-control" 
                        name="password" 
                        required
                        autocomplete="current-password"
                    >
                    <button type="button" class="toggle-password" id="togglePassword">
                        <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>

            <!-- Remember Me Checkbox -->
            <div class="form-group">
                <label style="display: flex; align-items: center; font-weight: normal; cursor: pointer;">
                    <input type="checkbox" name="remember" style="margin-right: 0.5rem;">
                    Ingat saya selama 30 hari
                </label>
            </div>

            <div class="form-group">
                <button type="submit" class="btn" id="submitBtn">
                    <span id="submitText">Login</span>
                    <div id="submitSpinner" class="loading-spinner" style="display: none;"></div>
                </button>
            </div>

            <p class="link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a><br>
                <small>Lupa password? <a href="{{ route('password.request') }}">Reset password</a></small>
            </p>
        </form>

        <!-- Gemini Security Tip Feature -->
        <div class="gemini-feature">
            <button type="button" class="gemini-btn" id="securityTipBtn">
                <span id="gemini-btn-text">✨ Tips Keamanan Login</span>
                <div id="gemini-loading" class="loading-spinner" style="display: none;"></div>
            </button>
            <p id="tip-display" class="tip-box"></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const credentialInput = document.getElementById('credential');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitSpinner = document.getElementById('submitSpinner');
            const errorContainer = document.getElementById('error-container');
            const errorMessage = document.getElementById('error-message');
            const typeIndicator = document.getElementById('input-type-indicator');
            
            // Real-time credential type detection
            credentialInput.addEventListener('input', function(e) {
                const value = e.target.value.trim();
                detectCredentialType(value);
                validateCredential(value);
            });

            function detectCredentialType(credential) {
                if (!credential) {
                    typeIndicator.style.display = 'none';
                    return 'none';
                }

                // Detect if it's an email (contains @ and has domain structure)
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                // Detect if it's a NIP (only contains digits, length 12-18)
                const nipRegex = /^\d{12,18}$/;
                
                if (emailRegex.test(credential)) {
                    typeIndicator.textContent = 'EMAIL';
                    typeIndicator.style.display = 'block';
                    typeIndicator.style.backgroundColor = '#dcfce7';
                    typeIndicator.style.color = '#166534';
                    return 'email';
                } else if (nipRegex.test(credential)) {
                    typeIndicator.textContent = 'NIP';
                    typeIndicator.style.display = 'block';
                    typeIndicator.style.backgroundColor = '#dbeafe';
                    typeIndicator.style.color = '#1d4ed8';
                    return 'nip';
                } else if (/^\d+$/.test(credential) && credential.length < 12) {
                    typeIndicator.textContent = 'NIP (Kurang)';
                    typeIndicator.style.display = 'block';
                    typeIndicator.style.backgroundColor = '#fef3c7';
                    typeIndicator.style.color = '#92400e';
                    return 'nip-incomplete';
                } else if (credential.includes('@') && !emailRegex.test(credential)) {
                    typeIndicator.textContent = 'EMAIL (Invalid)';
                    typeIndicator.style.display = 'block';
                    typeIndicator.style.backgroundColor = '#fee2e2';
                    typeIndicator.style.color = '#dc2626';
                    return 'email-invalid';
                } else {
                    typeIndicator.style.display = 'none';
                    return 'unknown';
                }
            }

            function validateCredential(credential) {
                const type = detectCredentialType(credential);
                let isValid = false;
                
                switch(type) {
                    case 'email':
                        isValid = true;
                        credentialInput.style.borderColor = '#10b981';
                        break;
                    case 'nip':
                        isValid = true;
                        credentialInput.style.borderColor = '#10b981';
                        break;
                    case 'none':
                        credentialInput.style.borderColor = '';
                        isValid = true; // Empty is okay for now
                        break;
                    default:
                        credentialInput.style.borderColor = '#ef4444';
                        isValid = false;
                }
                
                return isValid;
            }

            // Form submission with enhanced validation
            form.addEventListener('submit', function(e) {
                const credentialValue = credentialInput.value.trim();
                const credentialType = detectCredentialType(credentialValue);
                
                // Validate credential format before submission
                if (credentialType === 'email-invalid') {
                    e.preventDefault();
                    showError('Format email tidak valid. Pastikan email mengandung @ dan domain yang benar.');
                    return;
                } else if (credentialType === 'nip-incomplete') {
                    e.preventDefault();
                    showError('NIP harus terdiri dari 12-18 digit angka.');
                    return;
                } else if (credentialType === 'unknown' && credentialValue) {
                    e.preventDefault();
                    showError('Kredensial harus berupa NIP (12-18 digit angka) atau alamat email yang valid.');
                    return;
                }

                // Show loading state
                submitBtn.disabled = true;
                submitText.textContent = 'Memverifikasi...';
                submitSpinner.style.display = 'inline-block';
                hideError();
            });

            function showError(message) {
                errorMessage.textContent = message;
                errorContainer.style.display = 'block';
                errorContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }

            function hideError() {
                errorContainer.style.display = 'none';
            }

            // Password toggle functionality
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');

            togglePassword.addEventListener('click', function() {
                const isPassword = password.type === 'password';
                password.type = isPassword ? 'text' : 'password';
                this.innerHTML = isPassword 
                    ? `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path><line x1="2" x2="22" y1="2" y2="22"></line></svg>` 
                    : `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg>`;
            });

            // Gemini Security Tips Feature
            const tipBtn = document.getElementById('securityTipBtn');
            const tipDisplay = document.getElementById('tip-display');
            const tipBtnText = document.getElementById('gemini-btn-text');
            const tipLoadingSpinner = document.getElementById('gemini-loading');

            tipBtn.addEventListener('click', async () => {
                tipBtnText.textContent = 'Meminta tips...';
                tipLoadingSpinner.style.display = 'block';
                tipBtn.disabled = true;
                tipDisplay.style.display = 'none';

                const prompt = "Berikan satu tips keamanan untuk sistem login yang mendukung baik NIP maupun email sebagai kredensial. Tips harus singkat, praktis, dan mudah dipahami oleh pengguna institusi pemerintahan. Fokus pada praktik keamanan yang berlaku untuk kedua jenis kredensial.";

                try {
                    const chatHistory = [{ role: "user", parts: [{ text: prompt }] }];
                    const payload = { contents: chatHistory };
                    const apiKey = @json($geminiApiKey ?? config('services.gemini.key'));
                    
                    if (!apiKey) {
                        throw new Error('API key tidak tersedia');
                    }
                    
                    const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;

                    const response = await fetch(apiUrl, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(payload)
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const result = await response.json();

                    if (result.candidates && result.candidates[0].content && result.candidates[0].content.parts) {
                        const securityTip = result.candidates[0].content.parts[0].text.trim();
                        tipDisplay.textContent = '🔒 ' + securityTip;
                        tipDisplay.style.display = 'block';
                    } else {
                        tipDisplay.textContent = '⚠️ Gagal mendapatkan tips keamanan. Coba lagi nanti.';
                        tipDisplay.style.display = 'block';
                    }

                } catch (error) {
                    console.error('Error saat memanggil Gemini API:', error);
                    tipDisplay.textContent = '❌ Terjadi kesalahan saat meminta tips. Periksa koneksi internet Anda.';
                    tipDisplay.style.display = 'block';
                } finally {
                    tipBtnText.textContent = '✨ Tips Keamanan Login';
                    tipLoadingSpinner.style.display = 'none';
                    tipBtn.disabled = false;
                }
            });

            // Auto-focus on credential input when page loads
            credentialInput.focus();
        });
    </script>
</body>
</html>