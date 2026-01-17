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
    function get_clinic_list($lang)
    {
        $defaultLang = 'ar';
        $langCode = normalizeLangCode($lang);

        if ($lang === $defaultLang) {
            return DB::table('clinics')
                ->where('status', BaseStatusEnum::PUBLISHED)
                ->orderBy('clinic_order')
                ->orderBy('created_at')
                ->get();
        }

        return DB::table('clinics')
            ->join(
                'clinics_translations',
                'clinics_translations.clinics_id',
                '=',
                'clinics.id'
            )
            ->where('clinics.status', BaseStatusEnum::PUBLISHED)
            ->where('clinics_translations.lang_code', $langCode)
            ->orderBy('clinics.clinic_order')
            ->orderBy('clinics.created_at')
            ->select([
                'clinics.id',
                'clinics_translations.name',
                'clinics.clinic_order',
                'clinics.created_at',
            ])
            ->get();
    }
}

    function normalizeLangCode($lang)
    {
        return match ($lang) {
            'tr' => 'TR_tr',
            'en' => 'en',
            'ar' => 'ar',
            default => $lang,
        };
    }


if (!function_exists('get_clinic_doctor_list')) {
    /**
     * @param int $limit
     * @param array $with
     * @param array $withCount
     * @return mixed
     */
    function get_clinic_doctor_list($id, $lang)
    {
        $defaultLang = 'ar';
        $langCode = normalizeLangCode($lang);

        // 🔹 Arabic → main table
        if ($lang === $defaultLang) {
            return DB::table('doctors')
                ->join('doctor_clinic', 'doctor_clinic.doctor_id', '=', 'doctors.id')
                ->where('doctor_clinic.clinic_id', $id)
                ->where('doctors.status', BaseStatusEnum::PUBLISHED)
                ->select('doctors.*')
                ->distinct()
                ->get();
        }

        // 🔹 Other languages → translations table ONLY
        return DB::table('doctors')
            ->join('doctor_clinic', 'doctor_clinic.doctor_id', '=', 'doctors.id')
            ->join(
                'doctors_translations',
                'doctors_translations.doctors_id',
                '=',
                'doctors.id'
            )
            ->where('doctor_clinic.clinic_id', $id)
            ->where('doctors.status', BaseStatusEnum::PUBLISHED)
            ->where('doctors_translations.lang_code', $langCode)
            ->select([
                'doctors.id',
                'doctors_translations.name',
                'doctors.created_at',
            ])
            ->distinct()
            ->get();
    }
}

if (!function_exists('get_clinic_service_list')) {
    /**
     * @param int $limit
     * @param array $with
     * @param array $withCount
     * @return mixed
     */
    function get_clinic_service_list($id, $lang)
    {
        $defaultLang = 'ar';
        $langCode = normalizeLangCode($lang);

        if ($lang === $defaultLang) {
            // 🔹 Default language → read from services table
            return DB::table('services')
                ->join('clinic_service', 'clinic_service.service_id', '=', 'services.id')
                ->where('clinic_service.clinic_id', $id)
                ->select([
                    'services.id',
                    'services.name',
                ])
                ->distinct()
                ->get();
        }

        // 🔹 Other languages → read from services_translations table only
        return DB::table('services')
            ->join('clinic_service', 'clinic_service.service_id', '=', 'services.id')
            ->join(
                'services_translations',
                'services_translations.services_id',
                '=',
                'services.id'
            )
            ->where('clinic_service.clinic_id', $id)
            ->where('services_translations.lang_code', $langCode)
            ->select([
                'services.id',
                'services_translations.name',
            ])
            ->distinct()
            ->get();
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
    function get_doctor_data($id, $lang)
    {
        $defaultLang = setting('locale');

        $message = app(DoctorInterface::class)
            ->advancedGet([
                'condition' => [
                    'status' => BaseStatusEnum::PUBLISHED,
                    'id' => $id,
                ],
                'select' => ['message'],
                'limit' => 1,
                'withTranslation' => $lang !== $defaultLang,
            ]);

        if (!empty($message) && !empty($message[0]->message)) {
            return $message[0]->message;
        }

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
