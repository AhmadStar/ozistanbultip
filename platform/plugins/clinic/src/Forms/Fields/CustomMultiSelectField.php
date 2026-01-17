<?php

namespace Botble\Clinic\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\SelectType;

class CustomMultiSelectField extends SelectType
{

    /**
     * {@inheritDoc}
     */
    protected function getTemplate()
    {
        return  'plugins/clinic::categories.custom-multi-select';
    }
}
