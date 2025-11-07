<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Mapas de eventos para ouvintes.
     *
     * @var array
     */
    protected $listen = [
        // 'App\Events\SomeEvent' => [
        //     'App\Listeners\EventListener',
        // ],
    ];

    /**
     * Registre quaisquer eventos para sua aplicação.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
