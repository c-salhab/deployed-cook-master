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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->unique();
            $table->string('address');
            $table->integer('max_capacity');
            $table->string('description');
            $table->decimal('price',10,2)->nullable();
            $table->string('difficulty')->nullable();
            $table->string('type');
            $table->timestamp('start_time')->default(now());
            $table->timestamp('end_time')->default(now());
            $table->foreignId('id_room')->nullable()->constrained('rooms');
            $table->foreignId('user_creator')->nullable()->constrained('users');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
