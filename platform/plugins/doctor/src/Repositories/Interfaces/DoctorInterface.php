<?php

namespace Botble\Doctor\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface DoctorInterface extends RepositoryInterface
{
    /**
     * @param int $limit
     * @param array $with
     * @return mixed
     */
    public function getAvailableApointments(int $id = 5);


    /**
     * @param int $limit
     * @param array $with
     * @return mixed
     */
    public function getDayAvailableApointments(int $doctor_id, String $day, String $date);

    /**
     * @param int $limit
     * @param array $with
     * @return mixed
     */
    public function getDayHourAvailableApointments(int $doctor_id, String $day, String $date, String $hour);

}
