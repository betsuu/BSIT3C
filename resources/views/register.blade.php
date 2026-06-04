@extends('layouts.main')

@section('content')

<div class="row g-0" style="min-height: 50vh;">

    <div class="col-md-6 d-flex flex-column justify-content-center align-items-start p-5 text-white" style="background-color: #0dcaf0;">
        <div class="mb-3">
            <i class="bi bi-rocket-takeoff-fill" style="font-size: 3rem;"></i>
        </div>
        <h2 class="fw-bold mb-3">Join the RemindMe! Family! 🎊</h2>
        <p class="mb-4" style="font-size: 1.05rem;">
            Sign up for free and let RemindMe! keep you on track. It's fun, fast, and totally free!
        </p>
        <div class="mb-3 p-3 rounded" style="background-color: rgba(255,255,255,0.2); width: 100%;">
            <i class="bi bi-quote" style="font-size: 1.5rem;"></i>
            <p class="mb-1 fst-italic">"I used to forget important deadlines all the time. Now I never miss a thing!"</p>
            <small class="fw-bold">— A happy user</small>
        </div>
        <ul class="list-unstyled" style="font-size: 0.95rem;">
            <li class="mb-2"><i class="bi bi-star-fill me-2 text-warning"></i>100% free to use</li>
            <li class="mb-2"><i class="bi bi-star-fill me-2 text-warning"></i>Set reminders in seconds</li>
            <li class="mb-2"><i class="bi bi-star-fill me-2 text-warning"></i>Stay productive every day</li>
            <li class="mb-2"><i class="bi bi-star-fill me-2 text-warning"></i>Never forget a task again</li>
        </ul>
    </div>

    <div class="col-md-6 d-flex flex-column justify-content-center align-items-center p-5 bg-white">
        <div style="width: 100%; max-width: 400px;">
            <h3 class="text-center fw-bold mb-1">Create an Account</h3>
            <p class="text-center text-muted mb-4" style="font-size: 0.9rem;">It's free and only takes a minute</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/register" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                    <label for="name"><i class="bi bi-person me-1"></i>Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                    <label for="email"><i class="bi bi-envelope me-1"></i>Email</label>
                </div>
                <small class="text-muted mb-2 d-block">Minimum 8 characters</small>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" minlength="8" required>
                    <label for="password"><i class="bi bi-lock me-1"></i>Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="confirmpassword" class="form-control" id="confirmpassword" placeholder="Confirm Password" minlength="8" required>
                    <label for="confirmpassword"><i class="bi bi-lock-fill me-1"></i>Confirm Password</label>
                </div>
                <button class="btn btn-info w-100 text-white fw-bold mb-3" type="submit">Register</button>
                <p class="text-center text-muted mb-0" style="font-size: 0.9rem;">
                    Already have an account? <a href="{{ route('login') }}" class="text-info fw-bold text-decoration-none">Login now</a>
                </p>
            </form>
        </div>
    </div>

</div>

@endsection

@if(session('error') && str_contains(session('error'), 'match') || $errors->has('confirmpassword'))
<script>
    window.addEventListener('DOMContentLoaded', () => showToast());
</script>
@endif

<style>
    .toast-error {
        position: fixed;
        bottom: 1.5rem;
        right: 1.5rem;
        background: linear-gradient(135deg, #e11d48, #be123c);
        color: #fff;
        padding: 0.85rem 1.2rem;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 8px 24px rgba(225,29,72,0.3);
        z-index: 9999;
        opacity: 0;
        transform: translateY(10px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    .toast-error.show { opacity: 1; transform: translateY(0); }
</style>

<div class="toast-error" id="passwordToast">
    <i class="bi bi-exclamation-circle-fill"></i> Passwords do not match.
</div>

<script>
function showToast() {
    const toast = document.getElementById('passwordToast');
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 3500);
}

document.getElementById('confirmpassword').addEventListener('input', function () {
    if (this.value && this.value !== document.getElementById('password').value) {
        showToast();
    }
});
</script>