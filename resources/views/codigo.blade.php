<?php

    $emailvalue = "";
    $invited = false;
    $codevalue = "";
    $errorvalue = "";
    $nombrevalue = "";
    $apellidovalue = "";
    
    if(!empty($email)){
        $emailvalue = $email;
    }
    
    if (!empty($nombre)){
        $nombrevalue = $nombre;
    }

    if (!empty($apellido)){
        $apellidovalue = $apellido;
    }

    if(!empty($codigo)){
        $codevalue = $codigo;
    }

    if(isset($isinvited)){
        $invited = $isinvited;
    }

    if (!empty($error)){
        $errorvalue = $error;
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
            }

            .codigo{
                width: 100%;
                height: 90vh;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                text-align: center;
            }

            .codigo form{
                width: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .codigo form label:nth-child(n+2){
                margin-top: 10px;
            }

            .codigo input{
                width: 8%;
                height: 50px;
                text-align: center;
                border-radius: 5px;
                border: 1px solid #999999;
            }

            .codigo input:nth-child(n+2){
                margin-left: 20px;
            }

            .codigo button{
                margin-top: 10px;
            }

            .btncomp button{
                width: 300px;
                height: 40px;
                font-size: 18px;
                background-color: #005b96;
                color: #fff;
                border-radius: 5px;
                border: none;
                cursor: pointer;
            }

            .btncomp button:hover{
                background-color: #011f4b;
            }

            .codigoInput{
                width: 100%;
                height: auto;
            }

            .error{
                color: red;
            }

        </style>
    </head>
    <body>
       <div class="codigo">
            <?php if($invited) { ?>
            <div>
                <h1>Introduce el codigo de verificacion</h1>
                <p>El codigo de verificación ha sido enviado a tu correo</p>
                <?php if (!empty($errorvalue)) {?>
                        <p class="error">
                            Codigo incorrecto, intente de nuevo.    
                        <p>
                <?php }?>
            </div>
            <form method="POST" action="verificacion">
                @csrf
                <div class="codigoInput">
                    <input type="text" maxlength="1" name="value1" required/>
                    <input type="text" maxlength="1" name="value2" required/>
                    <input type="text" maxlength="1" name="value3" required/>
                    <input type="text" maxlength="1" name="value4" required/>
                    <input type="text" maxlength="1" name="value5" required/>
                    <input value="{{$codevalue}}" style="display:none" name="code"/>
                    <input value="{{$emailvalue}}" style="display:none" name="email"/>
                    <input value="{{$nombrevalue}}" style="display:none" name="nombre"/>
                    <input value="{{$apellidovalue}}" style="display:none" name="apellido"/>
                    <input value="{{$invited}}" style="display:none" name="invited"/>
                </div>
                <br/>
                <div class="btncomp">
                    <button type="submit"/>Verificar</button>
                </div>
            </form>
       </div>
       <?php }else{ ?>
       <div>
            <h1>Necesitas una invitación para continuar</h1>
       </div>
       <?php } ?>
    </body>
</html>