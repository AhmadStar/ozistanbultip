<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rendevus', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id');
            $table->integer('clinic_id');
            $table->integer('service_id');
            $table->string('date', 255);
            $table->string('day', 255);
            $table->string('time', 255);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('rendevus_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->integer('rendevus_id');
            $table->string('name', 255)->nullable();

            $table->primary(['lang_code', 'rendevus_id'], 'rendevus_translations_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rendevus');
        Schema::dropIfExists('rendevus_translations');
    }
};
