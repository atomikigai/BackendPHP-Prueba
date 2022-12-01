<?php

    $errorvalue = "";
    $invited = false;

    if(isset($_GET["error"])){
        $errorvalue = $_GET["error"];
    }
    if(isset($_GET["invited"])){
        $invited = $_GET["invited"];
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
                height: 90vh;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .forms form{
                width: 100%;
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

            form a{
                text-decoration: none;
                color: #005B96;
            }

        </style>
    </head>
    <body>
       <div class="invitaciones">

            <div class="forms">
            <h1>Recuperar contraseña</h1>
            <p>Si te has registrado previamente puedes actualizar tus datos</p>
                <form method="POST" action="recuperacion">
                    @csrf
                    <label>Email</label>
                    <input name="email" type="email"/>
                    <label>Contraseña</label>
                    <input name="password" type="password"/>
                    <button type="submit"/>Recuperar</button>
                </form>

                <?php if(!empty($errorvalue)) {  ?>
                    <p style="color:red"><?php echo $errorvalue ?><p>
                <?php }else{ ?>
                    <p></p>
                <?php }?>

                <?php if($invited) {  ?>
                    <a 
                        href="{{url('/')}}" 
                        style="text-decoration:none;color:#005B96;font-size:15px;">Registrar</a>
                <?php }else{ ?>
                    <p></p>
                <?php }?>
            </div>
       </div>
    </body>
</html>