<?php namespace Indikator\Photography\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('indikator_photography_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->string('image', 200)->nullable();
            $table->string('featured', 1)->default(2);
            $table->string('status', 1)->default(1);
            $table->string('sort_order', 3)->default(1);
            $table->timestamps();
        });

        Schema::create('indikator_photography_relations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('photos_id')->unsigned();
            $table->integer('categories_id')->unsigned();
            $table->primary(['photos_id', 'categories_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('indikator_photography_categories');
        Schema::dropIfExists('indikator_photography_relations');
    }
}
