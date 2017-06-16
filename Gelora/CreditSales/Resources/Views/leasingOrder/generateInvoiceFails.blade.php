<!DOCTYPE html>
<html>
<head>
    <title>Bukti Tagihan Leasing</title>

    <link rel="stylesheet" type="text/css" href="/standard/bootstrap-3.3.6-dist/css/bootstrap.min.css">


    <style type="text/css">

        .table {
            border-style :  none !important;
            border :  0 !important;
        }

        .layout-table > tbody > tr > td {
            border-top :  0px !important;
            vertical-align :  top;
        }

        p {
            margin :  0;
        }


    </style>

</head>
<body>

<div class="container">

<div class="row">
    <div class="col-sm-12">

        <p>Invoice sudah dicetak sebelumnya. Print ulang tanpa generate due: <a href="{{ $viewData['requestUri'] . '&generate_due=0' }}">klik disini</a></p>
            

    </div>
</div>

</body>
</html>