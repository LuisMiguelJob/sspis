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

            $table->string('name');
            $table->double('progress');
            $table->string('description');
            $table->date('start_date');
            $table->date('final_date');

            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // se relaciona con la tabla users // este es el lider_id, lo pongo asi porque no me acuerdo como personalizar esto

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
