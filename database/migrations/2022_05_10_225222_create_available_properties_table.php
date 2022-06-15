<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailablePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('available_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('productname');
            $table->longText('city');
            $table->longText('Description');
            $table->longText('Price');
            $table->longText('Area');
            $table->longText('Bedrooms');
            $table->longText('length');
            $table->longText('Speciality');
            $table->integer('property_type_id');
            $table->longText('picture');
            $table->string('bannerimage');
            $table->integer('Category');
            $table->longText('Completion');
            $table->longText('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('available_properties');
    }
}
