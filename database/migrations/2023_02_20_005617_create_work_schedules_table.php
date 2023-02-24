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
        Schema::create('work_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_of_client_id')->nullable();
            $table->string('schedule');
            $table->unsignedBigInteger('office_id');
            $table->timestamps();

            $table->foreign('type_of_client_id')
                ->references('id')->on('type_of_clients')->onDelete('cascade');
            $table->foreign('office_id')
                ->references('id')->on('offices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_schedules');
    }
};
