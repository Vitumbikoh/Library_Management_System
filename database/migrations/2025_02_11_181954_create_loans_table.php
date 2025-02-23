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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relationship with User
            $table->foreignId('book_id')->constrained()->onDelete('cascade'); // Relationship with Book
            $table->date('loan_date')->default(DB::raw('CURRENT_DATE')); // Set default value for loan_date
            $table->date('due_date'); // Add the due_date column here
            $table->enum('status', ['pending', 'returned', 'overdue', 'borrowed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
