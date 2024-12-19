@extends('layouts.dashboard')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parsed Data</title>
</head>
<body>
    <h1>Data yang Diterima</h1>
    <h5>Nama Lengkap: {{ $name }}</h5>
    <h5>Email: {{ $email }}</h5>
</body>
</html>
@endsection
