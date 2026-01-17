<?php

namespace Botble\Doctor\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Doctor\Http\Requests\DoctorRequest;
use Botble\Doctor\Models\Doctor;
use Botble\Clinic\Repositories\Interfaces\ClinicInterface;
use Botble\Doctor\Forms\Fields\CustomMultiSelectField ;

class DoctorForm extends FormAbstract
{

    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        if (!$this->formHelper->hasCustomField('CustomMultiSelect')) {
            $this->formHelper->addCustomField('CustomMultiSelect', CustomMultiSelectField::class);
        }

        $selected=[];

        if ($this->getModel()) {
            $temp = $this->getModel()->clinics;
            foreach($temp as $item){
                $selected[] = $item->id;
            }
        }
        $clinicList=[];
        $clinics = app(ClinicInterface::class)
                        ->advancedGet([
                            'condition' => ['status' => BaseStatusEnum::PUBLISHED],
                        ]);
        foreach ($clinics as  $val) {
            $clinicList[$val->id] = $val->name;
        }


        $this
            ->setupModel(new Doctor)
            ->setValidatorClass(DoctorRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label'      => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
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
