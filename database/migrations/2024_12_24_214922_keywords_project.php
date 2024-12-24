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
        Schema::create('keywords_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('projects_id');
            $table->unsignedBigInteger('keywords_id');

            $table->foreignId('projects_id')->constrained()->cascadeOnDelete();
            $table->foreignId('keywords_id')->constrained()->cascadeOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keywords_projects');
    }
};
