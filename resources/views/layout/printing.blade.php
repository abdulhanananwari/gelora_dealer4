<!DOCTYPE html>
<html>

    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" type="text/css" href="/standard/bootstrap-3.3.6-dist/css/bootstrap.min.css">
        <style type="text/css">

            @page {
                size: A4 portrait;
            }

            html, body {
                width: 100%;
            }
            
            hr {
                margin-bottom: 0;
            }
            
            p {
                margin: 0 !important;
                padding: 0 !important;
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
                font-family: 'Courier' !important;
                font-size: 13px !important;
                letter-spacing: 2px !important;
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
