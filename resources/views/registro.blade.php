<?php

    $emailval = "";
    $nombreval = "";
    $apellidoval = "";
    $passwordval = false;
    $existval = false;

    if(isset($_GET['email'])){
       $emailval = $_GET['email'];
    }
    


    if(isset($_GET['nombre'])){
       $nombreval = $_GET['nombre'];
    }

    if(isset($_GET['apellido'])){
        $apellidoval = $_GET['apellido'];
    }

    if(isset($nombre)){
        $nombreval = $nombre;
    }

    if(isset($apellido)){
        $apellidoval = $apellido;
    }


    if(isset($_GET['password'])){
        $passwordval = $_GET['password'];
    }

    if(isset($_GET['noexist'])){
        $existval = $_GET['noexist'];
     }

    if(!empty($email)){
        $emailval = $email;
    }

    if(!empty($nombre)){
        $nombreval = $nombre;
    }

    if(!empty($apellido)){
        $apellidoval = $apellido;
    }
     
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <style>

            *{
                font-family: sans-serif;
                padding: 0;
                margin: 0;
            }

           .form-register {
                width: 100%;
                height: auto;
                display: flex;
                justify-content:center;
                align-items:center;
            }

            .form{
                width: 40%;
                height: 90vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .form form{
                width: 80%;
            }

            .form-register label{
                margin-top: 10px;
            }

            .group{
                display:flex;
                width: 100%;
                justify-content:flex-start;
                align-items: center;
            }

            .group input, .group select{
                width: 90%;
                margin-top: 5px;
                height: 35px;
                border-radius: 5px;
                border: 1px solid #999999;
                padding-left: 10px;
            }

            .group select{
                width: 95%;
            }

            .grouplabel{
                width: 50%;
                display: flex;
                flex-direction: column;
            }

            .grouplabel-exe{
                width: 100%;
                display: flex;
                flex-direction: column;
            }

            .grouplabel-exe input{
                width: 95%;
            }   

            .form button{
                margin-top: 20px;
                width: 100%;
                height: 40px;
                background: #005b96;
                border: none;
                border-radius: 5px;
                color: #fff;
                font-size: 15px;
                cursor: pointer;
            }

            .welcomeRegister{
                width: 60%;
                height: 100vh;
                background: #005b96;
                color: #fff;
                display: flex;
                justify-content:center;
                align-items:center;
                flex-direction: column;
            }

            .welcomeRegister h1{
                font-size: 50px;
            }

            .welcomeRegister p{
                font-size: 18px;
                color: #999;
                font-weight: 400;
            }

        </style>
    </head>
    <body>
       <div class="form-register">
            <div class="form">
                <form method="POST" action="registro">
                    @csrf
                    <div class="group">
                    <div class="grouplabel">
                            <label>Email</label>
                            <input name="email" type="email" value="{{$emailval}}" required/>
                    </div>

                    <div class="grouplabel">
                            <label>Nombre</label>
                            <input name="nombre" type="text" value="{{$nombreval}}" required/>
                        </div>
                    </div>

                    <div class="group">
                    <div class="grouplabel">
                            <label>Apellido</label>
                            <input name="apellido" type="text" value="{{$apellidoval}}" required/>
                    </div>

                    <div class="grouplabel">
                            <label>Dirección</label>
                            <input name="direccion" type="text" required/>
                        </div>
                    </div>
                
                    <div class="group">
                    <div class="grouplabel">
                            <label>Pais</label>
                            <select name="pais" required>
                                <option value="Colombia">Colombia</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Panama" selected>Panamá</option>
                            </select>
                    </div>

                    <div class="grouplabel">
                            <label>Ciudad</label>
                            <input name="ciudad" type="text"/>
                        </div>
                    </div>
                    
                    <div class="group">
                    <div class="grouplabel-exe">
                        <label>Telefono</label>
                        <input name="telefono" type="text"/>
                    </div>
                    </div>                        
                    
                    <div class="group">
                    <div class="grouplabel">
                        <label>Contraseña</label>
                        <input name="password" type="password" required/>
                    </div>

                    <div class="grouplabel">
                            <label>Repetir Contraseña</label>
                            <input name="password_confirmation" type="password" required/>
                    </div>
                    
                </div>

                    <button type="submit">Registrar</button>

                    <?php if($passwordval){ ?>
                        <p style="color:red;margin-top:20px;">- Las contraseñas no coinciden<p>
                    <?php } ?>
                    <?php if($existval){ ?>
                        <p style="color:red;margin-top:20px;">- Estas intentando registrar un correo no valido<p>
                    <?php } ?>
                </form>
            </div>
            <div class="welcomeRegister">
                <h1>Registrate</h1>
                <p>Si te equivocas al registrarte, podras cambiar la información luego.</p>
            </div>
       </div>
    </body>
</html>
