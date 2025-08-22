<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - PAK Wi Online</title>
    <style>
        body { font-family: 'Inter', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f3f4f6; margin: 0; padding: 1rem; }
        .card { padding: 2.5rem; background: white; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); width: 100%; max-width: 450px; }
        .card h2 { text-align: center; font-size: 1.75rem; font-weight: 700; color: #1f2937; margin-top: 0; margin-bottom: 0.5rem; }
        .card .subtitle { text-align: center; color: #6b7280; margin-bottom: 2rem; font-size: 0.95rem; line-height: 1.4; }
        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; }
        .required-field::after { content: ' *'; color: #ef4444; }
        .optional-field::after { content: ' (opsional)'; color: #6b7280; font-weight: normal; font-size: 0.875rem; }
        .form-help { font-size: 0.875rem; color: #6b7280; margin-top: 0.25rem; line-height: 1.3; }
        .password-wrapper { position: relative; }
        .form-control { width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; box-sizing: border-box; font-size: 1rem; transition: border-color 0.2s; }
        .form-control:focus { border-color: #3b82f6; outline: none; box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2); }
        .nip-input { font-family: 'Courier New', monospace; letter-spacing: 1px; }
        .toggle-password { position: absolute; top: 50%; right: 0.75rem; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 0.25rem; color: #6b7280; }
        .btn { width: 100%; padding: 0.85rem; border: none; background-color: #3b82f6; color: white; border-radius: 8px; cursor: pointer; font-size: 1rem; font-weight: 600; transition: background-color 0.2s; margin-bottom: 0.5rem; }
        .btn:hover:not(:disabled) { background-color: #2563eb; }
        .btn:disabled { background-color: #9ca3af; cursor: not-allowed; }
        .btn-secondary { background-color: #f9fafb; color: #374151; border: 1px solid #d1d5db; }
        .btn-secondary:hover:not(:disabled) { background-color: #f3f4f6; border-color: #3b82f6; }
        .link { text-align: center; margin-top: 1.5rem; font-size: 0.875rem; color: #6b7280; line-height: 1.4; }
        .link a { color: #3b82f6; text-decoration: none; font-weight: 600; }
        .link a:hover { text-decoration: underline; }
        .error-message { background-color: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 0.75rem; border-radius: 6px; font-size: 0.875rem; margin-bottom: 1rem; }
        .success-message { background-color: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 0.75rem; border-radius: 6px; font-size: 0.875rem; margin-bottom: 1rem; }
        .info-box { background-color: #eff6ff; border-left: 4px solid #3b82f6; padding: 1rem; margin-bottom: 1.5rem; font-size: 0.875rem; color: #1e40af; line-height: 1.4; }
        .warning-box { background-color: #fffbeb; border-left: 4px solid #f59e0b; padding: 1rem; margin-bottom: 1.5rem; font-size: 0.875rem; color: #92400e; line-height: 1.4; }
        .nip-format-guide { background-color: #f9fafb; border: 1px solid #e5e7eb; padding: 0.75rem; border-radius: 6px; margin-top: 0.5rem; font-size: 0.875rem; color: #4b5563; line-height: 1.3; }
        .validation-feedback { font-size: 0.875rem; margin-top: 0.25rem; display: none; }
        .validation-success { color: #059669; }
        .validation-error { color: #dc2626; }
        .loading-spinner { border: 2px solid #f3f3f3; border-top: 2px solid #3b82f6; border-radius: 50%; width: 16px; height: 16px; animation: spin 1s linear infinite; display: inline-block; margin-right: 8px; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        
        /* Progress indicator */
        .progress-container { background-color: #f3f4f6; height: 4px; border-radius: 2px; margin-bottom: 1rem; }
        .progress-bar { background-color: #3b82f6; height: 100%; border-radius: 2px; transition: width 0.3s ease; }
        
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
        <h2>Daftar Akun Baru</h2>
        <p class="subtitle">
            Buat akun PAK Wi Online menggunakan NIP Anda<br>
            Email bersifat opsional untuk notifikasi sistem
        </p>
        
        <!-- Progress indicator -->
        <div class="progress-container">
            <div id="progress-bar" class="progress-bar" style="width: 0%;"></div>
        </div>

        <!-- Info Box untuk panduan registrasi -->
        <div class="info-box">
            <strong>📝 Panduan Registrasi:</strong><br>
            • <strong>NIP</strong> adalah wajib dan akan menjadi kredensial login utama Anda<br>
            • <strong>Email</strong> bersifat opsional, tetapi sangat disarankan untuk notifikasi<br>
            • <strong>Password</strong> minimal 8 karakter dengan kombinasi huruf dan angka
        </div>

        <!-- Warning Box -->
        <div class="warning-box">
            <strong>⚠️ Penting:</strong> Pastikan NIP yang Anda masukkan benar. 
            NIP tidak dapat diubah setelah akun dibuat dan akan digunakan untuk login.
        </div>

        <!-- Error/Success Messages -->
        <div id="message-container" style="display: none;">
            <div id="message-content"></div>
        </div>

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf
            
            <!-- Nama Lengkap -->
            <div class="form-group">
                <label for="name" class="required-field">Nama Lengkap</label>
                <input 
                    id="name" 
                    type="text" 
                    class="form-control" 
                    name="name" 
                    required
                    placeholder="Masukkan nama lengkap Anda"
                    autocomplete="name"
                >
                <div class="form-help">Gunakan nama lengkap sesuai dengan dokumen resmi Anda</div>
                <div id="name-feedback" class="validation-feedback"></div>
            </div>

            <!-- NIP (Wajib) -->
            <div class="form-group">
                <label for="nip" class="required-field">Nomor Induk Pegawai (NIP)</label>
                <input 
                    id="nip" 
                    type="text" 
                    class="form-control nip-input" 
                    name="nip" 
                    required
                    placeholder="Contoh: 199001010001234567"
                    maxlength="18"
                    pattern="[0-9]{12,18}"
                    autocomplete="username"
                >
                <div class="form-help">
                    NIP akan menjadi kredensial login utama Anda (12-18 digit angka)
                </div>
                <div class="nip-format-guide">
                    <strong>Format NIP standar:</strong> 18 digit angka<br>
                    <strong>Contoh:</strong> 199001010001234567<br>
                    <small>Jika NIP Anda kurang dari 18 digit, tetap dapat digunakan (minimal 12 digit)</small>
                </div>
                <div id="nip-feedback" class="validation-feedback"></div>
            </div>

            <!-- Email (Opsional) -->
            <div class="form-group">
                <label for="email" class="optional-field">Alamat Email</label>
                <input 
                    id="email" 
                    type="email" 
                    class="form-control" 
                    name="email"
                    placeholder="contoh@email.com (opsional)"
                    autocomplete="email"
                >
                <div class="form-help">
                    Email digunakan untuk notifikasi sistem dan pemulihan akun. 
                    <strong>Sangat disarankan diisi</strong> meskipun opsional.
                </div>
                <div id="email-feedback" class="validation-feedback"></div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="required-field">Password</label>
                <div class="password-wrapper">
                    <input 
                        id="password" 
                        type="password" 
                        class="form-control" 
                        name="password" 
                        required
                        minlength="8"
                        autocomplete="new-password"
                    >
                    <button type="button" class="toggle-password" data-target="password">
                        <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
                <button type="button" class="btn btn-secondary" id="generatePasswordBtn">
                    <span id="generate-btn-text">✨ Buatkan Password Aman</span>
                    <div id="generate-loading" class="loading-spinner" style="display: none;"></div>
                </button>
                <div class="form-help">
                    Minimal 8 karakter, disarankan kombinasi huruf besar, kecil, angka, dan simbol
                </div>
                <div id="password-feedback" class="validation-feedback"></div>
            </div>

            <!-- Konfirmasi Password -->
            <div class="form-group">
                <label for="password_confirmation" class="required-field">Konfirmasi Password</label>
                <div class="password-wrapper">
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        class="form-control" 
                        name="password_confirmation" 
                        required
                        autocomplete="new-password"
                    >
                    <button type="button" class="toggle-password" data-target="password_confirmation">
                        <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
                <div class="form-help">Ketik ulang password yang sama persis</div>
                <div id="password-confirm-feedback" class="validation-feedback"></div>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn" id="submitBtn">
                    <span id="submitText">Buat Akun</span>
                    <div id="submitSpinner" class="loading-spinner" style="display: none;"></div>
                </button>
            </div>

            <p class="link">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </p>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const nameInput = document.getElementById('name');
            const nipInput = document.getElementById('nip');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const passwordConfirmInput = document.getElementById('password_confirmation');
            const progressBar = document.getElementById('progress-bar');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitSpinner = document.getElementById('submitSpinner');

            // Real-time validation and progress tracking
            const requiredFields = [nameInput, nipInput, passwordInput, passwordConfirmInput];
            let fieldValidation = {
                name: false,
                nip: false,
                email: true, // Email is optional, so default to true
                password: false,
                password_confirmation: false
            };

            // Update progress bar
            function updateProgress() {
                const validFields = Object.values(fieldValidation).filter(Boolean).length;
                const progress = (validFields / Object.keys(fieldValidation).length) * 100;
                progressBar.style.width = progress + '%';
            }

            // Validation functions
            function validateName(name) {
                const isValid = name.length >= 2 && name.length <= 100;
                showFieldFeedback('name', isValid, isValid ? 'Nama valid' : 'Nama minimal 2 karakter');
                fieldValidation.name = isValid;
                updateProgress();
                return isValid;
            }

            function validateNip(nip) {
                const cleaned = nip.replace(/[^0-9]/g, '');
                const isValid = cleaned.length >= 12 && cleaned.length <= 18;
                
                if (cleaned.length === 0) {
                    showFieldFeedback('nip', false, 'NIP wajib diisi');
                } else if (cleaned.length < 12) {
                    showFieldFeedback('nip', false, `NIP minimal 12 digit (saat ini: ${cleaned.length} digit)`);
                } else if (cleaned.length > 18) {
                    showFieldFeedback('nip', false, `NIP maksimal 18 digit (saat ini: ${cleaned.length} digit)`);
                } else {
                    showFieldFeedback('nip', true, `Format NIP valid (${cleaned.length} digit)`);
                }
                
                fieldValidation.nip = isValid;
                updateProgress();
                return isValid;
            }

            function validateEmail(email) {
                if (!email.trim()) {
                    // Email is optional
                    showFieldFeedback('email', true, 'Email opsional (kosong)');
                    fieldValidation.email = true;
                    updateProgress();
                    return true;
                }
                
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                const isValid = emailRegex.test(email);
                showFieldFeedback('email', isValid, isValid ? 'Format email valid' : 'Format email tidak valid');
                fieldValidation.email = isValid;
                updateProgress();
                return isValid;
            }

            function validatePassword(password) {
                const minLength = password.length >= 8;
                const hasLetter = /[a-zA-Z]/.test(password);
                const hasNumber = /[0-9]/.test(password);
                
                let message = '';
                let isValid = minLength && hasLetter && hasNumber;
                
                if (!minLength) {
                    message = `Password minimal 8 karakter (saat ini: ${password.length})`;
                } else if (!hasLetter || !hasNumber) {
                    message = 'Password harus mengandung huruf dan angka';
                } else {
                    message = 'Password memenuhi syarat';
                }
                
                showFieldFeedback('password', isValid, message);
                fieldValidation.password = isValid;
                
                // Also revalidate password confirmation
                if (passwordConfirmInput.value) {
                    validatePasswordConfirmation(passwordConfirmInput.value);
                }
                
                updateProgress();
                return isValid;
            }

            function validatePasswordConfirmation(confirmPassword) {
                const password = passwordInput.value;
                const isValid = confirmPassword === password && confirmPassword.length > 0;
                
                let message = '';
                if (!confirmPassword) {
                    message = 'Konfirmasi password wajib diisi';
                } else if (confirmPassword !== password) {
                    message = 'Password tidak cocok';
                } else {
                    message = 'Password cocok';
                }
                
                showFieldFeedback('password-confirm', isValid, message);
                fieldValidation.password_confirmation = isValid;
                updateProgress();
                return isValid;
            }

            function showFieldFeedback(fieldName, isValid, message) {
                const feedbackElement = document.getElementById(fieldName + '-feedback');
                if (feedbackElement) {
                    feedbackElement.textContent = message;
                    feedbackElement.className = `validation-feedback ${isValid ? 'validation-success' : 'validation-error'}`;
                    feedbackElement.style.display = 'block';
                }
            }

            // Event listeners for real-time validation
            nameInput.addEventListener('input', (e) => validateName(e.target.value.trim()));
            
            nipInput.addEventListener('input', function(e) {
                // Clean and limit NIP input
                let value = e.target.value.replace(/[^0-9]/g, '');
                if (value.length > 18) value = value.slice(0, 18);
                e.target.value = value;
                validateNip(value);
            });
            
            emailInput.addEventListener('input', (e) => validateEmail(e.target.value.trim()));
            passwordInput.addEventListener('input', (e) => validatePassword(e.target.value));
            passwordConfirmInput.addEventListener('input', (e) => validatePasswordConfirmation(e.target.value));

            // Password toggle functionality
            document.querySelectorAll('.toggle-password').forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.dataset.target;
                    const passwordField = document.getElementById(targetId);
                    const isPassword = passwordField.type === 'password';
                    passwordField.type = isPassword ? 'text' : 'password';
                    this.innerHTML = isPassword 
                        ? `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path><line x1="2" x2="22" y1="2" y2="22"></line></svg>` 
                        : `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg>`;
                });
            });

            // Password generator
            const generateBtn = document.getElementById('generatePasswordBtn');
            const generateBtnText = document.getElementById('generate-btn-text');
            const generateLoading = document.getElementById('generate-loading');

            generateBtn.addEventListener('click', async () => {
                generateBtnText.textContent = 'Membuat...';
                generateLoading.style.display = 'block';
                generateBtn.disabled = true;

                const prompt = "Buatkan sebuah password yang aman dan mudah diingat untuk sistem pemerintahan. Password harus memiliki 12-16 karakter dengan kombinasi huruf besar, huruf kecil, angka, dan satu simbol. Berikan hanya passwordnya saja tanpa penjelasan.";
                
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
                        const generatedPassword = result.candidates[0].content.parts[0].text.trim();
                        passwordInput.value = generatedPassword;
                        passwordConfirmInput.value = generatedPassword;
                        
                        // Trigger validation
                        validatePassword(generatedPassword);
                        validatePasswordConfirmation(generatedPassword);
                        
                        showMessage('Password berhasil dibuat dan diisi otomatis!', 'success');
                    } else {
                        throw new Error('Respons API tidak valid');
                    }
                } catch (error) {
                    console.error('Error generating password:', error);
                    showMessage('Gagal membuat password. Silakan buat password manual.', 'error');
                } finally {
                    generateBtnText.textContent = '✨ Buatkan Password Aman';
                    generateLoading.style.display = 'none';
                    generateBtn.disabled = false;
                }
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                // Final validation before submission
                const name = nameInput.value.trim();
                const nip = nipInput.value.replace(/[^0-9]/g, '');
                const email = emailInput.value.trim();
                const password = passwordInput.value;
                const passwordConfirm = passwordConfirmInput.value;

                let isFormValid = true;
                let firstErrorField = null;

                // Validate all fields
                if (!validateName(name)) {
                    isFormValid = false;
                    if (!firstErrorField) firstErrorField = nameInput;
                }
                
                if (!validateNip(nip)) {
                    isFormValid = false;
                    if (!firstErrorField) firstErrorField = nipInput;
                }
                
                if (!validateEmail(email)) {
                    isFormValid = false;
                    if (!firstErrorField) firstErrorField = emailInput;
                }
                
                if (!validatePassword(password)) {
                    isFormValid = false;
                    if (!firstErrorField) firstErrorField = passwordInput;
                }
                
                if (!validatePasswordConfirmation(passwordConfirm)) {
                    isFormValid = false;
                    if (!firstErrorField) firstErrorField = passwordConfirmInput;
                }

                if (!isFormValid) {
                    e.preventDefault();
                    showMessage('Harap perbaiki kesalahan pada form sebelum melanjutkan.', 'error');
                    if (firstErrorField) {
                        firstErrorField.focus();
                        firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    return;
                }

                // Show loading state
                submitBtn.disabled = true;
                submitText.textContent = 'Membuat Akun...';
                submitSpinner.style.display = 'inline-block';
                
                // Update progress to 100%
                progressBar.style.width = '100%';
            });

            // Message display function
            function showMessage(message, type) {
                const container = document.getElementById('message-container');
                const content = document.getElementById('message-content');
                
                content.className = type === 'success' ? 'success-message' : 'error-message';
                content.textContent = message;
                container.style.display = 'block';
                
                // Auto-hide success messages after 5 seconds
                if (type === 'success') {
                    setTimeout(() => {
                        container.style.display = 'none';
                    }, 5000);
                }
                
                // Scroll to message
                container.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }

            // Initial progress update
            updateProgress();
            
            // Auto-focus on name field
            nameInput.focus();
        });
    </script>
</body>
</html>