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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->longText('available_times')->nullable();
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('doctors_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->integer('doctors_id');
            $table->string('name', 255)->nullable();

            $table->primary(['lang_code', 'doctors_id'], 'doctors_translations_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
        Schema::dropIfExists('doctors_translations');
    }
};
