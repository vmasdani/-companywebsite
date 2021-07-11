<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Payment - Admin | Company Name</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />

</head>

<body>
    {{ view('nbar',  ['baseUrl' => env('BASE_URL')]) }}

    <div class="m-3">
        <h1>Payment - Admin</h1>
    </div>

    <hr />

</body>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


</html>