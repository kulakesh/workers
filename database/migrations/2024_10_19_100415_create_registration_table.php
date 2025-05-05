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
        Schema::create('registration', function (Blueprint $table) {
            $table->id();
            $table->string('system_id', 20)->unique();
            $table->integer('operator_id');
            $table->string('name',150);
            $table->string('father',150)->nullable();
            $table->string('mother',150)->nullable();
            $table->string('spouse',150)->nullable();
            $table->string('gender',10);
            $table->date('dob')->nullable();
            $table->string('cast',50)->nullable();
            $table->string('tribe',50)->nullable();
            $table->string('email',150)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('city_t',50)->nullable();
            $table->string('district_t',50)->nullable();
            $table->integer('district_t_code');
            $table->string('state_t',50)->nullable();
            $table->integer('state_t_code');
            $table->string('pin_t',10)->nullable();
            $table->string('po_t',50)->nullable();
            $table->string('ps_t',50)->nullable();
            $table->string('address_t',150)->nullable();
            $table->string('city_p',50)->nullable();
            $table->string('district_p',50)->nullable();
            $table->integer('district_p_code');
            $table->string('state_p',50)->nullable();
            $table->integer('state_p_code');
            $table->string('pin_p',10)->nullable();
            $table->string('po_p',50)->nullable();
            $table->string('ps_p',50)->nullable();
            $table->string('address_p',150)->nullable();
            $table->string('aadhaar',20)->nullable();
            $table->string('nature',150)->nullable();// nature of work
            $table->string('serial',50)->nullable();// old serial number
            $table->date('doe')->nullable();// date of enrollment
            $table->date('dor')->nullable();// date of retirement
            $table->decimal('turnover')->nullable();
            $table->string('nominee',150)->nullable();
            $table->string('relation',150)->nullable();
            $table->smallInteger('approval');
            $table->smallInteger('del');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration');
    }
};
