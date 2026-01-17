<?php

namespace Botble\Doctor\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Clinic\Models\Clinic;

class Times extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'doctor_times';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'doctor_id',
        'value',
        'patient_id',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

     /**
     * @return BelongsToMany
     */
    public function clinics()
    {
        return $this->belongsToMany(Clinic::class, 'doctor_clinic');
    }


     /**
     * @return BelongsToMany
     */
    public function times()
    {
        return $this->hasMany(Clinic::class, 'doctor_times');
    }



}
