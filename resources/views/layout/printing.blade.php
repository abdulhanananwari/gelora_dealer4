<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <script type="text/javascript" src="/standard/jquery/jquery-2.2.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/standard/bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <style type="text/css">
    @media print {
        html,
        body {
            width: 100%;
        }
    }
    
    @page {
        size: A4 portrait;
    }
    
    .container {
        width: 100%;
        font-family: 'Courier' !important;
        font-size: 12px !important;
        letter-spacing: 2px !important;
    }
    
    p {
        margin: 0;
    }
    
    th {
        padding-left: 10px;
    }
    
    td {
        padding-left: 10px;
    }
    </style>
</head>

<body>
    <div id="printarea">
        @yield('content')
    </div>
    <script type="text/javascript">
    window.print();
    </script>
</body>

</html>
