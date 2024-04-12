
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel QR Blog</title>

</head>

<body class="antialiased">
<div>
    {!! QrCode::generate('https://www.facebook.com/') !!}
</div>
</body>

</html>
