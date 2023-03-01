<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ URL::asset('css/global.css') }}" />
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
        <title>Network | Dashboard</title>

        @livewireStyles 
    </head>

    <body> 
        <div class="middle">
            @livewire('admin.dashboard')

            <div>
                Solamente los administradores pueden acceder a esta página. 
                Ver: 
                    - Estadísticas (contadores)
                    - Cuentas de usuario
                    - Posts
                    - Administrar categorías
                    - Administrar roles y permisos (admin)
                    - Ver personas con permisos (cualquiera)
                    - Chat de staff 
                    - Reportes de Posts 
            </div>
        </div>
        
        @livewireScripts 
    </body> 

    <style> 
        .middle {
            width: 1300px;     
        }
    </style>
</html>