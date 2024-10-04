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
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('contact_person',150)->nullable();
            $table->string('designation',100)->nullable();
            $table->string('email',150)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('city',50)->nullable();
            $table->string('state',50)->nullable();
            $table->string('address',100)->nullable();
            $table->string('pin',10)->nullable();
            $table->string('username',30);
            $table->string('password');
            $table->smallInteger('del');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
