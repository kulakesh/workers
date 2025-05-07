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
        Schema::create('renewals', function (Blueprint $table) {
            $table->id();
            $table->integer('worker_id');
            $table->smallInteger('payment_years');
            $table->double('payment_amount');
            $table->string('payment_mode', 10);
            $table->string('payment_ref_no', 50);
            $table->timestamp('payment_date');
            $table->string('doc_path')->nullable();
            $table->string('img_path')->nullable();
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
        Schema::dropIfExists('renewals');
    }
};
