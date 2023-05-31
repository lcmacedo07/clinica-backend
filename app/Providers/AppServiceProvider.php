<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Models\Link;
use App\Observers\LinkObserver;
use App\Models\Accountant;
use App\Observers\AccountantObserver;
use App\Models\Useraccesses;
use App\Observers\UseraccessesObserver;


class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        
		$this->app->bind(
			'App\Interfaces\v1\LinkInterface',
			'App\Repositories\v1\LinkRepository'
		);
        
		$this->app->bind(
			'App\Interfaces\v1\AccountantInterface',
			'App\Repositories\v1\AccountantRepository'
		);
        
		$this->app->bind(
			'App\Interfaces\v1\UseraccessesInterface',
			'App\Repositories\v1\UseraccessesRepository'
		);
        
        $this->app->bind(
            'Illuminate\Contracts\Filesystem\Factory',
            'Illuminate\Contracts\Filesystem\Factory'
        );
    }

    public function boot()
    {
        Schema::defaultStringLength(191);
        
		Link::observe(LinkObserver::class);
		Accountant::observe(AccountantObserver::class);
		Useraccesses::observe(UseraccessesObserver::class);
         
    }
}