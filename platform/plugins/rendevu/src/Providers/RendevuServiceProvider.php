<?php

namespace Botble\Rendevu\Providers;

use Botble\Rendevu\Models\Rendevu;
use Illuminate\Support\ServiceProvider;
use Botble\Rendevu\Repositories\Caches\RendevuCacheDecorator;
use Botble\Rendevu\Repositories\Eloquent\RendevuRepository;
use Botble\Rendevu\Repositories\Interfaces\RendevuInterface;
use Illuminate\Support\Facades\Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class RendevuServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(RendevuInterface::class, function () {
            return new RendevuCacheDecorator(new RendevuRepository(new Rendevu));
        });

        $this->setNamespace('plugins/rendevu')->loadHelpers();
    }

    public function boot()
    {
        $this
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes(['web']);

        // if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
        //     if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
        //         // Use language v2
        //         \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Rendevu::class, [
        //             'name',
        //         ]);
        //     } else {
        //         // Use language v1
        //         $this->app->booted(function () {
        //             \Language::registerModule([Rendevu::class]);
        //         });
        //     }
        // }

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-rendevu',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'المواعيد',
                'icon'        => 'fa fa-list',
                'url'         => route('rendevu.index'),
                'permissions' => ['rendevu.index'],
            ]);
        });
    }
}
