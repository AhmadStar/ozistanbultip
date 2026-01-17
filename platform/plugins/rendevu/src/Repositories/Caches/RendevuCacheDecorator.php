<?php

namespace Botble\Rendevu\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Rendevu\Repositories\Interfaces\RendevuInterface;

class RendevuCacheDecorator extends CacheAbstractDecorator implements RendevuInterface
{

    /**
     * {@inheritDoc}
     */
    public function getReserve($data)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }


    public function getDayReservedApointments(int $doctor_id, String $day, String $date)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }


}
