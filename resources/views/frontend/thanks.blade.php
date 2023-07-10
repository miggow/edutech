<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cảm ơn</title>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
</head>

<body>
    <div class="body2">
        <header class="header1">
            <h1>Cảm ơn đã mua hàng!</h1>
        </header>
        <div class="message1">
            <p>Cảm ơn bạn đã mua khóa học của chúng tôi.</p>
        </div>
        <a href="{{ route('order.index') }}">Khóa học của bạn</a>
    </div>
</body>

</html>
