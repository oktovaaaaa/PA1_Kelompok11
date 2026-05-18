@extends('layouts.main')
@section('title', 'DelCafe - Register')

<section class="login-section">
    <div class="login-container w-100">
        <div class="card login-card shadow-lg">
            <div class="row g-0">
                <!-- Left Side: Image Panel -->
                <div class="col-md-6 d-none d-md-block position-relative">
                    <div class="login-image-overlay"></div>
                    <img src="{{ asset('assets/img/delcafe.jpg') }}" alt="Del Cafe" class="login-image"/>
                    <div class="login-image-text">
                        <h3 class="fw-bold text-white mb-2">Selamat Datang</h3>
                        <p class="text-white-50 mb-0">Nikmati kopi terbaik dan suasana nyaman di Del Cafe.</p>
                    </div>
                </div>
                
                <!-- Right Side: Form Panel -->
                <div class="col-md-6 d-flex align-items-center">
                    <div class="card-body login-form-body p-4">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Logo & Brand -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="brand-icon-wrapper me-3">
                                    <i class="fas fa-mug-hot"></i>
                                </div>
                                <span class="h3 fw-bold mb-0 text-dark brand-text">Del Cafe</span>
                            </div>

                            <h5 class="fw-bold text-dark mb-1">Buat Akun Baru</h5>
                            <p class="text-muted mb-3 small">Silakan lengkapi formulir di bawah ini</p>

                            <!-- Name Field -->
                            <div class="form-group mb-2">
                                <label class="form-label-custom" for="name">Nama Lengkap</label>
                                <div class="input-icon-wrapper">
                                    <i class="far fa-user input-icon"></i>
                                    <input type="text" id="name" class="form-control form-control-custom @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap Anda" required autocomplete="name" autofocus>
                                </div>
                                @error('name')
                                <span class="invalid-feedback d-block mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="form-group mb-2">
                                <label class="form-label-custom" for="email">Alamat Email</label>
                                <div class="input-icon-wrapper">
                                    <i class="far fa-envelope input-icon"></i>
                                    <input type="email" id="email" class="form-control form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autocomplete="email">
                                </div>
                                @error('email')
                                <span class="invalid-feedback d-block mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="form-group mb-2">
                                <label class="form-label-custom" for="password">Kata Sandi</label>
                                <div class="input-icon-wrapper">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" id="password" class="form-control form-control-custom @error('password') is-invalid @enderror" name="password" placeholder="Min. 8 Karakter" required autocomplete="new-password">
                                </div>
                                @error('password')
                                <span class="invalid-feedback d-block mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <!-- Password Confirmation Field -->
                            <div class="form-group mb-2">
                                <label class="form-label-custom" for="password_confirmation">Konfirmasi Kata Sandi</label>
                                <div class="input-icon-wrapper">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" id="password_confirmation" class="form-control form-control-custom" name="password_confirmation" placeholder="Ulangi Kata Sandi" required autocomplete="new-password">
                                </div>
                            </div>

                            <!-- Profile Picture Field -->
                            <div class="form-group mb-3">
                                <label class="form-label-custom" for="profile_picture">Foto Profil</label>
                                <div class="input-icon-wrapper">
                                    <i class="far fa-image input-icon"></i>
                                    <input type="file" id="profile_picture" class="form-control form-control-custom @error('profile_picture') is-invalid @enderror" name="profile_picture">
                                </div>
                                @error('profile_picture')
                                <span class="invalid-feedback d-block mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button class="btn btn-premium-login mb-2.5" type="submit">
                                Daftar Sekarang <i class="fas fa-user-plus ms-2"></i>
                            </button>

                            <!-- Login Link -->
                            <p class="text-center mb-0 small" style="color: #6c757d;">
                                Sudah punya akun? <a href="{{ route('login') }}" class="register-link">Masuk di sini</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Reset HTML & Body */
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        height: 100% !important;
        overflow: hidden !important;
    }

    /* Premium Register Styles */
    .login-section {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        height: 100vh !important;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
        overflow: hidden !important;
    }

    .login-container {
        width: 100%;
        padding: 0 15px;
        box-sizing: border-box;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .login-card {
        border: none !important;
        border-radius: 24px !important;
        overflow: hidden;
        max-width: 850px;
        width: 100%;
        background: #ffffff;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15) !important;
        margin: auto;
    }

    /* Left Image Panel Styles */
    .login-image {
        height: 100%;
        width: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
    }

    .login-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(30, 60, 114, 0.3) 0%, rgba(42, 82, 152, 0.8) 100%);
        z-index: 1;
    }

    .login-image-text {
        position: absolute;
        bottom: 30px;
        left: 25px;
        right: 25px;
        z-index: 2;
    }

    /* Form Styles */
    .login-form-body {
        background: #ffffff;
    }

    .brand-icon-wrapper {
        width: 38px;
        height: 38px;
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
    }

    .brand-text {
        font-family: 'Poppins', sans-serif;
        letter-spacing: 0.5px;
        color: #1e3c72 !important;
    }

    /* Input Styling */
    .form-label-custom {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #495057;
        margin-bottom: 4px;
        display: block;
    }

    .input-icon-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
        font-size: 0.9rem;
        transition: color 0.3s;
    }

    .form-control-custom {
        border-radius: 10px !important;
        border: 1px solid #dee2e6 !important;
        padding: 8px 14px 8px 38px !important;
        font-size: 0.85rem !important;
        color: #212529 !important;
        background-color: #f8f9fa !important;
        transition: all 0.3s !important;
        box-shadow: none !important;
    }

    .form-control-custom:focus {
        background-color: #ffffff !important;
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.12) !important;
    }

    .form-control-custom:focus + .input-icon {
        color: #0d6efd;
    }

    /* Buttons Styling */
    .btn-premium-login {
        background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%) !important;
        border: none !important;
        color: #ffffff !important;
        border-radius: 10px !important;
        width: 100%;
        padding: 10px !important;
        font-weight: 600 !important;
        font-size: 0.9rem !important;
        transition: all 0.3s !important;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.15) !important;
    }

    .btn-premium-login:hover {
        box-shadow: 0 6px 18px rgba(13, 110, 253, 0.3) !important;
        transform: translateY(-1px) !important;
    }

    .register-link {
        color: #0d6efd !important;
        font-weight: 600;
        text-decoration: none !important;
        transition: color 0.3s;
    }

    .register-link:hover {
        color: #0056b3 !important;
    }

    /* Mobile Responsive / Enable scroll ONLY on tiny screens/mobile where content overflows height */
    @media (max-width: 768px) {
        html, body {
            overflow: auto !important;
            height: auto !important;
        }

        .login-section {
            height: auto !important;
            min-height: 100vh !important;
            padding: 30px 0 !important;
        }

        .login-card {
            border-radius: 16px !important;
            margin: 10px;
        }
        
        .login-form-body {
            padding: 24px 16px !important;
        }
    }

    /* Support desktop scroll if viewport height is too small (< 750px) to prevent cutting off fields */
    @media (min-width: 769px) and (max-height: 750px) {
        html, body {
            overflow: auto !important;
            height: auto !important;
        }

        .login-section {
            height: auto !important;
            min-height: 100vh !important;
            padding: 40px 0 !important;
        }
    }
</style>
