<!DOCTYPE html>
<html>

<head>
    <title>Email Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <p>{!! $body !!}</p>
    <a class="btn btn-success" href="{{ $actionLink }}">Verify Email</a>

</body>

</html>
