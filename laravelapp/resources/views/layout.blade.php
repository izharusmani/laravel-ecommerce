<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="header">
        @section('header')
        @show
    </div>
    <div class="content">
        @section('content')
        @show
    </div>
    <div class="foot">
        @section('footer')
        @show
    </div>
</body>
</html>