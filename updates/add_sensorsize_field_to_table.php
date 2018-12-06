<?php namespace Indikator\Photography\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddSensorsizeFieldToTable extends Migration
{
    public function up()
    {
        Schema::table('indikator_photography_photos', function($table)
        {
            $table->string('sensor_size', 5)->default('none');
        });
    }

    public function down()
    {
        Schema::table('indikator_photography_photos', function($table)
        {
            $table->dropColumn('sensor_size');
        });
    }
}
