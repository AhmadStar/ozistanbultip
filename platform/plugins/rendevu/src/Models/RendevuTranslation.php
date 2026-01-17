<?php

namespace Botble\Rendevu\Models;

use Botble\Base\Models\BaseModel;

class RendevuTranslation extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rendevus_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'lang_code',
        'rendevus_id',
        'name',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
