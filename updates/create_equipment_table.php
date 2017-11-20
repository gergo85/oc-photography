<?php namespace Indikator\Photography\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreateEquipmentTable extends Migration
{
    public function up()
    {
        Schema::create('indikator_photography_equipment', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('brand', 100);
            $table->string('name', 100);
            $table->string('purchased', 50);
            $table->string('manual', 200)->nullable();
            $table->text('content')->nullable();
            $table->string('image', 200)->nullable();
            $table->string('price', 50)->nullable();
            $table->string('org_price', 50)->nullable();
            $table->string('type', 1)->default(1);
            $table->string('comment', 250);
            $table->string('featured', 1)->default(2);
            $table->string('status', 1)->default(1);
            $table->string('sort_order', 3)->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('indikator_photography_equipment');
    }
}
