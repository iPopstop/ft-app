<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipsTable extends Migration
{
    public function up()
    {
        Schema::create('tips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete()->cascadeOnUpdate();
            $table->float('sum_tips')->default(0);
            $table->float('sum_commission')->default(0);
            $table->foreignId('comment_id')->nullable()->constrained('comments')->nullOnDelete()->cascadeOnUpdate();
            $table->boolean('commission_payed')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tips');
    }
}
