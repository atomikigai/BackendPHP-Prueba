<?php
    $actual_rol = "";
    $blockEdit = false;
    $blockDelete = false;
    $acutal_email = "";

    session_start();

    if(isset($_SESSION["rol"])){
        $actual_rol = $_SESSION["rol"];
    }

    if(isset($_SESSION["email"])){
        $acutal_email = $_SESSION["email"];
    }
    
    if ($actual_rol !== "Administrador"){
        $blockEdit = true;
        $blockDelete = true;
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
            
            .table{
                width: 100%;
                display: flex;
                align-items: center;
                justify-content:center;
                flex-direction:column;
                height: 90vh;
            }

            .tablecontent{
                border: 1px solid #ddd;
                padding: 20px;
                border-radius: 5px;
            }
            
            table{
                border-collapse: collapse;
            }

            th, td {
                text-align:center;
                padding:20px
            }

            th{
                color: #999999;
                border-bottom: 1px solid #ddd;
            }

            i{
                cursor: pointer;
                color: #005B96;
                font-size: 20px;
            }

            .invitar{
                width: 100%;
                height: 20px;
                display: flex;
                justify-content: flex-end;
            }

            .invitar a{
                width: 100px;
                height: 40px;
                margin-top: 20px;
                margin-right: 20px;
                font-size: 15px;
                color: #fff;
                background: #005B96;
                border-radius: 5px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                text-decoration: none;
            }

        </style>
    </head>
    <body>
       <div class="invitar">
        <a href="{{url('/enviar')}}">Invitar</a>
       </div>
       <div class="table">
            <div class="tablecontent">
                <h1>Admin Panel</h1>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Pais</th>
                        <th>Ciudad</th>
                        <th>Telefono</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                    @foreach($data as $val)
                    <tr>
                        <td>{{ $val->id}}</td> 
                        <td>{{ $val->nombre}}</td> 
                        <td>{{ $val->apellido}}</td> 
                        <td>{{ $val->email}}</td>
                        <td>{{ $val->pais}}</td>
                        <td>{{ $val->ciudad}}</td>
                        <td>{{ $val->telefono}}</td>
                        <td><a href="{{url('/admin/editar/'.$val->id)}}"><i class="fa-solid fa-pencil"></i></a></td>
                        <td><a href="{{url('/admin/delete/'.$val->id)}}"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
       </div>
    </body>
</html>