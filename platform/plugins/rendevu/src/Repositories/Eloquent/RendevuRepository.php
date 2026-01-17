<?php

namespace Botble\Rendevu\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Rendevu\Repositories\Interfaces\RendevuInterface;
use Botble\Rendevu\Http\Requests\RendevuRequest;
use Botble\Doctor\Repositories\Interfaces\DoctorInterface;
use Botble\Clinic\Models\Clinic;

class RendevuRepository extends RepositoriesAbstract implements RendevuInterface
{
    /**
     * {@inheritDoc}
     */
    function getReserve($data)
    {
        $savedata = [];
        $savedata['doctor_id'] = $data->doctor;
        $savedata['clinic_id'] = $data->clinic;
        $savedata['service_id'] = $data->service;
        $savedata['date'] = strtolower(preg_split("# #", $data->date)[1]);
        $savedata['day'] =  strtolower(preg_split("# #", $data->date)[0]);

        $savedata['time'] = $data->time;

        $availableTimes = app(DoctorInterface::class)->getDayHourAvailableApointments($data->doctor, $savedata['day'], $savedata['date'], $savedata['time']);

        if(count($availableTimes) > 0){
            $savedata['time'] = reset($availableTimes);
        }else{
            $result['error'] = true;
            $result['message'] = 'مع الأسف الموعد المطلوب لم يعد متوفر يرجى المحاولة من جديد وحجز موعد بتوقيت مختلف';
            if($data->clinic){
                $clinic = Clinic::where('id', $data->clinic)->first();
                $result['clinicPhone'] = $clinic->phone;
            }
            return $result;
        }

        $savedata['name'] = $data->name;
        $savedata['phone'] = $data->phone;

        // check if this week client has rendevu
        $rendevu = $this->checkIfAlreadyFoundRendevu($savedata['doctor_id'], $savedata['name'], $savedata['phone']);
        if(count($rendevu) > 0){
            $result['error'] = true;
            $result['message'] = 'يوجد موعد محجوز بالفعل يرجى التواصل مع الدعم الفني للحصول على مزيد من التفاصيل';
            if($data->clinic){
                $clinic = Clinic::where('id', $data->clinic)->first();
                $result['clinicPhone'] = $clinic->phone;
            }
            $result['rendevu_name'] = $rendevu[0]->name;
            $result['rendevu_date'] = $rendevu[0]->date;
            $result['rendevu_clinic_name'] = $rendevu[0]->clinic->name;
            $result['rendevu_doctor_name'] = $rendevu[0]->doctor->name;
            $result['rendevu_day'] = $rendevu[0]->day;
            $result['rendevu_time'] = $rendevu[0]->time;

            return $result;
        }else{
            $rendevu = $this->createOrUpdate($savedata);

            $result['error'] = false;
            if($data->clinic){
                $clinic = Clinic::where('id', $data->clinic)->first();
                $result['clinicPhone'] = $clinic->phone;
            }
            $result['rendevu_name'] = $rendevu->name;
            $result['rendevu_date'] = $rendevu->date;
            $result['rendevu_clinic_name'] = $rendevu->clinic->name;
            $result['rendevu_doctor_name'] = $rendevu->doctor->name;
            $result['rendevu_day'] = $rendevu->day;
            $result['rendevu_time'] = $rendevu->time;
            return $result;
        }

    }


    /**
     * {@inheritDoc}
     */
    public function getDayReservedApointments(int $doctor_id, String $day, String $date, String $hour = 'NULL')
    {
        if($hour !== 'NULL'){
            $data = $this->model
            ->where([
                'doctor_id' => $doctor_id,
                'day' => $day,
                'date' => $date,
            ])
            ->where('time', 'LIKE', '%'.$hour.':'.'%')
            ->select('time')->get();
        }else{
            $data = $this->model
            ->where([
                'doctor_id' => $doctor_id,
                'day' => $day,
                'date' => $date,
            ])->select('time')->get();
        }

        return $data;
    }

    public function checkIfAlreadyFoundRendevu(int $doctor_id, String $name, String $phone){
        $rendevu = $this->model
        ->where([
            'doctor_id' => $doctor_id,
            'name' => $name,
            'phone' => $phone,
        ])->where( 'date', '>=', date("Y-m-d"))
        ->select('*')->get();
        return $rendevu;
    }
}
