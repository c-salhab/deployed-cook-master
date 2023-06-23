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
            $table->string('name')->unique();;
            $table->string('description');
            $table->string('address');
            $table->decimal('price',10,2);
            $table->integer('max_capacity');
            $table->string('image');
            $table->timestamp('start_time')->default(now());
            $table->timestamp('end_time')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');

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
