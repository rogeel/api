<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsColorsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('equipos', function ($table) {
            
            $table->string('camiseta_manga', 7)->after('camiseta');
            $table->string('medias', 7)->after('camiseta_manga');
            $table->string('camiseta_manga1', 7)->after('camiseta1');
            $table->string('medias1', 7)->after('camiseta_manga1');
        });

        Schema::table('jugadores', function ($table) {
            $table->string('app', 50)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('equipos', function ($table) {
            $table->dropColumn('camiseta_manga');
            $table->dropColumn('medias');
            $table->dropColumn('camiseta_manga1');
            $table->dropColumn('medias1');
        });
    }
}
