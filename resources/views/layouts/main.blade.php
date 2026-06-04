<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body class="d-flex flex-column" style="min-height: 100vh;">
 

    @yield('content')
 
    @if(session('success'))     
    <div class="toast-container position-fixed top-0 end-0 p-3">
         <div class="toast bg-success text-white">
            <div class="toast-body">
         {{ session('success') }}
            </div>
        </div>
    </div>
    @endif
 
    @if(session('error'))
     <div class="toast-container position-fixed top-0 end-0 p-3">
         <div class="toast bg-danger text-white">
            <div class="toast-body">
         {{ session('error') }}
            </div>
        </div>
    </div>
    @endif
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
    <script>
    document.addEventListener("DOMContentLoaded", function(){
        const toastElList = document.querySelectorAll('.toast')
        toastElList.forEach(function(toastEl) {
            const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
            toast.show();
        });
    });
    </script>
</body>
</html>