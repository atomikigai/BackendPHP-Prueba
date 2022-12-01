<?php
   
   $notification = "";
   $success = "";
   $warning = "";

    if(!empty($_GET['message'])){
        $notification = $_GET['message'];
    }

    if(!empty($_GET['success'])){
        $success = $_GET['success'];
    }

    if(!empty($_GET['warning'])){
        $warning = $_GET['warning'];
    }
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Invitacion</title>
        <style>
            *{
                font-family: sans-serif;
                padding: 0;
                margin: 0;
            }

            .invitaciones{
                width: 100%;
                height: 90vh;
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

        </style>
    </head>
    <body>
        <div class="invitaciones">
            <div class="forms">
                <h1>Invita a usuarios a participar</h1>
                <p>Introduce un correo electronico y llegara un enlace para acceder</p>
                <form method="POST" action="sendinvitation">
                    @csrf
                    <label>Email</label>
                    <input name="email" type="email" required/>
                    <label>Nombre</label>
                    <input name="nombre" type="nombre" required/>
                    <label>Apellido</label>
                    <input name="apellido" type="apellido" required/>
                    <button type="submit"/>Invitar</button>
                </form>
                <?php if(!empty($notification)){ ?>
                    <p style="color:red;"><?php echo $notification ?></p>
                <?php } ?>

                <?php if(!empty($success)){ ?>
                    <p style="color:green;"><?php echo $success ?></p>
                <?php } ?>

                <?php if(!empty($warning)){ ?>
                    <p style="color:#ffa700;"><?php echo $warning ?></p>
                <?php } ?>
            </div>       
        </div>
    </body>
</html>