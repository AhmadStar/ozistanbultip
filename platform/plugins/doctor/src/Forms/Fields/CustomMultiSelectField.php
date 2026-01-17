<?php

namespace Botble\Doctor\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\SelectType;

class CustomMultiSelectField extends SelectType
{

    /**
     * {@inheritDoc}
     */
    protected function getTemplate()
    {
        return  'plugins/doctor::categories.custom-multi-select';
    }
}
