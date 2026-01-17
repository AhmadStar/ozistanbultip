<?php

namespace Botble\Clinic;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Schema::dropIfExists('clinics');
        Schema::dropIfExists('clinics_translations');
    }
}
