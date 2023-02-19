<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('owner_id')->unsigned()->nullable();
            $table->string('code');
            $table->decimal('discount')->default(0);
            $table->enum('discount_type',['amount','percentage'])->default('percentage');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
			
			$table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
