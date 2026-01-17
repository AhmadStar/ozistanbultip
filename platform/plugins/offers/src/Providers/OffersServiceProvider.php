<?php

namespace Botble\Offers\Providers;

use Botble\Offers\Models\Offers;
use Illuminate\Support\ServiceProvider;
use Botble\Offers\Repositories\Caches\OffersCacheDecorator;
use Botble\Offers\Repositories\Eloquent\OffersRepository;
use Botble\Offers\Repositories\Interfaces\OffersInterface;
use Botble\Base\Supports\Helper;
use Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class OffersServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(OffersInterface::class, function () {
            return new OffersCacheDecorator(new OffersRepository(new Offers));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/offers')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web']);

        Event::listen(RouteMatched::class, function () {
            if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
                \Language::registerModule([Offers::class]);
            }

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-offers',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/offers::offers.name',
                'icon'        => 'fa fa-list',
                'url'         => route('offers.index'),
                'permissions' => ['offers.index'],
            ]);
        });
    }
}
