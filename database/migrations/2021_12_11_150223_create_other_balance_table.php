<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherBalanceTable extends Migration
{
    public function up()
    {
        Schema::create('other_balance', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnUpdate()->cascadeOnDelete();
            $table->float('balance')->default(0);
            $table->timestamps();

            $table->primary(['user_id', 'company_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('other_balance');
    }
}
