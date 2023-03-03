<?php

namespace App\Providers;
use Illuminate\Support\Facades\Event;
use App\Events\ConnectionHandler; 
use BeyondCode\LaravelWebSockets\Events\WebsocketConnectionOpened;
use BeyondCode\LaravelWebSockets\Events\WebsocketConnectionClosed;
use Illuminate\Support\ServiceProvider;

class WebsocketConnections extends ServiceProvider
{
    public function register()
    {
        
    }

    public function boot()
    {
        // @ Connection
        Event::listen(WebsocketConnectionOpened::class, function ($event) {
            broadcast(new ConnectionHandler('connection', 'hola')); 
        });

        // @ Disconnect
        Event::listen(WebsocketConnectionClosed::class, function ($event) {
            broadcast(new ConnectionHandler('disconnection', 'hola')); 
        });
    }
}
