<?php namespace Indikator\Photography\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreatePhotosTable extends Migration
{
    public function up()
    {
        Schema::create('indikator_photography_photos', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->longText('content')->nullable();
            $table->string('image', 200)->nullable();
            $table->timestamp('exif_date')->nullable();
            $table->string('exif_model', 40)->nullable();
            $table->string('exif_aperture', 5)->nullable();
            $table->string('exif_exposure', 7)->nullable();
            $table->string('exif_focal', 7)->nullable();
            $table->string('exif_iso', 5)->nullable();
            $table->string('exif_flash', 3)->default('No');
            $table->string('exif_ratio', 4)->nullable();
            $table->string('exif_width', 5)->nullable();
            $table->string('exif_height', 5)->nullable();
            $table->string('exif_orientation', 1)->nullable();
            $table->string('featured', 1)->default(2);
            $table->string('status', 1)->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('indikator_photography_photos');
    }
}
