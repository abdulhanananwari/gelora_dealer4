<html>

<head>
    <title>Redirecting Ke Penjualan</title>
</head>

<body>
    <p>Mentransfer ke {{ $viewData['id'] }} ... </p>
    <script type="text/javascript">
        var jwt = localStorage.getItem('solumax_jwt_token')
        window.location = "{!! $viewData['link'] !!}" + jwt
    </script>
</body>

</html>
