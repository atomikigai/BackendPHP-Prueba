<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <style>
            *{
                font-family: sans-serif;
            }

           .form-login {
                width: 100%;
                height: 100vh;
                display: flex;
                justify-content:center;
                flex-direction: column;
                align-items:center;
            }

            .form-login form{
                width: 20%;
                display: flex;
                justify-content:center;
                flex-direction: column;
            }

            .form-login label{
                margin-top: 10px;
            }

        </style>
    </head>
    <body>
       <div class="form-login">
            <form method="POST" action="/registro">
                @csrf
                <label>Email</label>
                <input name="email" type="email"/>
                
                <label>Password</label>
                <input name="password" type="password"/>
                <br/>
                <input type="submit" value="Iniciar Sesion"/>
            </form>
       </div>
    </body>
</html>
