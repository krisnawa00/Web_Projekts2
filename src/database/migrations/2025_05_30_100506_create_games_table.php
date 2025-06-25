<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::create('games', function (Blueprint $table) {
        $table->id();
        $table->foreignId('develepor_id')->constrained('develepors');
        $table->foreignId('genre_id')->nullable()->constrained('genres');
        $table->string('title', 256);
        $table->text('description')->nullable();
        $table->decimal('price', 8, 2)->nullable();
        $table->integer('release_year');
        $table->string('image', 256)->nullable();
        $table->boolean('is_active');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};