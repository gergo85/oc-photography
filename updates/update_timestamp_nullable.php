<?php namespace Indikator\Photography\Updates;

use October\Rain\Database\Updates\Migration;
use DbDongle;

class UpdateTimestampsNullable extends Migration
{
    public function up()
    {
        DbDongle::disableStrictMode();

        DbDongle::convertTimestamps('indikator_photography_photos');
        DbDongle::convertTimestamps('indikator_photography_categories');
        DbDongle::convertTimestamps('indikator_photography_equipment');
    }

    public function down()
    {
        // ...
    }
}
