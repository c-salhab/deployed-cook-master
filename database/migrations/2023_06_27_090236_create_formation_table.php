<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormationTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('image');
            $table->string('name')->unique();
            $table->string('description');
            $table->string('duration');
            $table->decimal('price', 10, 2);
            $table->timestamp('creation_date')->default(now());
            $table->integer('score');
            $table->boolean('validated')->default(0);
            $table->foreignId('creator')->nullable()->constrained('users');
            $table->foreignId('certification_id')->nullable()->constrained('certifications')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
}
