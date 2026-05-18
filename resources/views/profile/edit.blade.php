@extends('layouts.main')
@section('title', 'DelCafe - Profile')

<section class="profile-page-section">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10 col-xl-9">
                <div class="card profile-card p-3 p-md-4">
                    
                    <h2 class="profile-title">Edit Profil</h2>
                    
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert" style="border-radius: 12px; font-weight: 500; padding: 10px 15px;">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 12px;"></button>
                        </div>
                    @endif

                    <!-- Form Update Profil -->
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mb-0">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 align-items-stretch">
                            <!-- Left Column: Form Fields -->
                            <div class="col-md-7 d-flex flex-column justify-content-between">
                                <div class="mb-2">
                                    <label class="form-label form-label-custom mb-1" for="name">Nama Lengkap</label>
                                    <input type="text" id="name" class="form-control form-control-custom py-2" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <span class="text-danger small mt-1 d-block"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label class="form-label form-label-custom mb-1" for="email">Alamat Email</label>
                                    <input type="email" id="email" class="form-control form-control-custom py-2" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <span class="text-danger small mt-1 d-block"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label class="form-label form-label-custom mb-1" for="password">Kata Sandi Baru</label>
                                    <input type="password" id="password" class="form-control form-control-custom py-2" name="password" placeholder="Kosongkan jika tidak ingin mengganti">
                                    @error('password')
                                        <span class="text-danger small mt-1 d-block"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label class="form-label form-label-custom mb-1" for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                                    <input type="password" id="password_confirmation" class="form-control form-control-custom py-2" name="password_confirmation" placeholder="Konfirmasi sandi baru Anda">
                                </div>
                            </div>

                            <!-- Right Column: Avatar Preview & Upload -->
                            <div class="col-md-5">
                                <div class="avatar-upload-wrapper p-3">
                                    <label class="form-label form-label-custom mb-2">Foto Profil</label>
                                    <div class="avatar-preview-container">
                                        @if($user->profile_picture)
                                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Foto Profil" class="avatar-preview-img">
                                        @else
                                            <img src="{{ asset('assets/img/profil.jpg') }}" alt="Foto Profil Default" class="avatar-preview-img">
                                        @endif
                                    </div>
                                    <p class="text-muted small mb-2 text-center" style="font-size: 0.75rem; line-height: 1.3;">Disarankan foto persegi rasio 1:1 format JPG/PNG</p>
                                    <input type="file" id="profile_picture" class="form-control form-control-custom w-100" name="profile_picture" style="background-color: #ffffff !important; padding: 8px 12px !important; font-size: 0.82rem !important;">
                                    @error('profile_picture')
                                        <span class="text-danger small mt-1 d-block"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Row for Action Buttons -->
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-3 pt-2" style="border-top: 1px solid rgba(0, 0, 0, 0.06);">
                            <a href="{{ route('home') }}" class="btn-secondary-custom py-2 px-4">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn-primary-custom py-2 px-4">
                                Simpan Perubahan <i class="fas fa-save ms-1"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Zona Bahaya (Danger Zone Divider & Section) -->
                    <div class="mt-3 pt-2" style="border-top: 2px dashed rgba(220, 53, 69, 0.12);">
                        <h4 class="danger-zone-title mb-1"><i class="fas fa-exclamation-triangle me-2"></i>Tindakan Keamanan Akun</h4>
                        <div class="d-flex flex-wrap gap-2 align-items-center mt-2">
                            @if($user->profile_picture)
                                <form id="delete-picture-form" method="POST" action="{{ route('profile.remove_picture') }}" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger-outline-custom py-1.5 px-3">
                                        Hapus Foto Profil <i class="fas fa-image-slash ms-1"></i>
                                    </button>
                                </form>
                            @endif

                            <form id="delete-account-form" method="POST" action="{{ route('profile.destroy') }}" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger-custom py-1.5 px-3">
                                    Hapus Akun Permanen <i class="fas fa-user-slash ms-1"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- SweetAlert2 Library CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Check Profile Picture Size (Max 3MB) using SweetAlert2
        const profilePictureInput = document.getElementById('profile_picture');
        if (profilePictureInput) {
            profilePictureInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const fileSize = this.files[0].size; // in bytes
                    const maxSize = 3 * 1024 * 1024; // 3MB in bytes
                    
                    if (fileSize > maxSize) {
                        Swal.fire({
                            title: 'Ukuran File Terlalu Besar',
                            text: 'Ukuran file foto profil tidak boleh melebihi 3 MB! Silakan pilih file yang lebih kecil.',
                            icon: 'error',
                            confirmButtonColor: '#dc3545',
                            confirmButtonText: 'Mengerti',
                            background: '#ffffff',
                            customClass: {
                                popup: 'swal2-premium-popup',
                                title: 'swal2-premium-title',
                                confirmButton: 'swal2-premium-confirm-btn btn-danger-swal'
                            }
                        });
                        this.value = ''; // Reset file input
                    }
                }
            });
        }

        // Intercept Delete Profile Picture Form
        const deletePictureForm = document.getElementById('delete-picture-form');
        if (deletePictureForm) {
            deletePictureForm.addEventListener('submit', function (e) {
                e.preventDefault(); // Stop standard submit
                
                Swal.fire({
                    title: 'Hapus Foto Profil?',
                    text: 'Apakah Anda yakin ingin menghapus foto profil Anda?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    background: '#ffffff',
                    customClass: {
                        popup: 'swal2-premium-popup',
                        title: 'swal2-premium-title',
                        confirmButton: 'swal2-premium-confirm-btn btn-danger-swal',
                        cancelButton: 'swal2-premium-cancel-btn'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        deletePictureForm.submit(); // Force Eloquent form submit
                    }
                });
            });
        }

        // Intercept Delete Account Form
        const deleteAccountForm = document.getElementById('delete-account-form');
        if (deleteAccountForm) {
            deleteAccountForm.addEventListener('submit', function (e) {
                e.preventDefault(); // Stop standard submit
                
                Swal.fire({
                    title: 'Hapus Akun Permanen?',
                    text: 'Tindakan ini tidak dapat dibatalkan! Seluruh riwayat transaksi Anda akan hilang.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus Permanen!',
                    cancelButtonText: 'Batal',
                    background: '#ffffff',
                    customClass: {
                        popup: 'swal2-premium-popup',
                        title: 'swal2-premium-title',
                        confirmButton: 'swal2-premium-confirm-btn btn-danger-swal',
                        cancelButton: 'swal2-premium-cancel-btn'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteAccountForm.submit(); // Force Eloquent form submit
                    }
                });
            });
        }
    });
</script>

<style>
    html, body {
        height: 100% !important;
        margin: 0 !important;
    }

    @media (min-width: 992px) {
        html, body {
            overflow: hidden !important; /* Disables scrollbars completely on desktop */
        }
    }

    body {
        font-family: 'Poppins', sans-serif;
    }

    .profile-page-section {
        position: relative !important;
        background: linear-gradient(135deg, rgba(10, 25, 47, 0.92) 0%, rgba(20, 45, 85, 0.85) 100%), url("{{ asset('assets/img/delcafe.jpg') }}") no-repeat center center/cover !important;
        background-attachment: fixed !important;
        height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 60px !important; /* Top padding to offset the navbar */
    }

    .profile-card {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        position: relative;
        max-height: 85vh; /* Prevents card from going out of screen boundaries */
    }

    .profile-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #0d6efd 0%, #20c997 100%);
    }

    .profile-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: #1e3c72;
        margin-bottom: 15px;
        position: relative;
        display: inline-block;
    }

    .profile-title::after {
        content: '';
        position: absolute;
        width: 40px;
        height: 3px;
        background: #20c997;
        bottom: -4px;
        left: 0;
        border-radius: 2px;
    }

    .form-label-custom {
        font-weight: 600;
        color: #2a5298;
        font-size: 0.85rem;
        margin-bottom: 4px;
    }

    .form-control-custom {
        border-radius: 10px !important;
        border: 1.5px solid #dee2e6 !important;
        padding: 10px 14px !important;
        font-size: 0.9rem !important;
        transition: all 0.2s !important;
        background-color: #f8f9fa !important;
    }

    .form-control-custom:focus {
        border-color: #0d6efd !important;
        background-color: #ffffff !important;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15) !important;
    }

    /* Picture Preview Wrapper */
    .avatar-upload-wrapper {
        border: 1.5px dashed #dee2e6;
        border-radius: 12px;
        background: #fdfdfd;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .avatar-preview-container {
        position: relative;
        margin-bottom: 8px;
    }

    .avatar-preview-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        border: 3.5px solid #ffffff;
        transition: all 0.3s;
    }

    .avatar-preview-img:hover {
        transform: scale(1.03);
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%) !important;
        border: none !important;
        color: #ffffff !important;
        padding: 10px 24px !important;
        border-radius: 50px !important;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s !important;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25) !important;
    }

    .btn-primary-custom:hover {
        box-shadow: 0 6px 18px rgba(13, 110, 253, 0.4) !important;
        transform: translateY(-1.5px) !important;
        color: #ffffff !important;
    }

    .btn-secondary-custom {
        background: rgba(108, 117, 125, 0.08) !important;
        border: 1.5px solid rgba(108, 117, 125, 0.2) !important;
        color: #495057 !important;
        padding: 10px 24px !important;
        border-radius: 50px !important;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s !important;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-secondary-custom:hover {
        background: rgba(108, 117, 125, 0.14) !important;
        color: #212529 !important;
        transform: translateY(-1.5px) !important;
    }

    /* Danger zone buttons */
    .btn-danger-custom {
        background: linear-gradient(135deg, #dc3545 0%, #bd2130 100%) !important;
        border: none !important;
        color: #ffffff !important;
        padding: 8px 20px !important;
        border-radius: 50px !important;
        font-weight: 600 !important;
        font-size: 0.8rem !important;
        transition: all 0.3s !important;
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.2) !important;
    }

    .btn-danger-custom:hover {
        box-shadow: 0 6px 14px rgba(220, 53, 69, 0.35) !important;
        transform: translateY(-1.5px) !important;
        color: #ffffff !important;
    }

    .btn-danger-outline-custom {
        background: transparent !important;
        border: 1.5px solid #dc3545 !important;
        color: #dc3545 !important;
        padding: 6px 18px !important;
        border-radius: 50px !important;
        font-weight: 600 !important;
        font-size: 0.8rem !important;
        transition: all 0.3s !important;
    }

    .btn-danger-outline-custom:hover {
        background: #dc3545 !important;
        color: #ffffff !important;
        transform: translateY(-1.5px) !important;
    }

    .danger-zone-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #dc3545;
    }

    /* SweetAlert2 Premium Overrides */
    .swal2-premium-popup {
        border-radius: 20px !important;
        font-family: 'Poppins', sans-serif !important;
        padding: 24px !important;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
    }

    .swal2-premium-title {
        font-size: 1.25rem !important;
        font-weight: 700 !important;
        color: #1e3c72 !important;
        margin-top: 10px !important;
    }

    .swal2-premium-confirm-btn {
        border-radius: 50px !important;
        padding: 10px 24px !important;
        font-weight: 600 !important;
        font-size: 0.85rem !important;
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.25) !important;
    }

    .swal2-premium-cancel-btn {
        border-radius: 50px !important;
        padding: 10px 24px !important;
        font-weight: 600 !important;
        font-size: 0.85rem !important;
        background-color: #6c757d !important;
        box-shadow: 0 4px 10px rgba(108, 117, 125, 0.25) !important;
    }

    /* Mobile Responsive optimizations */
    @media (max-width: 991.98px) {
        html, body {
            overflow: auto !important; /* Re-enable scrollbars on mobile/tablet devices */
            height: auto !important;
        }
        
        .profile-page-section {
            min-height: 100vh;
            height: auto !important;
            padding: 100px 0 40px 0 !important;
            display: block !important;
        }

        .profile-card {
            max-height: none !important;
        }
        
        .avatar-upload-wrapper {
            margin-top: 15px;
        }
    }
</style>
