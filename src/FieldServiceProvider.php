<?php

namespace PhoenixLib\NovaNestedTreeAttachMany;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use PhoenixLib\NovaNestedTreeAttachMany\Domain\Cache\ArrayCache;
use PhoenixLib\NovaNestedTreeAttachMany\Domain\Cache\Cache;
use PhoenixLib\NovaNestedTreeAttachMany\Domain\Relation\Handlers\BelongsToHandler;
use PhoenixLib\NovaNestedTreeAttachMany\Domain\Relation\Handlers\BelongsToManyHandler;
use PhoenixLib\NovaNestedTreeAttachMany\Domain\Relation\Handlers\HasManyHandler;
use PhoenixLib\NovaNestedTreeAttachMany\Domain\Relation\RelationHandlerFactory;
use PhoenixLib\NovaNestedTreeAttachMany\Domain\Relation\RelationHandlerResolver;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-nested-tree-attach-many', __DIR__.'/../dist/js/field.js');
            Nova::style('nova-nested-tree-attach-many', __DIR__.'/../dist/css/field.css');
        });

        $this->app->booted(function () {
            \Route::middleware(['nova'])
                ->prefix('nova-vendor/nova-nested-tree-attach-many')
                ->group(__DIR__.'/../routes/api.php');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RelationHandlerFactory::class, RelationHandlerResolver::class);

        $factory = $this->app->make(RelationHandlerFactory::class);

        $factory->register($this->app->make(BelongsToManyHandler::class));
        $factory->register($this->app->make(BelongsToHandler::class));
        $factory->register($this->app->make(HasManyHandler::class));


        $this->app->singleton(Cache::class, ArrayCache::class);
    }
}
