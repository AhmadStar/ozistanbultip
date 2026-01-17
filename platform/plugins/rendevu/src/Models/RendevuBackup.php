<?php

namespace Botble\Rendevu\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Botble\Doctor\Models\Doctor;
use Botble\Clinic\Models\Clinic;
use Botble\Service\Models\Service;

class RendevuBackup extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rendevus_backup';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'doctor_id',
        'clinic_id',
        'service_id',
        'date',
        'day',
        'time',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

    /**
     * @return BelongsTo
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    /**
     * @return BelongsTo
     */
    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class,'clinic_id');
    }

    /**
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class,'service_id');
    }


}
