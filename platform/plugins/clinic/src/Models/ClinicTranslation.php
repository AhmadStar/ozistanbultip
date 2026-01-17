<?php

namespace Botble\Clinic\Models;

use Botble\Base\Models\BaseModel;

class ClinicTranslation extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clinics_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'lang_code',
        'clinics_id',
        'name',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
