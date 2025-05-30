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
        Schema::create('rejection', function (Blueprint $table) {
            $table->id();
            $table->integer('worker_id');
            $table->string('rejected_by',10);
            $table->integer('district_id');
            $table->string('reason',200);
            $table->smallInteger('del');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rejection');
    }
};
