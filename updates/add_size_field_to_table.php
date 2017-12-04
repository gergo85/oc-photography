<?php namespace Indikator\Photography\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddFilesizeFieldToTable extends Migration
{
    public function up()
    {
        Schema::table('indikator_photography_photos', function($table)
        {
            $table->string('filesize', 20)->nullable();
        });
    }

    public function down()
    {
        Schema::table('indikator_photography_photos', function($table)
        {
            $table->dropColumn('filesize');
        });
    }
}
