<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.app','App\Http\ViewComposer\TaskCountComposer@compose');
        // 视图渲染器，或者视图公共数据合成器
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
