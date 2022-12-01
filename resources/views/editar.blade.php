<?php
    $passwordval = "";
    $existval = "";
    $emailval = "";
    $nombreval = "";
    $apellidoval = "";

   if(isset($_GET['password'])){
        $passwordval = $_GET['password'];
    }

    if(isset($_GET['noexist'])){
        $existval = $_GET['noexist'];
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
                <form method="POST" action="updatedata">
                    @csrf

                    @foreach($data as $val)
                    <input name="id" type="text" value="{{$val->id}}" hidden/>
                    <div class="group">
                    <div class="grouplabel">
                            <label>Email</label>
                            <input name="email" type="email" value="{{$val->email}}" required/>
                    </div>

                    <div class="grouplabel">
                            <label>Nombre</label>
                            <input name="nombre" type="text" value="{{$val->nombre}}" required/>
                        </div>
                    </div>

                    <div class="group">
                    <div class="grouplabel">
                            <label>Apellido</label>
                            <input name="apellido" type="text" value="{{$val->apellido}}" required/>
                    </div>

                    <div class="grouplabel">
                            <label>Dirección</label>
                            <input name="direccion" type="text" value="{{$val->direccion}}" required/>
                        </div>
                    </div>
                
                    <div class="group">
                    <div class="grouplabel">
                            <label>Pais</label>
                            <select name="pais" required>
                                <option value="Colombia"
                                    <?php if($val->pais == 'Colombia')
                                        {echo 'selected="selected"';} 
                                    ?> 
                                >Colombia</option>
                                <option value="Mexico"
                                    <?php if($val->pais == 'Mexico')
                                        {echo 'selected="selected"';} 
                                    ?> 
                                >Mexico</option>
                                <option value="Panama"
                                    <?php if($val->pais == 'Panama')
                                            {echo 'selected="selected"';} 
                                    ?> 
                                 >Panamá</option>
                            </select>
                    </div>

                    <div class="grouplabel">
                            <label>Ciudad</label>
                            <input name="ciudad" type="text" value="{{$val->ciudad}}"/>
                        </div>
                    </div>
                    
                    <div class="group">
                    <div class="grouplabel-exe">
                        <label>Telefono</label>
                        <input name="telefono" type="text" value="{{$val->telefono}}"/>
                    </div>
                    </div>                        
                    
                    <div class="group">
                    <div class="grouplabel">
                        <label>Contraseña</label>
                        <input name="password" type="password" required />
                    </div>

                    <div class="grouplabel">
                            <label>Repetir Contraseña</label>
                            <input name="password_confirmation" type="password" required/>
                    </div>
                    @endforeach
                </div>

                    <button type="submit">Actualizar</button>

                    <?php if($passwordval){ ?>
                        <p style="color:red;margin-top:20px;">- Las contraseñas no coinciden<p>
                    <?php } ?>
                    <?php if($existval){ ?>
                        <p style="color:red;margin-top:20px;">- Estas intentando registrar un correo no valido<p>
                    <?php } ?>
                </form>
            </div>
            <div class="welcomeRegister">
                <h1>Edición</h1>
                <p>Edita la información que necesitas</p>
            </div>
       </div>
    </body>
</html>