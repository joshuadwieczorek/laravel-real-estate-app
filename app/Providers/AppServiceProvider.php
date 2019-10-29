<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Repositories\UserLogsRepositoryContract;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Contracts\ServiceProviders\AuthServiceProviderContract;
use App\Repositories\UserLogsRepository;
use App\Repositories\UserRepository;
use App\ServiceProviders\AuthServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * All of the container singletons that should be registered.
	 *
	 * @var array
	 */
	public $singletons = [
		UserLogsRepositoryContract::class => UserLogsRepository::class,
		UserRepositoryContract::class => UserRepository::class,
		AuthServiceProviderContract::class => AuthServiceProvider::class,
	];


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}