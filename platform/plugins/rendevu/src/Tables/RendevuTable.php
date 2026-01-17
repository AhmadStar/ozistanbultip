<?php

namespace Botble\Rendevu\Tables;

use Illuminate\Support\Facades\Auth;
use BaseHelper;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Clinic\Models\Clinic;
use Botble\Doctor\Models\Doctor;
use Botble\Rendevu\Repositories\Interfaces\RendevuInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Html;

class RendevuTable extends TableAbstract
{

    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    /**
     * RendevuTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param RendevuInterface $rendevuRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, RendevuInterface $rendevuRepository)
    {
        parent::__construct($table, $urlGenerator);

        $this->repository = $rendevuRepository;

        if (!Auth::user()->hasAnyPermission(['rendevu.edit', 'rendevu.destroy'])) {
            $this->hasOperations = false;
            $this->hasActions = false;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('doctor_id', function ($item) {
                if($item->doctor_id && isset($item->doctor->name))
                    return $item->doctor_id && $item->doctor->name ? clean($item->doctor->name) : '&mdash;';
                return '&mdash;';
            })
            ->editColumn('clinic_id', function ($item) {
                if($item->clinic_id && isset($item->clinic->name))
                    return $item->clinic_id && $item->clinic->name ? clean($item->clinic->name) : '&mdash;';
                return '&mdash;';
            })
            ->editColumn('service_id', function ($item) {
                return $item->service_id && $item->service->name ? clean($item->service->name) : '&mdash;';
            })
            ->editColumn('name', function ($item) {
                return $item->name;
            })
            ->editColumn('phone', function ($item) {
                return $item->phone;
            })
            ->editColumn('date', function ($item) {
                return BaseHelper::formatDate($item->date);
            })
            ->editColumn('day', function ($item) {
                return $this->arabicdaya($item->day);
            })
            ->editColumn('time', function ($item) {
                // return $item->time;
                return $this->getTimeFormat($item->time);
                // return $this->getTimeFormat($item->time);
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return BaseHelper::formatDate($item->created_at);
            })
            ->editColumn('status', function ($item) {
                return $item->status->toHtml();
            })
            ->addColumn('operations', function ($item) {
                return $this->getOperations('rendevu.edit', 'rendevu.destroy', $item);
            });

        return $this->toJson($data);
    }

    /**
     * {@inheritDoc}
     */
    function getTimeFormat($time)
    {
        // use of explode
        $string = $time;
        $str_arr = explode (":", $string);

        $minute = isset($str_arr[1]) ? $str_arr[1] : '00';

        switch($str_arr[0]){
            case '12' :
                return $time.' ظهراً';
            break;
            case '13' :
                return '1:'.$minute.' ظهراً';
            break;
            case '14' :
                return '2:'.$minute.' ظهراً';
            break;
            case '15' :
                return '3:'.$minute.' ظهراً';
            break;
            case '16' :
                return '4:'.$minute.' عصراً';
            break;
            case '17' :
                return '5:'.$minute.' عصراً';
            break;
            case '18' :
                return '6:'.$minute.' عصراً';
            break;
            case '19' :
                return '7:'.$minute.' مساءً';
            break;
            case '20' :
                return '8:'.$minute.' مساءً';
            break;
            case '21' :
                return '9:'.$minute.' مساءً';
            break;
            case '22' :
                return '10:'.$minute.' مساءً';
            break;
            case '23' :
                return '11:'.$minute.' مساءً';
            break;
            default :
                return $time.' صباحاً';
            break;
        }
    }

    public function arabicdaya($day)
    {
        switch($day){
            case 'saturday':
                return 'السبت ';
                break;
            case 'sunday':
                return 'الأحد ';
                break;
            case 'monday':
                return 'الاثنين ';
                break;
            case 'tuesday':
                return 'الثلاثاء ';
                break;
            case 'wednesday':
                return 'الأربعاء ';
                break;
            case 'thursday':
                return 'الخميس ';
                break;
            case 'friday':
                return 'الجمعة ';
                break;
            default:
                return 'test';
        }
    }
    /**
     * {@inheritDoc}
     */
    public function query()
    {
        $query = $this->repository->getModel()
            ->select([
               'id',
               'doctor_id',
               'clinic_id',
               'service_id',
               'name',
               'phone',
               'date',
               'day',
               'time',
               'created_at',
               'status',
           ]);

        return $this->applyScopes($query);
    }

    /**
     * {@inheritDoc}
     */
    public function columns()
    {
        return [
            'id' => [
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'doctor_id' => [
                'title' => 'الطبيب',
                'class' => 'text-start',
            ],
            'clinic_id' => [
                'title' => 'العيادة',
                'class' => 'text-start',
            ],
            'service_id' => [
                'title' => 'الخدمة',
                'class' => 'text-start',
            ],
            'name' => [
                'title' => 'اسم المريض',
                'class' => 'text-start',
            ],
            'phone' => [
                'title' => 'رقم المريض',
                'class' => 'text-start',
            ],
            'date' => [
                'title' => 'التاريخ',
                'class' => 'text-start',
            ],
            'day' => [
                'title' => 'اليوم',
                'class' => 'text-start',
            ],
            'time' => [
                'title' => 'الوقت',
                'class' => 'text-start',
            ],
            'created_at' => [
                'title' => 'تاريخ الانشاء',
                'width' => '100px',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function buttons()
    {
        // return $this->addCreateButton(route('rendevu.create'), 'rendevu.create');
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('rendevu.deletes'), 'rendevu.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'doctor_id' => [
                'title'    => 'Doctor',
                'type'     => 'select-search',
                'validate' => 'required|max:120',
                'callback' => 'getDoctors',
            ],
            'clinic_id' => [
                'title'    => 'Clinic',
                'type'     => 'select-search',
                'validate' => 'required|max:120',
                'callback' => 'getClinicList',
            ],
            'name' => [
                'title'    => 'Name',
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'phone' => [
                'title'    => 'Phone',
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'date' => [
                'title'    => 'Date',
                'type'     => 'date',
            ],
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getDoctors(): array
    {
        return Doctor::pluck('name', 'id')->toArray();
    }

    /**
     * @return array
     */
    public function getClinicList(): array
    {
        return Clinic::pluck('name', 'id')->toArray();
    }



    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->getBulkChanges();
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultButtons(): array
    {
        return [
            'export',
            'reload',
        ];
    }
}
