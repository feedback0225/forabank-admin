<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies_offices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('currency_id')->unsigned();
            $table->unsignedBiginteger('office_id')->unsigned();

            $table->foreign('currency_id')->references('id')
                ->on('currencies')->onDelete('cascade');
            $table->foreign('office_id')->references('id')
                ->on('offices')->onDelete('cascade');
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
        Schema::dropIfExists('currencies_offices');
    }
};
