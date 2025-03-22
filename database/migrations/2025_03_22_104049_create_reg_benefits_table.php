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
        Schema::create('reg_benefits', function (Blueprint $table) {
            $table->id();
            $table->integer('worker_id');
            $table->string('name');
            $table->date('dob')->nullable();
            $table->decimal('amount')->nullable();
            $table->string('cheque',200)->nullable();
            $table->string('bank',200)->nullable();
            $table->smallInteger('del');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reg_benefits');
    }
};
