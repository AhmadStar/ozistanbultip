<?php

namespace Botble\Clinic\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Clinic\Http\Requests\ClinicRequest;
use Botble\Clinic\Models\Clinic;
use Botble\Service\Repositories\Interfaces\ServiceInterface;
use Botble\Doctor\Repositories\Interfaces\DoctorInterface;
use Botble\Clinic\Forms\Fields\CustomMultiSelectField ;


class ClinicForm extends FormAbstract
{

    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        if (!$this->formHelper->hasCustomField('CustomMultiSelect')) {
            $this->formHelper->addCustomField('CustomMultiSelect', CustomMultiSelectField::class);
        }

        $selectedService=[];
        $selectedDoctor=[];

        if ($this->getModel()) {
            $temp = $this->getModel()->services;
            foreach($temp as $item){
                $selectedService[] = $item->id;
            }

            $temp1 = $this->getModel()->doctors;
            foreach($temp1 as $item1){
                $selectedDoctor[] = $item1->id;
            }
        }

        $clinicList=[];
        $doctorList=[];
        $services = app(ServiceInterface::class)
                        ->advancedGet([
                            'condition' => ['status' => BaseStatusEnum::PUBLISHED],
                        ]);
        $doctors = app(DoctorInterface::class)
                    ->advancedGet([
                        'condition' => ['status' => BaseStatusEnum::PUBLISHED],
                    ]);
        foreach ($services as  $val) {
            $clinicList[$val->id] = $val->name;
        }

        foreach ($doctors as  $val1) {
            $doctorList[$val1->id] = $val1->name;
        }


        $this
            ->setupModel(new Clinic)
            ->setValidatorClass(ClinicRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label'      => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('clinic_order', 'number', [
                'label'      => 'الترتيب',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'الترتيب',
                    'data-counter' => 120,
                ],
            ])
            ->add('phone', 'number', [
                'label'      => 'رقم هاتف العيادة',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'رقم الهاتف',
                    'data-counter' => 120,
                ],
            ])
            ->add('services', 'CustomMultiSelect', [
                'label' => 'Service List',
                'input_name'=>'services',
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'class' => 'form-control select-full',
                    'id' => 'services'
                ],
                'selected'=>$selectedService,
                'choices' => $clinicList,
            ])

            ->add('doctors', 'CustomMultiSelect', [
                'label' => 'Doctor List',
                'input_name'=>'doctors',
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'class' => 'form-control select-full',
                    'id' => 'doctors'
                ],
                'selected'=>$selectedDoctor,
                'choices' => $doctorList,
            ])


            ->add('status', 'customSelect', [
                'label'      => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class' => 'form-control select-full',
                ],
                'choices'    => BaseStatusEnum::labels(),
            ])
            ->setBreakFieldPoint('status');
    }
}
