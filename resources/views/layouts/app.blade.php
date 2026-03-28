<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Monitoring Atlet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            overflow: hidden; /* biar body ga scroll */
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #1e293b;
            color: white;
        }

        .content {
            margin-left: 250px;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
            overflow-y: auto;
            background: #f1f5f9;
            padding: 20px;
            scroll-behavior: smooth;
        }

        .footer {
            background: white;
            padding: 10px;
            text-align: center;
            border-top: 1px solid #ddd;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover {
            background: #334155;
        }
    </style>
</head>
<body>

    @include('layouts.sidebar')

    <div class="content">

        @include('layouts.header')

        <div class="main-content">
            @yield('content')
        </div>

        <div class="footer">
            @include('layouts.footer')
        </div>

    </div>

</body>
</html>