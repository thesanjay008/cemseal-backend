<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('outlet_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->integer('timimg')->default('5')->nullable();
            $table->enum('type',['Home','Order'])->default('Home');
            $table->enum('status',['Active','Inactive'])->default('Active');
            $table->dateTime('delete_at')->nullable();
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
        Schema::dropIfExists('banners');
    }
}
