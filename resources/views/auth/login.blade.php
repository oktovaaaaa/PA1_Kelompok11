@extends('layouts.main')
@section('title', 'DelCafe - Login')

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
                    <div class="card-body login-form-body p-4 p-lg-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Logo & Brand -->
                            <div class="d-flex align-items-center mb-4">
                                <div class="brand-icon-wrapper me-3">
                                    <i class="fas fa-mug-hot"></i>
                                </div>
                                <span class="h2 fw-bold mb-0 text-dark brand-text">Del Cafe</span>
                            </div>

                            <h5 class="fw-bold text-dark mb-1">Masuk ke Akun Anda</h5>
                            <p class="text-muted mb-4 small">Silakan masukkan email dan kata sandi Anda</p>

                            <!-- Email Field -->
                            <div class="form-group mb-3">
                                <label class="form-label-custom" for="email">Alamat Email</label>
                                <div class="input-icon-wrapper">
                                    <i class="far fa-envelope input-icon"></i>
                                    <input type="email" id="email" class="form-control form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autocomplete="email" autofocus>
                                </div>
                                @error('email')
                                <span class="invalid-feedback d-block mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="form-group mb-4">
                                <label class="form-label-custom" for="password">Kata Sandi</label>
                                <div class="input-icon-wrapper">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" id="password" class="form-control form-control-custom @error('password') is-invalid @enderror" name="password" placeholder="••••••••" required autocomplete="current-password">
                                </div>
                                @error('password')
                                <span class="invalid-feedback d-block mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button class="btn btn-premium-login mb-3" type="submit">
                                Masuk <i class="fas fa-sign-in-alt ms-2"></i>
                            </button>

                            <!-- Register Link -->
                            <p class="text-center mb-4 small" style="color: #6c757d;">
                                Belum punya akun? <a href="{{ route('register') }}" class="register-link">Daftar di sini</a>
                            </p>
                        </form>
                        
                        <!-- Back Button -->
                        <div class="text-center">
                            <a href="{{ url('') }}" class="btn btn-outlined-custom" role="button">
                                <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                            </a>
                        </div>
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

    /* Premium Login Styles */
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
        max-width: 800px;
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
        bottom: 40px;
        left: 30px;
        right: 30px;
        z-index: 2;
    }

    /* Form Styles */
    .login-form-body {
        background: #ffffff;
    }

    .brand-icon-wrapper {
        width: 42px;
        height: 42px;
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .brand-text {
        font-family: 'Poppins', sans-serif;
        letter-spacing: 0.5px;
        color: #1e3c72 !important;
    }

    /* Input Styling */
    .form-label-custom {
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #495057;
        margin-bottom: 6px;
        display: block;
    }

    .input-icon-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
        font-size: 0.95rem;
        transition: color 0.3s;
    }

    .form-control-custom {
        border-radius: 12px !important;
        border: 1px solid #dee2e6 !important;
        padding: 10px 16px 10px 42px !important;
        font-size: 0.9rem !important;
        color: #212529 !important;
        background-color: #f8f9fa !important;
        transition: all 0.3s !important;
        box-shadow: none !important;
    }

    .form-control-custom:focus {
        background-color: #ffffff !important;
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15) !important;
    }

    .form-control-custom:focus + .input-icon {
        color: #0d6efd;
    }

    /* Buttons Styling */
    .btn-premium-login {
        background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%) !important;
        border: none !important;
        color: #ffffff !important;
        border-radius: 12px !important;
        width: 100%;
        padding: 12px !important;
        font-weight: 600 !important;
        font-size: 0.95rem !important;
        transition: all 0.3s !important;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2) !important;
    }

    .btn-premium-login:hover {
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.35) !important;
        transform: translateY(-1px) !important;
    }

    .btn-premium-login:active {
        transform: translateY(1px) !important;
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

    .btn-outlined-custom {
        background: transparent !important;
        border: 1px solid #dee2e6 !important;
        color: #6c757d !important;
        border-radius: 12px !important;
        padding: 8px 16px !important;
        font-size: 0.85rem !important;
        font-weight: 600 !important;
        transition: all 0.3s !important;
    }

    .btn-outlined-custom:hover {
        background: #f8f9fa !important;
        color: #212529 !important;
        border-color: #ced4da !important;
    }

    /* Mobile Responsive adjustments / Enable scroll only on mobile */
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
            padding: 30px 20px !important;
        }
    }

    /* Support desktop scroll if viewport height is too small (< 650px) to prevent cutting off fields */
    @media (min-width: 769px) and (max-height: 650px) {
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
