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
        Schema::create('solutions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_id')->constrained('tasks');
            $table->foreignId('student_id')->constrained('users');
            $table->integer('points');
            $table->enum('status', ['not evaluated', 'evaluated']);
            $table->timestamp('submitted_at');
            $table->timestamp('evaluated_at')->nullable();
            $table->text('comments')->nullable();
            $table->text('solution');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solutions');
    }
};
