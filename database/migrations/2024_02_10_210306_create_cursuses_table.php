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
        Schema::create('cursuses', function (Blueprint $table) {
            $table->id();
            $table->string('diplome');
            $table->string('school');
            $table->date('start_date_school');
            $table->date('end_date_school');
            $table->foreignId('cv_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursuses');
    }
};
