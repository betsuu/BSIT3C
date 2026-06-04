<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RemindMe!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        html, body { height: 100%; margin: 0; padding: 0; }

        #sidebar {
            width: 240px;
            min-height: 100vh;
            background-color: #0dcaf0;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: width 0.2s;
        }

        #sidebar .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.3);
            text-decoration: none;
        }

        #sidebar .brand img {
            width: 40px; height: 40px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }

        #sidebar .brand span {
            color: white;
            font-weight: 700;
            font-size: 1rem;
            white-space: nowrap;
        }

        #sidebar .nav-links {
            flex: 1;
            padding: 16px 0;
        }

        #sidebar .nav-links a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            font-size: 0.95rem;
            transition: background 0.15s;
            border-left: 3px solid transparent;
        }

        #sidebar .nav-links a:hover,
        #sidebar .nav-links a.active {
            background-color: rgba(255,255,255,0.2);
            border-left: 3px solid white;
        }

        #sidebar .nav-links a i {
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        #sidebar .user-section {
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,0.3);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.15);
            border-radius: 12px;
            padding: 10px 12px;
            cursor: pointer;
            transition: background 0.15s;
            border: none;
            width: 100%;
            color: white;
            text-align: left;
        }

        .user-card:hover { background: rgba(255,255,255,0.25); }

        .user-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: white;
            color: #0dcaf0;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .user-info { flex: 1; overflow: hidden; }
        .user-info .user-name { font-size: 0.88rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-info .user-role { font-size: 0.75rem; opacity: 0.75; }

        .user-dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            overflow: hidden;
            min-width: 180px;
            padding: 6px;
        }

        .user-dropdown-menu .dropdown-item {
            border-radius: 8px;
            padding: 9px 14px;
            font-size: 0.88rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.12s;
        }

        .user-dropdown-menu .dropdown-item:hover { background: #f0f9ff; color: #0dcaf0; }
        .user-dropdown-menu .dropdown-item.text-danger:hover { background: #fff0f0; color: #dc3545; }
        .user-dropdown-menu hr { margin: 4px 0; opacity: 0.1; }

        #main-content {
            margin-left: 240px;
            min-height: 100vh;
            background-color: #f8f9fa;
            transition: margin-left 0.2s;
        }

        @media (max-width: 768px) {
            #sidebar { width: 60px; }
            #sidebar .brand span,
            #sidebar .nav-links a span,
            #sidebar .user-section .user-name { display: none; }
            #main-content { margin-left: 60px; }
        }
    </style>
</head>
<body>


    <div id="sidebar">
        <a class="brand" href="">
            <img src="/uploads/logo.png" alt="Logo">
            <span>RemindMe!</span>
        </a>

        <div class="nav-links">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('user') }}" class="{{ request()->routeIs('user') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Users</span>
            </a>
            <a href="{{ route('todo') }}" class="{{ request()->routeIs('todo') ? 'active' : '' }}">
                <i class="bi bi-bell-fill"></i>
                <span>Reminders</span>
            </a>
        </div>

        <div class="user-section">
            <div class="dropdown dropup">
                <button class="user-card" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-avatar">
                        {{ strtoupper(substr(session('user')->name, 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ session('user')->name }}</div>
                        <div class="user-role">My Account</div>
                    </div>
                    <i class="bi bi-chevron-up" style="font-size:0.75rem; opacity:0.7;"></i>
                </button>
                <ul class="dropdown-menu user-dropdown-menu mb-2">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <i class="bi bi-person-circle text-info"></i> Profile
                        </a>
                    </li>
                    <hr>
                    <li>
                        <a class="dropdown-item text-danger" href="/logout">
                            <i class="bi bi-box-arrow-right"></i> Log out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="main-content">
        @yield('content')
    </div>

    @if(session('success'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div class="toast bg-success text-white">
            <div class="toast-body">{{ session('success') }}</div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div class="toast bg-danger text-white">
            <div class="toast-body">{{ session('error') }}</div>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function(){
        document.querySelectorAll('.toast').forEach(function(toastEl) {
            new bootstrap.Toast(toastEl, { delay: 3000 }).show();
        });
    });
    </script>
    @yield('scripts')
</body>
</html>