<?php

namespace Botble\Service\Providers;

use Botble\Service\Models\Service;
use Illuminate\Support\ServiceProvider;
use Botble\Service\Repositories\Caches\ServiceCacheDecorator;
use Botble\Service\Repositories\Eloquent\ServiceRepository;
use Botble\Service\Repositories\Interfaces\ServiceInterface;
use Illuminate\Support\Facades\Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class ServiceServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(ServiceInterface::class, function () {
            return new ServiceCacheDecorator(new ServiceRepository(new Service));
        });

        $this->setNamespace('plugins/service')->loadHelpers();
    }

    public function boot()
    {
        $this
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes(['web']);

        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
            if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
                // Use language v2
                \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Service::class, [
                    'name',
                ]);
            } else {
                // Use language v1
                $this->app->booted(function () {
                    \Language::registerModule([Service::class]);
                });
            }
        }

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-service',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/service::service.name',
                'icon'        => 'fa fa-list',
                'url'         => route('service.index'),
                'permissions' => ['service.index'],
            ]);
        });
    }
}
