<?php

namespace App\Providers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\PatientQueue;
use App\Models\Unit;
use App\Models\UnitSchedule;
use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use PhpParser\Comment\Doc;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::model('user', User::class);
        Route::model('unit', Unit::class);
        Route::model('unit_schedule', UnitSchedule::class);
        Route::model('doctor', Doctor::class);
        Route::model('patient', Patient::class);
        Route::model('patient_queue', PatientQueue::class);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::middleware('api')
              ->prefix('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
