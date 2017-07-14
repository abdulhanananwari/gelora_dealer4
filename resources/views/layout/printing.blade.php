<!DOCTYPE html>
<html>

    <head>
        <title>@yield('title')</title>
        <script type="text/javascript" src="/standard/jquery/jquery-2.2.0.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/standard/bootstrap-3.3.6-dist/css/bootstrap.min.css">
        <style type="text/css">

            @page {
                size: A4 portrait;
                margin-top: 0px;
            }

            html, body {
                width: 100%;
                font-family: 'Courier' !important;
                font-size: 12px !important;
                letter-spacing: 2px !important;
                margin-top: 0px;
            }
            
            hr {
                margin-bottom: 0;
            }
            
            p {
                margin: 0;
            }

            th {
                padding-left: 7px;
                padding-right: 7px;
            }

            td {
                padding-left: 7px;
                padding-right: 7px;
            }

            .container {
                width: 100%;
                margin-top: 0px;
            }
        </style>
    </head>

    <body>
        <div id="printarea">
            <div class="container">
                @yield('content')
            </div>
        </div>
        <script type="text/javascript">
            window.print();
        </script>
    </body>

</html>
