<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sid',100);
            $table->longText('cms_content')->nullable(); 
            $table->string('anrede',100)->nullable(); 
            $table->string('titel',100)->nullable(); 
            $table->string('vorname',100)->nullable(); 
            $table->string('name',100)->nullable(); 
            $table->string('strasse',100)->nullable(); 
            $table->string('plz',100)->nullable(); 
            $table->string('ort',100)->nullable(); 
            $table->string('e_mail_adresse',100)->nullable(); 
            $table->longText('ihre_nachricht')->nullable(); 
            $table->string('ich_bin_mit_der_speicherung_meiner_daten_einverstanden',25)->nullable(); 
            $table->string('ich_erklare_mich_mit_den_nutzungsbedingungen_einverstanden',25)->nullable();
            $table->string('informationsmaterial',100)->nullable();
            $table->string('markup',100)->nullable();
            $table->string('markup_01',100)->nullable();
            $table->string('markup_02',100)->nullable();
            $table->longText('ich_bin_mit_der_speicherung_meiner_daten_und_den_nutzungsbedingu')->nullable();
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
        Schema::dropIfExists('information');
    }
}
