<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponCodeTable extends Migration
{
    public function up()
    {
        Schema::create('coupon_code', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('coupon_id')->constrained('coupons')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('is_active')->default(0);
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTime('activated_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupon_code');
    }
}
