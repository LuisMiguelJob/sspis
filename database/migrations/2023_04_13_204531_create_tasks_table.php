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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); 
            $table->string('name');
            $table->double('progress');
            $table->date('initial_date');
            $table->date('final_date');
            $table->date('finishTask_date')->nullable();
            $table->text('description');
            $table->text('delivery'); // entregable de la tarea
            $table->boolean('complete')->default(false); // booleano que dice si la tarea fue completada
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete(); // propietario de la tarea
            $table->foreignId('phase_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
