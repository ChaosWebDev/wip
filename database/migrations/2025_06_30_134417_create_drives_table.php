<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('drives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('members')->cascadeOnDelete();
            $table->unsignedInteger('minutes', false)->default(1);
            $table->date('date');
            $table->text('notes')->nullable();
            $table->enum('slot',['day','night'])->default('day');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drives');
    }
};
