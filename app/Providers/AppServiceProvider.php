<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registre quaisquer serviços do aplicativo.
     *
     * Este método é usado para vincular coisas no container de serviços.
     *
     * @return void
     */
    public function register()
    {
        // Exemplo: $this->app->bind(Interface::class, Implementation::class);
    }

    /**
     * Inicialize quaisquer serviços do aplicativo.
     *
     * Este método é chamado após todos os providers serem registrados.
     *
     * @return void
     */
    public function boot()
    {
        // Exemplo: Registrar event listeners, middleware, macros, etc.
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }

}
