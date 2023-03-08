<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ URL::asset('css/global.css') }}" />
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
        <title>Network | Conversation</title> 

        @livewireStyles
    </head>

    <body>   
        @livewire('account.conversation')

        <x-bottombar />

        @livewireScripts
    </body>  

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        Echo.channel('notificate').listen('WhisperUser', (e) => {
            console.log(e)
        })
    </script> 
</html>