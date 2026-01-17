<?php

namespace Botble\Doctor\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Doctor\Repositories\Interfaces\DoctorInterface;
use Botble\Rendevu\Repositories\Interfaces\RendevuInterface;
use Carbon\Carbon;


class DoctorRepository extends RepositoriesAbstract implements DoctorInterface
{
    /**
     * {@inheritDoc}
     */
    public function getAvailableApointments(int $id = 1)
    {
        $thisweek = [
            ['e_day' => $this->getEDay(0), 'a_day' => $this->getADay(0),  'date' => $this->getDate(0)],
            ['e_day' => $this->getEDay(1), 'a_day' => $this->getADay(1),  'date' => $this->getDate(1)],
            ['e_day' => $this->getEDay(2), 'a_day' => $this->getADay(2),  'date' => $this->getDate(2)],
            ['e_day' => $this->getEDay(3), 'a_day' => $this->getADay(3),  'date' => $this->getDate(3)],
            ['e_day' => $this->getEDay(4), 'a_day' => $this->getADay(4),  'date' => $this->getDate(4)],
            ['e_day' => $this->getEDay(5), 'a_day' => $this->getADay(5),  'date' => $this->getDate(5)],
            ['e_day' => $this->getEDay(6), 'a_day' => $this->getADay(6),  'date' => $this->getDate(6)],
        ];

        $appointment = [];

        foreach($thisweek as $day){
            if(count($this->getDayAvailableApointments($id, $day['e_day'], $day['date']))){
                $day['e_name'] = $day['e_day'].' '.$day['date'];
                $day['a_name'] = $day['a_day'].' '.$day['date'];
                $appointment[] = [ 'e_name' => $day['e_name'], 'a_name' => $day['a_name'] ];
            }
        }

        return $appointment;
    }

    function getEDay($days){
        $date = Carbon::now();
        $date = $date->addDays($days);
        return date('l', strtotime($date));
    }

    function getADay($days){
        $date = Carbon::now();
        $date = $date->addDays($days);
        $day = date('l', strtotime($date));
        $find = array ("Saturday", "Sunday", "Monday", "Tuesday", "Wednesday" , "Thursday", "Friday");
        $replace = array ("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
        return str_replace($find, $replace, $day);
    }

    function getDate($days){
        $date = Carbon::now();
        $date = $date->addDays($days);
        return date('Y-m-d', strtotime($date));
    }


    /**
     * {@inheritDoc}
     */
    public function getDayAvailableApointments(int $doctor_id, String $day, String $date)
    {

        $data = $this->model
        ->where([
            'id' => $doctor_id,
            $day.'_status' => 1,
        ])->select($day.'_start as start', $day.'_end as end', 'period')->first();

        $dayAppointmentList = $this->getDayTimes($data);

        // if date is today filter hours
        if( date("Y-m-d") == $date){
            $dayAppointmentList = $this->filterHours($dayAppointmentList);
        }

        $dayReservedApointments = app(RendevuInterface::class)->getDayReservedApointments($doctor_id, $day, $date);
        $array2 = [];
        foreach($dayReservedApointments as $reserved){
            $array2[] = $reserved->time;
        }


        if(count($dayAppointmentList) > 0){
            $dayAppointmentList = array_diff($dayAppointmentList, $array2);
            return $this->filterSingleTime($dayAppointmentList);
        }

        return [];
    }


    /**
     * {@inheritDoc}
     */
    public function getDayHourAvailableApointments(int $doctor_id, String $day, String $date, String $hour)
    {

        $data = $this->model
        ->where([
            'id' => $doctor_id,
            $day.'_status' => 1,
        ])->select($day.'_start as start', $day.'_end as end', 'period')->first();

        $dayAppointmentList = $this->getHourTimes($data, $hour);

        // if date is today filter hours
        if( date("Y-m-d") == $date){
            $dayAppointmentList = $this->filterHours($dayAppointmentList);
        }

        $dayReservedApointments = app(RendevuInterface::class)->getDayReservedApointments($doctor_id, $day, $date, $hour);

        $array2 = [];
        foreach($dayReservedApointments as $reserved){
            $array2[] = $reserved->time;
        }

        if(count($dayAppointmentList) > 0)
            return array_diff($dayAppointmentList, $array2);
        return [];
    }


    /**
     * {@inheritDoc}
     */
    function getDayTimes($data)
    {

        $times = [];
        if(isset($data)){
            if($data->start != null && $data->end != null){
                $range = range(strtotime($data->start), strtotime($data->end) ,$data->period*60);
                foreach($range as $time){
                        $times[] =  date("H:i",$time);
                }
            }
        }

        array_pop($times);

        return $times;
    }

    /**
     * {@inheritDoc}
     */
    function getHourTimes($data, $hour)
    {

        $hour1 = $hour + 1 .':00';
        $hour = $hour . ':00';

        $times = [];
        if(isset($data)){
            if($data->start != null && $data->end != null){
                $range = range(strtotime($hour), strtotime($hour1) ,$data->period*60);
                foreach($range as $time){
                        $times[] =  date("H:i",$time);
                }
            }
        }

        array_pop($times);

        return $times;
    }

    /**
     * {@inheritDoc}
     */
    function filterHours($dayAppointmentList)
    {
        foreach($dayAppointmentList as $key => $time)
        {
            $time = explode (":", $time);
            if( $time[0] < date("H") + 3 ){
                unset($dayAppointmentList[$key]);
            }
        }
        return $dayAppointmentList;
    }

    /**
     * {@inheritDoc}
     */
    function filterSingleTime($dayAppointmentList)
    {
        $result = [];
        foreach($dayAppointmentList as $key => $time)
        {
            $hour = explode (":", $time);
            if (!in_array($hour[0], $result))
            {
                $result[] = $hour[0];
            }
        }

        return $result;

    }


    /**
     * {@inheritDoc}
     */
    function getTimeFormat($time)
    {
        // use of explode
        $string = $time;
        $str_arr = explode (":", $string);

        switch($str_arr[0]){
            case '12' :
                return $time.' ظهراً';
            break;
            case '13' :
                return '1:'.$str_arr[1].' ظهراً';
            break;
            case '14' :
                return '2:'.$str_arr[1].' ظهراً';
            break;
            case '15' :
                return '3:'.$str_arr[1].' ظهراً';
            break;
            case '16' :
                return '4:'.$str_arr[1].' عصراً';
            break;
            case '17' :
                return '5:'.$str_arr[1].' عصراً';
            break;
            case '18' :
                return '6:'.$str_arr[1].' عصراً';
            break;
            case '19' :
                return '7:'.$str_arr[1].' مساءً';
            break;
            case '20' :
                return '8:'.$str_arr[1].' مساءً';
            break;
            case '21' :
                return '9:'.$str_arr[1].' مساءً';
            break;
            case '22' :
                return '10:'.$str_arr[1].' مساءً';
            break;
            case '23' :
                return '11:'.$str_arr[1].' مساءً';
            break;
            default :
                return $time.' صباحاً';
            break;
        }
    }





}
