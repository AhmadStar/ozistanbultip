<?php

namespace Botble\Rendevu\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface RendevuInterface extends RepositoryInterface
{
    /**
     * @param int $limit
     * @param array $with
     * @return mixed
     */
    public function getReserve($data);


    public function getDayReservedApointments(int $doctor_id, String $day, String $date);

}
