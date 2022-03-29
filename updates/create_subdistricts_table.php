<?php namespace Octobro\Location\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateSubdistrictsTable Migration
 */
class CreateSubdistrictsTable extends Migration
{
    public function up()
    {
        Schema::create('octobro_location_subdistricts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('state_id')->nullable();
            $table->unsignedInteger('district_id')->nullable();
            $table->string('name');
            $table->string('code')->unique()->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('octobro_location_subdistricts');
    }
}
