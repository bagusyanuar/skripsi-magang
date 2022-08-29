<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/bootstrap3.min.css" rel="stylesheet">
    <style>
        .report-title {
            font-size: 14px;
            font-weight: bolder;
        }
        .f-bold {
            font-weight: bold;
        }
        .footer{
            position: fixed;
            bottom: 0cm;
            right: 0cm;
            height: 2cm;
        }
    </style>
</head>
<body>
<br/>
@yield('content')
<hr>
<br>
<div class="row">
    <div class="col-xs-8"></div>
    <div class="col-xs-3">
        <div class="text-center">
            <p class="text-center">Wonogiri, {{ date('Y-m-d') }}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-3">
        <div class="text-center">
        </div>
    </div>
    <div class="col-xs-5"></div>
    <div class="col-xs-3">
        <div class="text-center">
            <p class="text-center">Mengetahui,</p>
        </div>
    </div>
</div>
<br>
<br>
<div class="row">
    <div class="col-xs-3">
        <div class="text-center">
        </div>
    </div>
    <div class="col-xs-5"></div>
    <div class="col-xs-3">
        <div class="text-center">
            <p class="text-center">(Admin Pasar)</p>
        </div>
    </div>
</div>
</body>
</html>
