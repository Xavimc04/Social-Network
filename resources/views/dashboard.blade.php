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
            <div class="stats">
                <div class="section" style="background: rgb(216, 81, 81); box-shadow: 0px 0px 4px rgb(216, 81, 81)">
                    <div class="title material-icons">category</div>
                    <span>{{ $categories }}</span>
                </div> 

                <div class="section" style="background: rgb(108, 216, 81); box-shadow: 0px 0px 4px rgb(108, 216, 81)">
                    <div class="title material-icons">person</div>
                    <span>{{ $users }}</span>
                </div> 

                <div class="section" style="background: rgb(81, 144, 216); box-shadow: 0px 0px 4px rgb(81, 144, 216)">
                    <div class="title material-icons">flag</div>
                    <span>{{ $reports }}</span>
                </div>  

                <div class="section" style="background: rgb(216, 135, 81); box-shadow: 0px 0px 4px rgb(216, 135, 81)">
                    <div class="title material-icons">article</div>
                    <span>{{ $posts }}</span>
                </div>  

                <div class="section" style="background: rgb(90, 81, 216); box-shadow: 0px 0px 4px rgb(90, 81, 216)">
                    <div class="title material-icons">notifications</div>
                    <span>{{ $sessions }}</span>
                </div> 
            </div>

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
                    - Mandar notificaciones a usuarios
                    - Mandar emails y emails recibidos a un correo
            </div>

        </div>
        
        <svg class="wave" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 220" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(36.846, 36.846, 36.846, 1)" offset="0%"></stop><stop stop-color="rgba(4.971, 4.971, 4.971, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,88L20,102.7C40,117,80,147,120,154C160,161,200,147,240,121C280,95,320,59,360,40.3C400,22,440,22,480,47.7C520,73,560,125,600,135.7C640,147,680,117,720,121C760,125,800,161,840,154C880,147,920,95,960,84.3C1000,73,1040,103,1080,99C1120,95,1160,59,1200,47.7C1240,37,1280,51,1320,66C1360,81,1400,95,1440,102.7C1480,110,1520,110,1560,110C1600,110,1640,110,1680,99C1720,88,1760,66,1800,77C1840,88,1880,132,1920,124.7C1960,117,2000,59,2040,62.3C2080,66,2120,132,2160,150.3C2200,169,2240,139,2280,117.3C2320,95,2360,81,2400,84.3C2440,88,2480,110,2520,102.7C2560,95,2600,59,2640,66C2680,73,2720,125,2760,146.7C2800,169,2840,161,2860,157.7L2880,154L2880,220L2860,220C2840,220,2800,220,2760,220C2720,220,2680,220,2640,220C2600,220,2560,220,2520,220C2480,220,2440,220,2400,220C2360,220,2320,220,2280,220C2240,220,2200,220,2160,220C2120,220,2080,220,2040,220C2000,220,1960,220,1920,220C1880,220,1840,220,1800,220C1760,220,1720,220,1680,220C1640,220,1600,220,1560,220C1520,220,1480,220,1440,220C1400,220,1360,220,1320,220C1280,220,1240,220,1200,220C1160,220,1120,220,1080,220C1040,220,1000,220,960,220C920,220,880,220,840,220C800,220,760,220,720,220C680,220,640,220,600,220C560,220,520,220,480,220C440,220,400,220,360,220C320,220,280,220,240,220C200,220,160,220,120,220C80,220,40,220,20,220L0,220Z"></path></svg>
        
        @livewireScripts 
    </body> 

    <style> 
        .middle {
            width: 1300px;     
        }

        .stats {
            margin-top: 30px; 
            display: flex; 
            flex-direction: row;
            flex-wrap: wrap;  
            justify-content: space-between; 
            width: 100%;   
        }

        .stats .section {
            position: relative; 
            height: 100%;
            width: 150px;  
            padding: 20px 15px; 
            border-radius: 3px;
            margin-top: 20px;  
            display: flex; 
            justify-content: center; 
            color: white 
        }

        .section .title {
            position: absolute; 
            top: -10px;  
            left: 10px; 
            color: black; 
            font-weight: 900;  
        }

        .wave {
            position: absolute; 
            z-index: -1;   
            opacity: .1; 
        }
    </style>
</html>