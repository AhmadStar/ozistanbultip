<?php

namespace Botble\Offers\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

class Offers extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offers';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'content',
        'description',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];
    public static function getOffers(){
        return Offers::select('*')
            ->join('language_meta', function ($join) {
                $join->on('language_meta.reference_id', '=','offers.id');
            })
            ->where([
                'language_meta.reference_type' => Offers::class,
                'language_meta.lang_meta_code' => (app()->getLocale()=='en')?'en_US':'ar',
                'offers.status' => 'published'])->orderBy('offers.created_at', 'DESC')->get();

    }

    public static function getLatestOffer(){
        return Offers::select('*')
            ->join('language_meta', function ($join) {
                $join->on('language_meta.reference_id', '=', 'offers.id');
            })
            ->where([
                'language_meta.reference_type' => Offers::class,
                'language_meta.lang_meta_code' => (app()->getLocale()=='en')?'en_US':'ar',
               'offers.status' => 'published'])->limit(1)->orderBy('offers.created_at', 'DESC')->first();
//        return Offers::where(['status'=>'published'])->limit(1)->orderBy('created_at','DESC')->first();
    }

    public static function getOffer($id){
        return Offers::where(['status' => 'published', 'id' => $id])->first();
    }


}
