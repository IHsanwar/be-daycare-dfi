<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login daycare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
}
html, body {
    height: 100%;
    overflow: hidden;
}

body {
    min-height: 100vh;
    display: flex;
    background-color: #f5f5f5;
}

.split-layout {
    display: flex;
    width: 100%;
}
.brand-side {
    display: none;
    flex: 1;
    background: url("https://images.pexels.com/photos/3661351/pexels-photo-3661351.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    padding: 48px;
    
    justify-content: center;
    align-items: center;
    position: relative;
    overflow: hidden;
}
.brand-side h1 {
    
    background: rgba(255, 255, 255, 0.2); /* Semi-transparent white */
    backdrop-filter: blur(10px); /* Glass effect */
    -webkit-backdrop-filter: blur(10px); /* Safari support */
    padding: 16px 24px;
    border-radius: 8px;
    color: white;
    font-size: 24px;
    text-align: center;
    
    /* Add a dark shadow background */
    position: relative;
}

.brand-side h1::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4); /* Dark semi-transparent shadow */
    border-radius: 8px;
    z-index: -1; /* Places the shadow behind the text */
}



@media (min-width: 1024px) {
    .brand-side {
        display: flex;
    }
}

.brand-content {
    position: relative;
    z-index: 1;
    max-width: 480px;
}

.brand-side h1 {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 24px;
}

.brand-side p {
    font-size: 18px;
    line-height: 1.6;
    opacity: 0.9;
}

.login-side {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 48px 32px;
    background: white;
}

.login-container {
    width: 100%;
    max-width: 420px;
}

.login-header {
    text-align: center;
    margin-bottom: 40px;
}

.login-header img {
    width: 48px;
    height: 48px;
    margin-bottom: 24px;
}

.login-header h2 {
    font-size: 24px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 8px;
}

.login-header p {
    color: #6b7280;
    font-size: 16px;
}

.form-group {
    margin-bottom: 24px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 500;
    color: #374151;
}

.form-group input {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.2s;
}

.form-group input:focus {
    outline: none;
    border-color: #4f46e5;
    box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
}

.remember-forgot {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.remember-me {
    display: flex;
    align-items: center;
    gap: 8px;
}

.remember-me input[type="checkbox"] {
    width: 16px;
    height: 16px;
    border-radius: 4px;
}

.remember-me label {
    font-size: 14px;
    color: #4b5563;
}

.forgot-password {
    font-size: 14px;
    color: #4f46e5;
    text-decoration: none;
    font-weight: 500;
}

.forgot-password:hover {
    text-decoration: underline;
}
.btn-register {
    width: 100%;
    padding: 12px;
    background: linear-gradient(144deg, rgba(30,1,121,1)11%, rgba(85,53,131,1)100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    
}

.btn-register:hover {
    background: linear-gradient(144deg, rgb(47, 3, 193)11%, rgb(10, 0, 146)100%);
    transition:ease-in-out 0.3s;
    
}

.divider {
    display: flex;
    align-items: center;
    margin: 24px 0;
    color: #6b7280;
}

.divider::before,
.divider::after {
    content: "";
    flex: 1;
    height: 1px;
    background: #e5e7eb;
}

.divider span {
    padding: 0 16px;
    font-size: 14px;
}

.social-login {
    display: flex;
    gap: 16px;
    margin-bottom: 24px;
}

.social-button {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    background: white;
    color: #374151;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s;
}

.social-button:hover {
    background: #f9fafb;
}

.signup-link {
    text-align: center;
    font-size: 14px;
    color: #6b7280;
}

.signup-link a {
    color: #4f46e5;
    text-decoration: none;
    font-weight: 500;
}

.signup-link a:hover {
    text-decoration: underline;
}
    </style>
    <div class="split-layout">
    <div class="brand-side">
        <div class="brand-content">
            <h1>Selamat Datang di Website Daycare!</h1>
        </div>
    </div>
    <div class="login-side">
        <div class="login-container">
            <div class="login-header">
                <img src="assets/undraw_baby_uoep.svg" width="50px" alt="Logo">
                <h2>Masuk ke akun terlebih dahulu!</h2>
                <p>Masukkan Email dan Password</p>
            </div>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                        <button class="btn-toggle-password" type="button" id="togglePassword">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>
                <div style="height: 20px;"></div>
                <button type="submit" class="btn-register">Login</button>
                <p><a href="register.html">Register</a></p>
            </form>
        </div>
    </div>
</div>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>