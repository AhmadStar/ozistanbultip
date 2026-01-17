<?php

namespace Botble\Doctor\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Clinic\Models\Clinic;
use Botble\Doctor\Models\Times;

class Doctor extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'doctors';

    /**
     * @var array
     */
    protected $fillable = [
        'name',

        'saturday_start',
        'saturday_end',
        'saturday_status',

        'sunday_start',
        'sunday_end',
        'sunday_status',

        'monday_start',
        'monday_end',
        'monday_status',

        'tuesday_start',
        'tuesday_end',
        'tuesday_status',

        'wednesday_start',
        'wednesday_end',
        'wednesday_status',

        'thursday_start',
        'thursday_end',
        'thursday_status',

        'friday_start',
        'friday_end',
        'friday_status',

        'status',
        'period',
        'message',
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
        return $this->hasMany(Times::class, 'doctor_times');
    }



}
