<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique();
            $table->string('user_name')->nullable();
            $table->string('name_prefix')->nullable();
            $table->string('first_name');
            $table->string('middle_initial')->nullable();
            $table->string('last_name');
            $table->string('gender');
            $table->string('email');
            $table->date('date_of_birth')->nullable();
            $table->time('time_of_birth')->nullable();
            $table->integer('age');
            $table->date('date_of_joining')->nullable();
            $table->float('age_in_company');
            $table->string('phone');
            $table->string('place');
            $table->string('county');
            $table->string('city');
            $table->string('zip');
            $table->string('region');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
