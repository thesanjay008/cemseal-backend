<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hospital_id')->unsigned();
            $table->string('image')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('discount_percentage');
            $table->enum('status',['active','inactive'])->default('active'); 
            $table->timestamps();
        });
        Schema::create('offers_translations', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('offer_id')->unsigned();
            $table->string('offer_name');
            $table->longtext('description');
            $table->string('locale')->index();
            $table->unique(['offer_id', 'locale']);
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
