<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->tinyInteger('type')->comment('1 - скидка в %, 2 - в рублях');
            $table->integer('min_sum')->default(0);
            $table->text('description');
            $table->float('sale');
            $table->boolean('is_enabled')->default(0);
            $table->float('price_total');
            $table->float('price_company');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
