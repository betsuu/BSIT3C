<nav class="navbar navbar-expand-lg navbar-info bg-info">
    <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="">
             <img src="/uploads/logo.png" height="40" width="40" 
         style="object-fit: cover; border-radius: 50%;" alt="Logo">Reminders List</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <div class="ms-auto">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item"></li>
                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a><hr>
                <a class="nav-link" href="{{ route('user') }}">Users</a><hr>
                <a class="nav-link me-2" href="{{ route('todo') }}">Reminders</a><hr>
        
             <div class="dropdown">
                @if(session('user'))
                <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ session('user')->name }}
                </button>
                @endif
        <ul class="dropdown-menu dropdown-menu-end p-0">
            <li><a class="dropdown-item mt-2" href="{{ route('profile') }}">Profile</a></li><hr>
            <li><a class="dropdown-item mb-2" href="/logout">Log out</a></li>
        </ul>
        </div>
        </ul>
      </div>
    </div>  
</nav>        