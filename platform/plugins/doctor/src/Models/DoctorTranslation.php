<?php

namespace Botble\Doctor\Models;

use Botble\Base\Models\BaseModel;

class DoctorTranslation extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'doctors_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'lang_code',
        'doctors_id',
        'name',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
