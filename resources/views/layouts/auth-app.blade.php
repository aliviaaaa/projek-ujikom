<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rekam Medis App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #009765;
            --secondary-color: #ffffff; 
            --sidebar-bg: #28a745;
            --text-color: #000000;
        }
        body {
            background-color: #f8f9fa;
            color: var(--text-color);
            /* position: relative; */
            margin: 32px;
            align: bottom;
        }
    </style>
</head>
<body>
    <div class="card mt-100px" style="padding: 20px;">
        @yield('content')
    </div>

    <!-- Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
