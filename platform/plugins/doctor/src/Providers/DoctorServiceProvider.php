<?php

namespace Botble\Doctor\Providers;

use Botble\Doctor\Models\Doctor;
use Illuminate\Support\ServiceProvider;
use Botble\Doctor\Repositories\Caches\DoctorCacheDecorator;
use Botble\Doctor\Repositories\Eloquent\DoctorRepository;
use Botble\Doctor\Repositories\Interfaces\DoctorInterface;
use Illuminate\Support\Facades\Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class DoctorServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(DoctorInterface::class, function () {
            return new DoctorCacheDecorator(new DoctorRepository(new Doctor));
        });


        $this->setNamespace('plugins/doctor')->loadHelpers();
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
                \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Doctor::class, [
                    'name',
                    'message'
                ]);
            } else {
                // Use language v1
                $this->app->booted(function () {
                    \Language::registerModule([Doctor::class]);
                });
            }
        }

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-doctor',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/doctor::doctor.name',
                'icon'        => 'fa fa-list',
                'url'         => route('doctor.index'),
                'permissions' => ['doctor.index'],
            ]);
        });
    }
}
