<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        // créé une Gate noméé destroye-edit qui retourn true ou false selon le user
        Gate::define('destroye-edit',function (User $user){
           // $user = Auth::user();
            return $user->IsAdmin($user);

        }) ;
}
}
