@extends('layouts.main')

@section('content')

<div class="row g-0" style="min-height: 100vh;">

    <div class="col-md-6 d-flex flex-column justify-content-center align-items-start p-5 text-white" style="background-color: #0dcaf0;">
        <div class="mb-3">
            <i class="bi bi-bell-fill" style="font-size: 3rem;"></i>
        </div>
        <h2 class="fw-bold mb-3">RemindMe!</h2>
        <p class="mb-3" style="font-size: 1.05rem;">
            Your fun & easy reminder buddy. Never forget a thing — RemindMe!'s got your back! 🎉
        </p>
        <ul class="list-unstyled" style="font-size: 0.95rem;">
            <li class="mb-2"><i class="bi bi-check-circle-fill me-2"></i>Create and manage reminders easily</li>
            <li class="mb-2"><i class="bi bi-check-circle-fill me-2"></i>Keep track of your to-do list</li>
            <li class="mb-2"><i class="bi bi-check-circle-fill me-2"></i>Never miss an important task again</li>
            <li class="mb-2"><i class="bi bi-check-circle-fill me-2"></i>Simple, fast, and easy to use</li>
        </ul>
    </div>

    <div class="col-md-6 d-flex flex-column justify-content-center align-items-center p-5 bg-white">
        <div style="width: 100%; max-width: 400px;">
            <h3 class="text-center fw-bold mb-1">Welcome Back!</h3>
            <p class="text-center text-muted mb-4" style="font-size: 0.9rem;">Login to your account</p>
            <form action="/login" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                    <label for="email"><i class="bi bi-envelope me-1"></i>Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    <label for="password"><i class="bi bi-lock me-1"></i>Password</label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                    <label class="form-check-label text-muted" for="checkDefault">Remember Password</label>
                </div>
                <button class="btn btn-info w-100 text-white fw-bold mb-3" type="submit">Login</button>
                <p class="text-center text-muted mb-0" style="font-size: 0.9rem;">
                    Don't have an account? <a href="{{ route('register') }}" class="text-info fw-bold text-decoration-none">Register Now</a>
                </p>
            </form>
        </div>
    </div>

</div>

@endsection