<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Your head content -->
</head>
<body>
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
</body>
</html>