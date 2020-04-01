<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="{{mix('/css/App.css')}}" type="text/css" rel="stylesheet"/>
    <title>Innoscripta pizza</title>
</head>
<body>
<div id="root"></div>
<script src="{{mix('/js/App.js')}}"></script>
</body>
</html>
