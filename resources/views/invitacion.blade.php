<?php

    $emailvalue = "";
    $registered = false;
    $errorvalue = false;
    $empty = false;

    if(!empty($email)){
        $emailvalue = $email;
    }

    if(isset($isregistered)){
        $registered = $isregistered;
    }

    if(isset($error)){
        $errorvalue = $error;
    }

    if(isset($emptyvalues)){
        $empty = $emptyvalues;
    }

    
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Invitacion</title>
        <style>
            *{
                font-family: sans-serif;
                padding: 0;
                margin: 0;
            }

            .invitaciones{
                width: 100%;
                height: auto;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .forms{
                width: 40%;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .forms form{
                width: 70%;
                height: auto;
                display: flex;
                flex-direction: column;
                padding: 20px;
                border-radius: 5px;
            }
            

            .forms form label:nth-child(n+2){
                margin-top: 10px;
                font-size: 20px;
            }

            .forms form input{
                margin-top: 5px;
                height: 35px;
                border-radius: 5px;
                border: 1px solid #999999;
                padding-left: 10px;
            }

            .forms button{
                margin-top: 10px;
                height: 35px;
                border-radius: 5px;
                border: none;
                background: #005b96;
                color: #fff;
                cursor: pointer;
            }

            .forms button:hover{
                background: #011f4b;
            }

            .welcome{
                width: 60%;
                height: 100vh;
                background: #005b96;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                color: #fff;
                text-align:center;
            }

            .welcome h1{
                font-size: 50px;
            }

            .welcome p{
                font-size: 18px;
                color: #999;
                font-weight: 400;
            }

            form a{
                text-decoration: none;
                color: #005B96;
            }

        </style>
    </head>
    <body>
       <div class="invitaciones">
            <div class="welcome">
                <h1>Bienvenid@s</h1>
                <p>
                    Solo podran acceder aquellos que contengan una invitación <br/>
                    o correos cuyas cuentas fueron creadas previamente
                </p>  
            </div>
            <div class="forms">
            <div class="admin">
                <a href=""></a>
            </div>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Logo-ciat-es.svg/1200px-Logo-ciat-es.svg.png" width="120" height="120"/>
            <?php if(!$registered) {?>
                <form method="POST" action="info">
                    @csrf
                    <label>Email</label>
                    <input name="email" value="{{$emailvalue}}" type="email"/>
                    <button type="submit"/>Acceder</button>
                </form>
            <?php }?>

            <?php if($errorvalue) {  ?>
                <p style="color:red">- Necesitas una invitación o estar registrado para poder acceder<p>
                <p style="color:red">- contacta con el administrador<p>
            <?php } ?>

            <?php if($empty) {  ?>
                <p style="color:red">- Es necesario llenar los campos<p>
            <?php } ?>
            
            <?php if($registered) {?>
                <form method="POST" action="login">
                    @csrf
                    <label>Email</label>
                    <input name="email" value="{{$emailvalue}}" type="email"/>
                    <label>Contraseña</label>
                    <input name="password" value="" type="password"/>
                    <br/>
                    <a href="{{url('/recuperacion')}}">Olvide mi contraseña</a>
                    <button type="submit"/>Acceder</button>
                </form>
            <?php } ?>
            </div>
       </div>
    </body>
</html>