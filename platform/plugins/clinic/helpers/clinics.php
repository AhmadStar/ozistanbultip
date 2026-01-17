<?php

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Clinic\Models\Clinic;
use Botble\Clinic\Repositories\Interfaces\ClinicInterface;
use Botble\Doctor\Repositories\Interfaces\DoctorInterface;
use Botble\Rendevu\Repositories\Interfaces\RendevuInterface;
use Illuminate\Support\Collection;
use Botble\Doctor\Models\Doctor;
use Botble\Service\Models\Service;

if (!function_exists('get_clinic_list')) {
    /**
     * @param int $limit
     * @param array $with
     * @param array $withCount
     * @return mixed
     */
    function get_clinic_list(int $limit = 8, array $with = ['slugable'], array $withCount = [])
    {
        return app(ClinicInterface::class)->advancedGet([
            'condition' => [
                'status'      => BaseStatusEnum::PUBLISHED,
            ],
            'order_by'  => [
                'clinic_order' => 'ASC',
                'created_at' => 'ASC',
            ],
        ]);
    }
}


if (!function_exists('get_clinic_doctor_list')) {
    /**
     * @param int $limit
     * @param array $with
     * @param array $withCount
     * @return mixed
     */
    function get_clinic_doctor_list($id)
    {
        $data = Doctor::join('doctor_clinic', 'doctor_clinic.doctor_id', '=','doctors.id')
                ->where('doctor_clinic.clinic_id', $id)
                ->select('doctors.*')
                ->distinct();

        return $data->get();

    }
}


if (!function_exists('get_clinic_service_list')) {
    /**
     * @param int $limit
     * @param array $with
     * @param array $withCount
     * @return mixed
     */
    function get_clinic_service_list($id)
    {
        $data = Service::join('clinic_service', 'clinic_service.service_id', '=','services.id')
                ->where('clinic_service.clinic_id', $id)
                ->select(['services.id','services.name'])
                ->distinct();

        return $data->get();

    }
}

if (!function_exists('get_clinic_data')) {
    /**
     * @param int $limit
     * @param array $with
     * @param array $withCount
     * @return mixed
     */
    function get_clinic_data($id)
    {
        $data = Clinic::where('id', $id)->select('phone')->first();
        return $data->phone;

    }
}


if (!function_exists('get_doctor_appointment_list')) {
    /**
     * @param int $limit
     * @param array $with
     * @param array $withCount
     * @return mixed
     */
    function get_doctor_appointment_list($id)
    {

        return app(DoctorInterface::class)->getAvailableApointments($id);

    }
}

if (!function_exists('get_doctor_data')) {
    /**
     * @param int $limit
     * @param array $with
     * @param array $withCount
     * @return mixed
     */
    function get_doctor_data($id)
    {
        $message = app(DoctorInterface::class)
            ->advancedGet([
                'condition' => ['status' => BaseStatusEnum::PUBLISHED, 'id' => $id],
                'select'    => ['message'],
                'limit' => 1
            ]);

        if(isset($message) && count($message) > 0 && !empty($message[0]->message))
            return $message[0]->message;
        return 'لحجز الموعد او للاستفسار يرجى التواصل أو الضغط على الرقم التالي ';
    }
}



if (!function_exists('get_day_appointment_list')) {
    /**
     * @param int $limit
     * @param array $with
     * @param array $withCount
     * @return mixed
     */
    function get_day_appointment_list($doctor_id, $day, $date)
    {

        return app(DoctorInterface::class)->getDayAvailableApointments($doctor_id, $day, $date);

    }
}



if (!function_exists('get_reserve')) {
    /**
     * @param int $limit
     * @param array $with
     * @param array $withCount
     * @return mixed
     */
    function get_reserve($data)
    {
        return app(RendevuInterface::class)->getReserve($data);
    }
}
