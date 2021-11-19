<?php

namespace App\Providers;

use App\Repository\EloquentRepositoryInterface; 
use App\Repository\ArticleRepositoryInterface; 
use App\Repository\Eloquent\ArticleRepository; 
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
      $this->app->bind(ArticleRepositoryInterface::class, BaseRepository::class);
       $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);  
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
