<?php

namespace Botble\Doctor;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Schema::dropIfExists('doctors');
        Schema::dropIfExists('doctors_translations');
    }
}
