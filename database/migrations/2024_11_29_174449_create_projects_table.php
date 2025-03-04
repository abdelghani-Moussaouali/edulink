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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teachers_id')->constrained()->cascadeOnDelete();
            // $table->foreignId('keywords_id')->constrained()->cascadeOnDelete();
            $table->foreignId('specializations_id')->constrained()->references('id')->on('specializations')->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['pending','open', 'in progress', 'submitted', 'closed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
