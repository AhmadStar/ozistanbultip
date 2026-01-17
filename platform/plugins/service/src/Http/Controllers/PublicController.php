<?php

namespace Botble\Service\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Response;
use Theme;
use Botble\Service\Repositories\Interfaces\ServiceInterface;
use Botble\Service\Models\Service;
use SeoHelper;
use Botble\SeoHelper\SeoOpenGraph;
use RvMedia;

class PublicController extends Controller
{


    /**
     * @var servicesInterface
     */
    protected $serviceRepository;

    /**
     * PublicController constructor.
     * @param OrderHistoryInterface $servicesRepository
     */
    public function __construct(ServiceInterface $serviceRepository
    ) {
        $this->serviceRepository = $serviceRepository;
    }


    /**
     * @param string $slug
     * @param BlogService $blogService
     * @return RedirectResponse|Response
     */
    public function getService($slug)
    {
        if (!$slug) {
            abort(404);
        }

        $service = Service::where(['slug'=>$slug])->first();
        $services = $this->serviceRepository->advancedGet([
            'condition' => [
            ],
            'order_by'  => ['created_at' => 'DESC'],
        ]);

        if (!$service) {
            abort(404);
        }

        SeoHelper::setTitle($service->name)
            ->setDescription($service->description);

        $meta = new SeoOpenGraph;
        if ($service->image) {
            $meta->setImage(RvMedia::getImageUrl($service->image));
        }
        $meta->setDescription($service->description);
        $meta->setUrl('/service/' . $service->slug);
        $meta->setTitle($service->name);
        $meta->setType('article');

        SeoHelper::setSeoOpenGraph($meta);

        return Theme::scope('service.overview',['service'=>$service,'services'=>$services] ,'plugins/service::service')
        ->render();

    }

    /**
     * @param string $slug
     * @param BlogService $blogService
     * @return RedirectResponse|Response
     */
    public function getServices()
    {


        $services = $this->serviceRepository->advancedGet([
            'condition' => [
            ],
            'order_by'  => ['created_at' => 'DESC'],
        ]);


        // SeoHelper::setTitle($service->name)
        //     ->setDescription($service->description);

        // $meta = new SeoOpenGraph;
        // if ($service->image) {
        //     $meta->setImage(RvMedia::getImageUrl($service->image));
        // }
        // $meta->setDescription($service->description);
        // $meta->setUrl('/service/' . $service->slug);
        // $meta->setTitle($service->name);
        // $meta->setType('article');

        // SeoHelper::setSeoOpenGraph($meta);

        return Theme::scope('services.overview',['services' => $services] ,'plugins/service::services')
        ->render();

    }


}
