<?php

namespace Theme\Shopwise\Http\Controllers;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Ecommerce\Repositories\Interfaces\FlashSaleInterface;
use Botble\Ecommerce\Repositories\Interfaces\ProductInterface;
use Botble\Ecommerce\Repositories\Interfaces\ProductVariationInterface;
use Botble\Ecommerce\Repositories\Interfaces\ReviewInterface;
use Botble\Testimonial\Repositories\Interfaces\TestimonialInterface;
use Botble\Theme\Http\Controllers\PublicController;
use Cart;
use DB;
use EcommerceHelper;
use Illuminate\Http\Request;
use Theme;
use Theme\Shopwise\Http\Resources\BrandResource;
use Theme\Shopwise\Http\Resources\ClinicResource;
use Theme\Shopwise\Http\Resources\DoctorResource;
use Theme\Shopwise\Http\Resources\ServiceResource;
use Theme\Shopwise\Http\Resources\PostResource;
use Theme\Shopwise\Http\Resources\ProductCategoryResource;
use Theme\Shopwise\Http\Resources\ReviewResource;
use Theme\Shopwise\Http\Resources\TestimonialResource;

class ShopwiseController extends PublicController
{
    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function ajaxGetProducts(Request $request, BaseHttpResponse $response)
    {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $products = get_products_by_collections([
            'collections' => [
                'by'       => 'id',
                'value_in' => [$request->input('collection_id')],
            ],
            'take'        => 10,
            'with'        => [
                'slugable',
                'variations',
                'productLabels',
                'variationAttributeSwatchesForProductList',
            ],
            'withCount'   => EcommerceHelper::withReviewsCount(),
        ]);

        $data = [];
        foreach ($products as $product) {
            $data[] = Theme::partial('product-item', compact('product'));
        }

        return $response->setData($data);
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function getFeaturedProductCategories(Request $request, BaseHttpResponse $response)
    {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $categories = get_featured_product_categories();

        return $response->setData(ProductCategoryResource::collection($categories));
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function ajaxGetTrendingProducts(Request $request, BaseHttpResponse $response)
    {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $products = get_trending_products([
            'take'      => 10,
            'with'      => [
                'slugable',
                'variations',
                'productLabels',
                'variationAttributeSwatchesForProductList',
            ],
            'withCount' => EcommerceHelper::withReviewsCount(),
        ]);

        $data = [];
        foreach ($products as $product) {
            $data[] = Theme::partial('product-item', compact('product'));
        }

        return $response->setData($data);
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function ajaxGetFeaturedBrands(Request $request, BaseHttpResponse $response)
    {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $brands = get_featured_brands();

        return $response->setData(BrandResource::collection($brands));
    }


    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function ajaxGetClinicList(Request $request, BaseHttpResponse $response)
    {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $clinics = get_clinic_list($request->query('lang'));

        return $response->setData(ClinicResource::collection($clinics));
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function ajaxGetClinicDoctorList(Request $request, BaseHttpResponse $response)
    {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $clinics = get_clinic_doctor_list($request->query('id'), $request->query('lang'));

        return $response->setData(DoctorResource::collection($clinics));
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function ajaxGetClinicServiceList(Request $request, BaseHttpResponse $response)
    {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $services = get_clinic_service_list($request->query('id'), $request->query('lang'));

        return $response->setData(ServiceResource::collection($services));
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function ajaxGetClinicData(Request $request, BaseHttpResponse $response)
    {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $clinic_phone = get_clinic_data($request->query('id'));

        return $response->setData($clinic_phone);
    }


    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function ajaxGetDoctorAppointmentList(Request $request, BaseHttpResponse $response)
    {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $apoointment_list['data'] = get_doctor_appointment_list($request->query('id'),$request->query('lang'));
        $apoointment_list['dont_available_message'] = get_doctor_data($request->query('id'), $request->query('lang'));

        return $response->setData($apoointment_list);
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function ajaxGetDayAppointmentList(Request $request, BaseHttpResponse $response)
    {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $apoointment_list = get_day_appointment_list($request->query('doctor_id'), $request->query('day'), $request->query('date'));

        return $response->setData($apoointment_list);
    }


    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function ajaxReservation(Request $request, BaseHttpResponse $response)
    {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $data = json_decode($request->query('data'));

        $result = get_reserve($data);

        if(isset($result['error']))
        {
            return response()->json([ 'error' => true , 'data' => $result ]);
        }

        return response()->json([ 'error' => false , 'data' => $result ]);

    }




    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function ajaxGetFeaturedProducts(Request $request, BaseHttpResponse $response)
    {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $data = [];

        $products = get_featured_products([
            'take'      => 10,
            'with'      => [
                'slugable',
                'variations',
                'productLabels',
                'variationAttributeSwatchesForProductList',
            ],
            'withCount' => EcommerceHelper::withReviewsCount(),
        ]);

        foreach ($products->chunk(3) as $chunk) {
            $item = '';
            foreach ($chunk as $product) {
                $item .= Theme::partial('product-item', compact('product'));
            }
            $data[] = $item;
        }

        return $response->setData($data);
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function ajaxGetTopRatedProducts(Request $request, BaseHttpResponse $response)
    {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $products = get_top_rated_products(10, [
            'slugable',
            'variations',
            'productLabels',
            'variationAttributeSwatchesForProductList',
        ], EcommerceHelper::withReviewsCount());

        $data = [];
        foreach ($products->chunk(3) as $chunk) {
            $item = '';
            foreach ($chunk as $product) {
                $item .= Theme::partial('product-item', compact('product'));
            }
            $data[] = $item;
        }

        return $response->setData($data);
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function ajaxGetOnSaleProducts(Request $request, BaseHttpResponse $response)
    {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $products = get_products_on_sale([
            'take'      => 10,
            'with'      => [
                'slugable',
                'variations',
                'productLabels',
                'variationAttributeSwatchesForProductList',
            ],
            'withCount' => EcommerceHelper::withReviewsCount(),
        ]);

        $data = [];
        foreach ($products->chunk(3) as $chunk) {
            $item = '';
            foreach ($chunk as $product) {
                $item .= Theme::partial('product-item', compact('product'));
            }
            $data[] = $item;
        }

        return $response->setData($data);
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function ajaxCart(Request $request, BaseHttpResponse $response)
    {
        if (!$request->ajax()) {
            return $response->setNextUrl(route('public.index'));
        }

        return $response->setData([
            'count' => Cart::instance('cart')->count(),
            'html'  => Theme::partial('cart'),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @param BaseHttpResponse $response
     * @return mixed
     */
    public function getQuickView(Request $request, $id, BaseHttpResponse $response)
    {
        if (!$request->ajax()) {
            return $response->setNextUrl(route('public.index'));
        }

        $product = get_products([
            'condition' => [
                'ec_products.id'     => $id,
                'ec_products.status' => BaseStatusEnum::PUBLISHED,
            ],
            'take'      => 1,
            'with'      => [
                'defaultProductAttributes',
                'slugable',
                'tags',
                'tags.slugable',
            ],
            'withCount' => EcommerceHelper::withReviewsCount(),
        ]);

        if (!$product) {
            return $response->setNextUrl(route('public.index'));
        }

        $productImages = $product->images;
        if ($product->is_variation) {
            $product = $product->original_product;
            $selectedAttrs = app(ProductVariationInterface::class)->getAttributeIdsOfChildrenProduct($product->id);
            if (count($productImages) == 0) {
                $productImages = $product->images;
            }
        } else {
            $selectedAttrs = $product->defaultVariation->productAttributes;
        }

        return Theme::partial('quick-view', compact('product', 'selectedAttrs', 'productImages'));
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function ajaxGetFeaturedPosts(Request $request, BaseHttpResponse $response)
    {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $posts = app(PostInterface::class)->getFeatured(3);

        return $response
            ->setData(PostResource::collection($posts))
            ->toApiResponse();
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @param TestimonialInterface $testimonialRepository
     * @return BaseHttpResponse
     */
    public function ajaxGetTestimonials(
        Request $request,
        BaseHttpResponse $response,
        TestimonialInterface $testimonialRepository
    ) {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $testimonials = $testimonialRepository->allBy(['status' => BaseStatusEnum::PUBLISHED]);

        return $response->setData(TestimonialResource::collection($testimonials));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param BaseHttpResponse $response
     * @param ProductInterface $productRepository
     * @return BaseHttpResponse
     */
    public function ajaxGetProductReviews(
        $id,
        Request $request,
        BaseHttpResponse $response,
        ProductInterface $productRepository
    ) {
        if (!$request->ajax() || !$request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $product = $productRepository->getFirstBy([
            'id'           => $id,
            'status'       => BaseStatusEnum::PUBLISHED,
            'is_variation' => 0,
        ]);

        if (!$product) {
            abort(404);
        }

        $star = (int)$request->input('star');
        $perPage = (int)$request->input('per_page', 10);

        $reviews = EcommerceHelper::getProductReviews($product, $star, $perPage);

        if ($star) {
            $message = __(':total review(s) ":star star" for ":product"', [
                'total'   => $reviews->total(),
                'product' => $product->name,
                'star'    => $star,
            ]);
        } else {
            $message = __(':total review(s) for ":product"', [
                'total'   => $reviews->total(),
                'product' => $product->name,
            ]);
        }

        return $response
            ->setData(ReviewResource::collection($reviews))
            ->setMessage($message)
            ->toApiResponse();
    }

    /**
     * @param Request $request
     * @param int $id
     * @param BaseHttpResponse $response
     * @param FlashSaleInterface $flashSaleRepository
     * @return BaseHttpResponse
     */
    public function ajaxGetFlashSales(
        Request $request,
        BaseHttpResponse $response,
        FlashSaleInterface $flashSaleRepository
    ) {
        if (!$request->ajax()) {
            return $response->setNextUrl(route('public.index'));
        }

        $flashSales = $flashSaleRepository->getModel()
            ->notExpired()
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->with([
                'products' => function ($query) {
                    return $query
                        ->where('status', BaseStatusEnum::PUBLISHED)
                        ->withCount(EcommerceHelper::withReviewsCount());
                },
            ])
            ->get();

        if (!$flashSales->count()) {
            return $response->setData([]);
        }

        $data = [];
        foreach ($flashSales as $flashSale) {
            foreach ($flashSale->products as $product) {
                if (!EcommerceHelper::showOutOfStockProducts() && $product->isOutOfStock()) {
                    continue;
                }

                $data[] = Theme::partial('flash-sale-product', compact('product', 'flashSale'));
            }
        }

        return $response->setData($data);
    }
}
