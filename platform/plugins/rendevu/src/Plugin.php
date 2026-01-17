<?php

namespace Botble\Rendevu;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Schema::dropIfExists('rendevus');
        Schema::dropIfExists('rendevus_translations');
    }
}
