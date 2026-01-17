<?php

namespace Botble\Clinic\Providers;

use Botble\Clinic\Models\Clinic;
use Illuminate\Support\ServiceProvider;
use Botble\Clinic\Repositories\Caches\ClinicCacheDecorator;
use Botble\Clinic\Repositories\Eloquent\ClinicRepository;
use Botble\Clinic\Repositories\Interfaces\ClinicInterface;
use Illuminate\Support\Facades\Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class ClinicServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(ClinicInterface::class, function () {
            return new ClinicCacheDecorator(new ClinicRepository(new Clinic));
        });

        $this->setNamespace('plugins/clinic')->loadHelpers();
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
                \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Clinic::class, [
                    'name',
                    'clinic_order',
                    'phone',
                    'services',
                    'doctors',
                ]);
            } else {
                // Use language v1
                $this->app->booted(function () {
                    \Language::registerModule([Clinic::class]);
                });
            }
        }

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-clinic',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/clinic::clinic.name',
                'icon'        => 'fa fa-list',
                'url'         => route('clinic.index'),
                'permissions' => ['clinic.index'],
            ]);
        });
    }
}
