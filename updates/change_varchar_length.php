<?php namespace Indikator\Photography\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class ChangeVarcharLength extends Migration
{
    public function up()
    {
        Schema::table('indikator_photography_photos', function($table)
        {
            $table->string('image', 191)->change();
        });

        Schema::table('indikator_photography_categories', function($table)
        {
            $table->string('image', 191)->change();
        });

        Schema::table('indikator_photography_equipment', function($table)
        {
            $table->string('manual', 191)->change();
            $table->string('image', 191)->change();
            $table->string('comment', 191)->change();
        });
    }

    public function down()
    {
        Schema::table('indikator_photography_photos', function($table)
        {
            $table->string('image', 200)->change();
        });

        Schema::table('indikator_photography_categories', function($table)
        {
            $table->string('image', 200)->change();
        });

        Schema::table('indikator_photography_equipment', function($table)
        {
            $table->string('manual', 200)->change();
            $table->string('image', 200)->change();
            $table->string('comment', 250)->change();
        });
    }
}
