<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Verifacion</title>
    </head>
    <body>
       <div>
            <h4>{{ $mailData['title'] }}</h4>
            <p>{{ $mailData['body'] }}</p>
       </div>
    </body>
</html>
