<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>RealEstate Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/9bbe65fc88.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .custom-bg-gray {
    
    box-shadow: 0 5px 6px rgba(0, 0, 0, 0.1);
}
 /* CSS for avatar positioning */
 .ml-auto {
        margin-left: 76.5%; /* Pushes the avatar to the right */
    }

    /* Style for the avatar image */
    .avatar-img {
        width: 40px; /* Adjust the width as needed */
        height: 40px; /* Adjust the height as needed */
        border-radius: 50%; /* Makes it a circular avatar */
    }
    .dropdown-menu.left {
        right: 0;
        left: auto;
    }
    .pagination-container {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 999; /* Ensure it's above other content */
    }
    .ml-auto-0 {
        margin-left: 81%; /* Pushes the avatar to the right */
    }
    .avatar-img-0 {
        width: 40px; /* Adjust the width as needed */
        height: 40px; /* Adjust the height as needed */
        border-radius: 50%; /* Makes it a circular avatar */
    }
    .small-logo {
    width: 30px; /* Adjust the width as needed */
    height: auto; /* Maintain aspect ratio */
}
.ml-auto-1 {
        margin-right: 11.2%; /* Pushes the avatar to the left */
        margin-left: 10px;
    }
    </style>

</head>
<body class="sb-nav-fixed">
@include('partiel.header')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="container">
                
                @yield('content')
            </div>
       
</div>
</main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
const notificationItems = document.querySelectorAll('.notification-item');

notificationItems.forEach((item) => {
item.addEventListener('mouseover', function () {
const notificationId = this.getAttribute('data-notification-id');

// Make an AJAX request to mark the notification as read
axios.post(`/notifications/mark-as-read/${notificationId}`)
    .then((response) => {
        // Handle the success response if needed
        console.log('Notification marked as read:', response.data);
    })
    .catch((error) => {
        // Handle any errors that occur during the request
        console.error('Error marking notification as read:', error);
    });
});
});
});

</script>
</html>
