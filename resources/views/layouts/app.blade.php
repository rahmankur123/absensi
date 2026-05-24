<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <title>BD Camp - Sistem Monitoring Atlet</title>

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <style>

        *{
            font-family:'Plus Jakarta Sans', sans-serif;
        }

        :root{

            --sidebar-width:270px;

            --bg:#f8fafc;
            --card:#ffffff;

            --primary:#0ea5e9;
            --secondary:#6366f1;

            --text:#0f172a;
            --muted:#64748b;
            --border:#e2e8f0;
        }

        body{
            margin:0;
            background:var(--bg);
            overflow:hidden;
        }

        /* SIDEBAR */
        .sidebar{
            width:var(--sidebar-width);
            height:100vh;

            position:fixed;
            left:0;
            top:0;

            z-index:1000;
        }

        /* CONTENT */
        .content{
            margin-left:var(--sidebar-width);

            height:100vh;

            display:flex;
            flex-direction:column;

            overflow:hidden;
        }

        /* HEADER */
        .header-wrapper{

            background:
                rgba(255,255,255,0.7);

            backdrop-filter:blur(14px);

            border-bottom:
                1px solid rgba(226,232,240,0.8);

            padding:16px 28px;

            position:sticky;
            top:0;

            z-index:999;
        }

        /* MAIN CONTENT */
        .main-content{

            flex:1;

            overflow-y:auto;

            padding:28px;

            scroll-behavior:smooth;

            background:
                linear-gradient(
                    to bottom,
                    #f8fafc,
                    #f1f5f9
                );
        }

        .main-content::-webkit-scrollbar{
            width:8px;
        }

        .main-content::-webkit-scrollbar-thumb{
            background:#cbd5e1;
            border-radius:20px;
        }

        /* CARD STYLE GLOBAL */
        .custom-card{

            background:white;

            border:none;

            border-radius:24px;

            padding:24px;

            box-shadow:
                0 4px 20px rgba(15,23,42,0.04);

            transition:0.3s;
        }

        .custom-card:hover{
            transform:translateY(-2px);

            box-shadow:
                0 10px 35px rgba(15,23,42,0.08);
        }

        /* FOOTER */
        .footer{

            background:
                rgba(255,255,255,0.75);

            backdrop-filter:blur(10px);

            border-top:
                1px solid var(--border);

            padding:14px;

            text-align:center;

            color:var(--muted);

            font-size:14px;
        }

        /* TABLE MODERN */
        .table{
            border-collapse:separate;
            border-spacing:0 10px;
        }

        .table thead th{
            border:none;
            color:var(--muted);
            font-weight:600;
            font-size:13px;
        }

        .table tbody tr{

            background:white;

            box-shadow:
                0 2px 8px rgba(15,23,42,0.03);
        }

        .table tbody td{
            border:none;
            padding:18px 16px;
            vertical-align:middle;
        }

        .table tbody tr td:first-child{
            border-radius:14px 0 0 14px;
        }

        .table tbody tr td:last-child{
            border-radius:0 14px 14px 0;
        }

        /* BUTTON MODERN */
        .btn-primary{

            border:none;

            border-radius:14px;

            background:
                linear-gradient(
                    135deg,
                    var(--primary),
                    var(--secondary)
                );

            padding:10px 18px;

            font-weight:600;
        }

        .btn-primary:hover{
            transform:translateY(-1px);
        }

        /* RESPONSIVE */
        @media(max-width:992px){

            .sidebar{
                transform:translateX(-100%);
            }

            .content{
                margin-left:0;
            }

            .main-content{
                padding:18px;
            }

            .a{
                text-decoration:none;
            }
        }

    </style>

</head>

<body>

    <!-- SIDEBAR -->
    @include('layouts.sidebar')


    <!-- CONTENT -->
    <div class="content">

        <!-- HEADER -->
        <div class="header-wrapper">
            @include('layouts.header')
        </div>


        <!-- MAIN -->
        <div class="main-content">

            @yield('content')

        </div>


        <!-- FOOTER -->
        <div class="footer">

            @include('layouts.footer')

        </div>

    </div>

</body>
</html>