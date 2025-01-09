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
        Schema::create('reg_nominee', function (Blueprint $table) {
            $table->id();
            $table->integer('worker_id');
            $table->string('nominee_name1',200);
            $table->date('nominee_dob1')->nullable();
            $table->string('nominee_relation1',20);
            $table->string('nominee_name2',200)->nullable();
            $table->date('nominee_dob2')->nullable();
            $table->string('nominee_relation2',20)->nullable();
            $table->smallInteger('del');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reg_nominee');
    }
};
