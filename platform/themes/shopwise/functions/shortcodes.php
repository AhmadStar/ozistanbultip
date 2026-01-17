<?php

use Botble\Ads\Repositories\Interfaces\AdsInterface;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Faq\Repositories\Interfaces\FaqCategoryInterface;
use Botble\Theme\Supports\ThemeSupport;
use Botble\Offers\Repositories\Interfaces\OffersInterface;
use Botble\Testimonial\Repositories\Interfaces\TestimonialInterface;

app()->booted(function () {

    ThemeSupport::registerGoogleMapsShortcode();
    ThemeSupport::registerYoutubeShortcode();

    if (is_plugin_active('ecommerce')) {
        add_shortcode('featured-product-categories', __('Featured Product Categories'),
            __('Featured Product Categories'),
            function ($shortcode) {

                return Theme::partial('shortcodes.featured-product-categories', [
                    'title'       => $shortcode->title,
                    'description' => $shortcode->description,
                    'subtitle'    => $shortcode->subtitle,
                ]);
            });

        shortcode()->setAdminConfig('featured-product-categories', function ($attributes) {
            return Theme::partial('shortcodes.featured-product-categories-admin-config', compact('attributes'));
        });

        add_shortcode('featured-brands', __('Featured Brands'), __('Featured Brands'), function ($shortcode) {
            return Theme::partial('shortcodes.featured-brands', [
                'title' => $shortcode->title,
            ]);
        });

        shortcode()->setAdminConfig('featured-brands', function ($attributes) {
            return Theme::partial('shortcodes.featured-brands-admin-config', compact('attributes'));
        });

        add_shortcode('appointment', __('Appointment'), __('Appointment'), function ($shortcode) {
            return Theme::partial('shortcodes.appointment', [
                'title' => $shortcode->title,
            ]);
        });

        shortcode()->setAdminConfig('appointment', function ($attributes) {
            return Theme::partial('shortcodes.appointment-admin-config', compact('attributes'));
        });

        add_shortcode('product-collections', __('Product Collections'), __('Product Collections'),
            function ($shortcode) {
                $productCollections = get_product_collections(['status' => BaseStatusEnum::PUBLISHED], [],
                    ['id', 'name', 'slug'])->toArray();

                return Theme::partial('shortcodes.product-collections', [
                    'title'              => $shortcode->title,
                    'productCollections' => $productCollections,
                ]);
            });

        shortcode()->setAdminConfig('product-collections', function ($attributes) {
            return Theme::partial('shortcodes.product-collections-admin-config', compact('attributes'));
        });

        add_shortcode('trending-products', __('Trending Products'), __('Trending Products'), function ($shortcode) {
            return Theme::partial('shortcodes.trending-products', [
                'title' => $shortcode->title,
            ]);
        });

        shortcode()->setAdminConfig('trending-products', function ($attributes) {
            return Theme::partial('shortcodes.trending-products-admin-config', compact('attributes'));
        });

        add_shortcode('product-blocks', __('Product Blocks'), __('Product Blocks'), function ($shortcode) {
            return Theme::partial('shortcodes.product-blocks', [
                'featured_product_title'  => $shortcode->featured_product_title,
                'top_rated_product_title' => $shortcode->top_rated_product_title,
                'on_sale_product_title'   => $shortcode->on_sale_product_title,
            ]);
        });

        shortcode()->setAdminConfig('product-blocks', function ($attributes) {
            return Theme::partial('shortcodes.product-blocks-admin-config', compact('attributes'));
        });

        add_shortcode('all-products', __('All Products'), __('All Products'), function ($shortcode) {
            $products = get_products([
                'paginate' => [
                    'per_page'      => $shortcode->per_page,
                    'current_paged' => (int)request()->input('page'),
                ],
            ]);

            return Theme::partial('shortcodes.all-products', [
                'title'    => $shortcode->title,
                'products' => $products,
            ]);
        });

        shortcode()->setAdminConfig('all-products', function ($attributes) {
            return Theme::partial('shortcodes.all-products-admin-config', compact('attributes'));
        });

        add_shortcode('all-brands', __('All Brands'), __('All Brands'), function ($shortcode) {
            $brands = get_all_brands();

            return Theme::partial('shortcodes.all-brands', [
                'title'  => $shortcode->title,
                'brands' => $brands,
            ]);
        });

        shortcode()->setAdminConfig('all-brands', function ($attributes) {
            return Theme::partial('shortcodes.all-brands-admin-config', compact('attributes'));
        });

        add_shortcode('flash-sale', __('Flash sale'), __('Flash sale'), function ($shortcode) {
            return Theme::partial('shortcodes.flash-sale', [
                'title' => $shortcode->title,
            ]);
        });

        shortcode()->setAdminConfig('flash-sale', function ($attributes) {
            return Theme::partial('shortcodes.flash-sale-admin-config', compact('attributes'));
        });
    }

    add_shortcode('banners', __('Banners'), __('Banners'), function ($shortcode) {
        return Theme::partial('shortcodes.banners', [
            'image1' => $shortcode->image1,
            'url1'   => $shortcode->url1,
            'image2' => $shortcode->image2,
            'url2'   => $shortcode->url2,
            'image3' => $shortcode->image3,
            'url3'   => $shortcode->url3,
        ]);
    });

    shortcode()->setAdminConfig('banners', function ($attributes) {
        return Theme::partial('shortcodes.banners-admin-config', compact('attributes'));
    });

    add_shortcode('our-features', __('Our features'), __('Our features'), function ($shortcode) {
        return Theme::partial('shortcodes.our-features', compact('shortcode'));
    });

    shortcode()->setAdminConfig('our-features', function ($attributes) {
        return Theme::partial('shortcodes.our-features-admin-config', compact('attributes'));
    });

    if (is_plugin_active('testimonial')) {
        add_shortcode('testimonials', __('Testimonials'), __('Testimonials'), function ($shortcode) {

            $testimonials = app(TestimonialInterface::class)
                ->getModel()
                ->where('status', BaseStatusEnum::PUBLISHED)
                ->get();

            return Theme::partial('shortcodes.testimonials', [
                'shortcode' => $shortcode,
                'testimonials' => $testimonials,
            ]);
        });

        shortcode()->setAdminConfig('testimonials', function ($attributes) {
            return Theme::partial('shortcodes.testimonials-admin-config', compact('attributes'));
        });
    }

    if (is_plugin_active('newsletter')) {
        add_shortcode('newsletter-form', __('Newsletter Form'), __('Newsletter Form'), function ($shortcode) {
            return Theme::partial('shortcodes.newsletter-form', [
                'title'       => $shortcode->title,
                'description' => $shortcode->description,
                'subtitle'    => $shortcode->subtitle,
            ]);
        });

        shortcode()->setAdminConfig('newsletter-form', function ($attributes) {
            return Theme::partial('shortcodes.newsletter-form-admin-config', compact('attributes'));
        });
    }

    if (is_plugin_active('contact')) {
        add_filter(CONTACT_FORM_TEMPLATE_VIEW, function () {
            return Theme::getThemeNamespace() . '::partials.shortcodes.contact-form';
        }, 120);
    }

    if (is_plugin_active('blog')) {
        add_shortcode('featured-news', __('Featured News'), __('Featured News'), function ($shortcode) {
            return Theme::partial('shortcodes.featured-news', [
                'title'       => $shortcode->title,
                'description' => $shortcode->description,
                'subtitle'    => $shortcode->subtitle,
            ]);
        });
        shortcode()->setAdminConfig('featured-news', function ($attributes) {
            return Theme::partial('shortcodes.featured-news-admin-config', compact('attributes'));
        });
    }

    if (is_plugin_active('simple-slider')) {
        add_filter(SIMPLE_SLIDER_VIEW_TEMPLATE, function () {
            return Theme::getThemeNamespace() . '::partials.shortcodes.sliders';
        }, 120);
    }

    if (is_plugin_active('ads')) {
        add_shortcode('theme-ads', __('Theme ads'), __('Theme ads'), function ($shortCode) {
            $ads = [];
            $attributes = $shortCode->toArray();

            for ($i = 1; $i < 5; $i++) {
                if (isset($attributes['key_' . $i]) && !empty($attributes['key_' . $i])) {
                    $ad = AdsManager::displayAds((string)$attributes['key_' . $i], ['class' => 'sale-banner hover_effect1 mb-3 mb-md-4']);
                    if ($ad) {
                        $ads[] = $ad;
                    }
                }
            }

            $ads = array_filter($ads);

            return Theme::partial('shortcodes.theme-ads', compact('ads'));
        });

        shortcode()->setAdminConfig('theme-ads', function ($attributes) {
            $ads = app(AdsInterface::class)->getModel()
                ->where('status', BaseStatusEnum::PUBLISHED)
                ->notExpired()
                ->get();

            return Theme::partial('shortcodes.theme-ads-admin-config', compact('ads', 'attributes'));
        });
    }

    if (is_plugin_active('faq')) {
        add_shortcode('faqs', __('FAQs'), __('List of FAQs'), function ($shortcode) {

            $params = [
                'condition' => [
                    'status' => BaseStatusEnum::PUBLISHED,
                ],
                'with'      => [
                    'faqs' => function ($query) {
                        $query->where('status', BaseStatusEnum::PUBLISHED);
                    },
                ],
                'order_by'  => [
                    'faq_categories.order'      => 'ASC',
                    'faq_categories.created_at' => 'DESC',
                ],
            ];

            if ($shortcode->category_id) {
                $params['condition']['id'] = $shortcode->category_id;
            }

            $categories = app(FaqCategoryInterface::class)->advancedGet($params);

            return Theme::partial('shortcodes.faqs', compact('categories'));
        });

        shortcode()->setAdminConfig('faqs', function ($attributes) {
            $categories = app(FaqCategoryInterface::class)->pluck('name', 'id', ['status' => BaseStatusEnum::PUBLISHED]);

            return Theme::partial('shortcodes.faqs-admin-config', compact('attributes', 'categories'));
        });
    }

    // dental shortcode
    add_shortcode('smile-gallery', __('smile-gallery'), __('smile-gallery'), function ($shortcode) {
        return Theme::partial('shortcodes.smile-gallery', [
            'title' => $shortcode->title,
            'shortcode' => $shortcode,
        ]);
    });

    shortcode()->setAdminConfig('smile-gallery', function ($attributes) {
        return Theme::partial('shortcodes.smile-gallery-admin-config', compact('attributes'));
    });


    add_shortcode('call-us', __('call-us'), __('call-us'), function ($shortcode) {
        return Theme::partial('shortcodes.call-us', [
            'title' => $shortcode->title,
            'shortcode' => $shortcode,
        ]);
    });

    shortcode()->setAdminConfig('call-us', function ($attributes) {
        return Theme::partial('shortcodes.call-us-admin-config', compact('attributes'));
    });

    add_shortcode('special-offers', __('special-offers'), __('special-offers'), function ($shortcode) {
        $page = app('request')->input('page') == '' ? 1 : app('request')->input('page');
        // if($shortCode->location == 'Home'){
        //     $offers = app(OffersInterface::class)
        //     ->getCategories(5,1);

        // }else{
            $offers = app(OffersInterface::class)
            ->advancedGet([
                'condition' => ['status' => BaseStatusEnum::PUBLISHED],
                'paginate'  => [
                    'per_page'      => 9,
                    'current_paged' => $page,
                ],
            ]);
        // }


        return Theme::partial('shortcodes.special-offers', [
            'title' => $shortcode->title,
            'shortcode' => $shortcode,
            'offers' => $offers,
        ]);
    });

    shortcode()->setAdminConfig('special-offers', function ($attributes) {
        return Theme::partial('shortcodes.special-offers-admin-config', compact('attributes'));
    });

    add_shortcode('patient-info', __('patient-info'), __('patient-info'), function ($shortcode) {

        $params = [
            'condition' => [
                'status' => BaseStatusEnum::PUBLISHED,
            ],
            'with'      => [
                'faqs' => function ($query) {
                    $query->where('status', BaseStatusEnum::PUBLISHED);
                },
            ],
            'order_by'  => [
                'faq_categories.order'      => 'ASC',
                'faq_categories.created_at' => 'DESC',
            ],
        ];

        if ($shortcode->category_id) {
            $params['condition']['id'] = $shortcode->category_id;
        }

        $categories = app(FaqCategoryInterface::class)->advancedGet($params);

        return Theme::partial('shortcodes.patient-info', [
            'title' => $shortcode->title,
            'categories' => $categories,
        ]);
    });

    add_shortcode('achieved', __('achieved'), __('achieved'), function ($shortcode) {
        return Theme::partial('shortcodes.achieved', [
            'shortcode' => $shortcode,
        ]);
    });

    shortcode()->setAdminConfig('achieved', function ($attributes) {
        return Theme::partial('shortcodes.achieved-admin-config', compact('attributes'));
    });

    add_shortcode('why-choose-us', __('why-choose-us'), __('why-choose-us'), function ($shortcode) {
        return Theme::partial('shortcodes.why-choose-us', [
            'title' => $shortcode->title,
            'shortcode' => $shortcode,
        ]);
    });

    shortcode()->setAdminConfig('why-choose-us', function ($attributes) {
        return Theme::partial('shortcodes.why-choose-us-admin-config', compact('attributes'));
    });

    add_shortcode('general-services', __('general-services'), __('general-services'), function ($shortcode) {
        return Theme::partial('shortcodes.general-services', [
            'title' => $shortcode->title,
        ]);
    });

    add_shortcode('welcome', __('welcome'), __('welcome'), function ($shortcode) {
        return Theme::partial('shortcodes.welcome', [
            'title' => $shortcode->title,
            'shortcode' => $shortcode,
        ]);
    });

    shortcode()->setAdminConfig('welcome', function ($attributes) {
        return Theme::partial('shortcodes.welcome-admin-config', compact('attributes'));
    });

    add_shortcode('about', __('about'), __('about'), function ($shortcode) {
        return Theme::partial('shortcodes.about', [
            'shortcode' => $shortcode,
        ]);
    });

    shortcode()->setAdminConfig('about', function ($attributes) {
        return Theme::partial('shortcodes.about-admin-config', compact('attributes'));
    });

    add_shortcode('header', __('header'), __('header'), function ($shortcode) {
        return Theme::partial('shortcodes.header', [
            'shortcode' => $shortcode,
        ]);
    });

    shortcode()->setAdminConfig('header', function ($attributes) {
        return Theme::partial('shortcodes.header-admin-config', compact('attributes'));
    });


    add_shortcode('mission', __('mission'), __('mission'), function ($shortcode) {
        return Theme::partial('shortcodes.mission', [
            'title' => $shortcode->title,
            'shortcode' => $shortcode,
        ]);
    });

    shortcode()->setAdminConfig('mission', function ($attributes) {
        return Theme::partial('shortcodes.mission-admin-config', compact('attributes'));
    });

    add_shortcode('prices', __('prices'), __('prices'), function ($shortcode) {
        return Theme::partial('shortcodes.prices', [
            'title' => $shortcode->title,
            'shortcode' => $shortcode,
        ]);
    });

    shortcode()->setAdminConfig('prices', function ($attributes) {
        return Theme::partial('shortcodes.prices-admin-config', compact('attributes'));
    });

});
