@extends('layouts.user_template')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@500&display=swap');

    .profile-wrapper {
        font-family: 'DM Sans', sans-serif;
        padding: 2rem;
    }

    .profile-page-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.75rem;
    }

    .profile-page-header h4 {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }

    .profile-page-header h4 i { color: #0dcaf0; }

    /* ── Left card ── */
    .profile-pic-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(15, 23, 42, 0.08);
        border: 1px solid #e2e8f0;
        padding: 2rem 1.5rem;
        text-align: center;
    }

    .profile-avatar-wrap {
        position: relative;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .profile-avatar-wrap img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid transparent;
        background: linear-gradient(#fff, #fff) padding-box,
                    linear-gradient(135deg, #0dcaf0, #0d6efd) border-box;
    }

    .profile-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.15rem;
    }

    .profile-email {
        font-size: 0.8rem;
        color: #94a3b8;
        margin-bottom: 1.25rem;
    }

    .profile-divider {
        border: none;
        border-top: 1px solid #f1f5f9;
        margin: 1.25rem 0;
    }

    .upload-label {
        display: block;
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #94a3b8;
        margin-bottom: 0.6rem;
    }

    .file-input-wrap {
        border: 1.5px dashed #bae6fd;
        border-radius: 10px;
        background: #f0f9ff;
        padding: 0.6rem 0.75rem;
        margin-bottom: 1rem;
    }

    .file-input-wrap input[type="file"] {
        font-size: 0.8rem;
        color: #475569;
        font-family: 'DM Sans', sans-serif;
        width: 100%;
    }

    .btn-update-photo {
        width: 100%;
        background: linear-gradient(135deg, #0dcaf0, #0d6efd);
        color: #fff;
        border: none;
        padding: 0.65rem 1rem;
        border-radius: 10px;
        font-size: 0.875rem;
        font-weight: 700;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        transition: opacity 0.15s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
    }

    .btn-update-photo:hover { opacity: 0.88; }

    /* ── Right card ── */
    .profile-info-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(15, 23, 42, 0.08);
        border: 1px solid #e2e8f0;
        padding: 1.75rem;
    }

    .info-card-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        margin-bottom: 1.5rem;
    }

    .info-card-title i { color: #0dcaf0; }

    .form-row {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        gap: 1rem;
    }

    .form-row-label {
        width: 130px;
        flex-shrink: 0;
        font-size: 0.78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #64748b;
    }

    .form-row-input {
        flex: 1;
    }

    .modal-input {
        width: 100%;
        border: 1.5px solid #e2e8f0;
        border-radius: 9px;
        padding: 0.55rem 0.85rem;
        font-size: 0.875rem;
        color: #0f172a;
        font-family: 'DM Sans', sans-serif;
        transition: border-color 0.15s;
        outline: none;
        background: #f8fafc;
    }

    .modal-input:focus { border-color: #0dcaf0; background: #fff; }

    textarea.modal-input { resize: vertical; min-height: 80px; }

    .btn-save {
        width: 100%;
        background: linear-gradient(135deg, #0dcaf0, #0d6efd);
        color: #fff;
        border: none;
        padding: 0.7rem 1rem;
        border-radius: 10px;
        font-size: 0.875rem;
        font-weight: 700;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        transition: opacity 0.15s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        margin-top: 0.5rem;
    }

    .btn-save:hover { opacity: 0.88; }

    .change-password-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(15, 23, 42, 0.08);
        border: 1px solid #e2e8f0;
        padding: 1.75rem;
        margin-top: 1.5rem;
    }
</style>

<div class="profile-wrapper">

    <div class="profile-page-header">
        <h4><i class="bi bi-person-circle"></i> My Profile</h4>
    </div>

    <div class="row g-4">

        {{-- Left: Avatar + Photo Upload --}}
        <div class="col-md-4">
            <div class="profile-pic-card">
                <div class="profile-avatar-wrap">
                    @if(session('user')->profile_pic)
                        <img src="/uploads/{{ session('user')->profile_pic }}" alt="Profile Photo">
                    @else
                        <img src="/image/default.jpg" alt="Profile Photo">
                    @endif
                </div>

                <div class="profile-name">{{ session('user')->name }}</div>
                <div class="profile-email">{{ session('user')->email }}</div>

                <hr class="profile-divider">

                <form action="/updateProfile" method="POST" enctype="multipart/form-data">
                    @csrf
                    <span class="upload-label"><i class="bi bi-camera-fill"></i> Change Profile Picture</span>
                    <div class="file-input-wrap">
                        <input type="file" name="profile_pic" accept="image/*">
                    </div>

                    <input type="hidden" name="name"     value="{{ session('user')->name }}">
                    <input type="hidden" name="email"    value="{{ session('user')->email }}">
                    <input type="hidden" name="address"  value="{{ session('user')->address }}">
                    <input type="hidden" name="birthday" value="{{ session('user')->birthday }}">
                    <input type="hidden" name="gender"   value="{{ session('user')->gender }}">
                    <input type="hidden" name="bio"      value="{{ session('user')->bio }}">

                    <button type="submit" class="btn-update-photo">
                        <i class="bi bi-camera-fill"></i> Update Photo
                    </button>
                </form>
            </div>
        </div>

        {{-- Right: Profile Info Form --}}
        <div class="col-md-8">
            <div class="profile-info-card">
                <div class="info-card-title">
                    <i class="bi bi-person-lines-fill"></i> Profile Information
                </div>

                <form action="/updateProfile" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="keep_profile_pic" value="1">

                    <div class="form-row">
                        <div class="form-row-label">Name</div>
                        <div class="form-row-input">
                            <input type="text" name="name" class="modal-input"
                                   value="{{ session('user')->name }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-row-label">Email</div>
                        <div class="form-row-input">
                            <input type="email" name="email" class="modal-input"
                                   value="{{ session('user')->email }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-row-label">Address</div>
                        <div class="form-row-input">
                            <input type="text" name="address" class="modal-input"
                                   value="{{ session('user')->address }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-row-label">Birthday</div>
                        <div class="form-row-input">
                            <input type="date" name="birthday" class="modal-input"
                                   value="{{ session('user')->birthday }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-row-label">Gender</div>
                        <div class="form-row-input">
                            <select name="gender" class="modal-input">
                                <option value="">-- Select Gender --</option>
                                <option value="male"   {{ session('user')->gender == 'male'   ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ session('user')->gender == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other"  {{ session('user')->gender == 'other'  ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row" style="align-items: flex-start;">
                        <div class="form-row-label" style="padding-top: 0.5rem;">Bio / About me</div>
                        <div class="form-row-input">
                            <textarea name="bio" class="modal-input">{{ session('user')->bio }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn-save">
                        <i class="bi bi-floppy-fill"></i> Save Changes
                    </button>
                </form>
            </div>
        </div>

        {{-- Change Password Button --}}
        <div class="col-md-4">
            <div class="change-password-card">
                <button type="button" class="btn-update-photo" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                    <i class="bi bi-shield-lock-fill"></i> Change Password
                </button>
            </div>
        </div>

    </div>
</div>

{{-- Change Password Modal --}}
<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 60px rgba(15,23,42,0.18);">
            <form action="/changePassword" method="POST">
                @csrf
                <div style="background: linear-gradient(135deg, #0dcaf0, #0d6efd); padding: 1.25rem 1.5rem 1rem; display: flex; align-items: flex-start; justify-content: space-between;">
                    <div>
                        <div style="font-size:1.1rem; font-weight:700; color:#fff; display:flex; align-items:center; gap:0.4rem; font-family:'DM Sans',sans-serif;">
                            <i class="bi bi-shield-lock-fill"></i> Change Password
                        </div>
                        <div style="font-size:0.8rem; color:rgba(255,255,255,0.8); font-family:'DM Sans',sans-serif;">Update your account password</div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" style="filter:brightness(0) invert(1); opacity:0.8;"></button>
                </div>
                <div style="padding: 1.25rem 1.5rem; font-family:'DM Sans',sans-serif;">
                    @if(session('pw_error'))
                        <div class="alert alert-danger py-2 mb-3" style="font-size:0.8rem">{{ session('pw_error') }}</div>
                    @endif
                    @if(session('pw_success'))
                        <div class="alert alert-success py-2 mb-3" style="font-size:0.8rem">{{ session('pw_success') }}</div>
                    @endif
                    <div class="mb-3">
                        <label class="upload-label"><i class="bi bi-lock"></i> Current Password</label>
                        <input type="password" name="current_password" class="modal-input" placeholder="Enter current password" required>
                    </div>
                    <div class="mb-3">
                        <label class="upload-label"><i class="bi bi-lock-fill"></i> New Password</label>
                        <input type="password" name="new_password" class="modal-input" placeholder="Min. 8 characters" minlength="8" required>
                    </div>
                    <div class="mb-1">
                        <label class="upload-label"><i class="bi bi-lock-fill"></i> Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" class="modal-input" placeholder="Re-enter new password" minlength="8" required>
                    </div>
                </div>
                <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9; display:flex; gap:0.5rem;">
                    <button type="submit" class="btn-update-photo" style="flex:1;">
                        <i class="bi bi-shield-lock-fill"></i> Update Password
                    </button>
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal" style="background:#f1f5f9; color:#64748b; border:none; padding:0.65rem 1.1rem; border-radius:9px; font-size:0.875rem; font-weight:600; cursor:pointer; font-family:'DM Sans',sans-serif;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(session('pw_error') || session('pw_success'))
<script>window.addEventListener('DOMContentLoaded', () => new bootstrap.Modal(document.getElementById('changePasswordModal')).show());</script>
@endif

@endsection