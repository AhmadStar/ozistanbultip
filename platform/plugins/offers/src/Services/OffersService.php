<?php

namespace Botble\Offers\Services;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Supports\Helper;
use Botble\Blog\Models\Category;
use Botble\Blog\Models\Post;
use Botble\Blog\Models\Tag;
use Botble\Blog\Repositories\Interfaces\CategoryInterface;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Blog\Repositories\Interfaces\TagInterface;
use Botble\Offers\Models\Offers;
use Botble\Offers\Repositories\Interfaces\OffersInterface;
use Botble\SeoHelper\SeoOpenGraph;
use Eloquent;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use RvMedia;
use SeoHelper;
use Theme;

class OffersService
{
    /**
     * @param Eloquent $slug
     * @return array|Eloquent
     */
    public function handleFrontRoutes($slug)
    {
        if (!$slug instanceof Eloquent) {
            return $slug;
        }

        $condition = [
            'id'     => $slug->reference_id,
            'status' => BaseStatusEnum::PUBLISHED,
        ];

        if (Auth::check() && request()->input('preview')) {
            Arr::forget($condition, 'status');
        }

        switch ($slug->reference_type) {
            case Offers::class:
                $offer = app(OffersInterface::class)
                    ->getFirstBy($condition, ['*'],
                        ['slugable']);

                if (empty($offer)) {
                    abort(404);
                }

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, POST_MODULE_SCREEN_NAME, $offer);

                return [
                    'view'         => 'post',
                    'default_view' => 'plugins/blog::themes.post',
                    'data'         => compact('offer'),
                    'slug'         => $offer->slug,
                ];

        }

        return $slug;
    }
}
