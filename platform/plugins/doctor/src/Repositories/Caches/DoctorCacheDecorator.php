<?php

namespace Botble\Doctor\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Doctor\Repositories\Interfaces\DoctorInterface;

class DoctorCacheDecorator extends CacheAbstractDecorator implements DoctorInterface
{

    /**
     * {@inheritDoc}
     */
    public function getAvailableApointments(int $id = 5)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }


    /**
     * {@inheritDoc}
     */
    public function getDayAvailableApointments(int $doctor_id, String $day, String $date)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function getDayHourAvailableApointments(int $doctor_id, String $day, String $date, String $hour)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }




}
