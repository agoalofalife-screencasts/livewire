<?php

namespace App\Providers;

use App\Contracts\Repositories\QuestionsRepository;
use App\Repositories\Quiz\RedisQuestionsRepository;
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
       $this->app->bind(QuestionsRepository::class, fn ($app) => new RedisQuestionsRepository());
    }
}
