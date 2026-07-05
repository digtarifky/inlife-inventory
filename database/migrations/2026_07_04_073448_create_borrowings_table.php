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
    Schema::create('borrowings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->date('borrow_date');
        $table->enum('status', ['Berjalan', 'Selesai'])->default('Berjalan');
        $table->timestamps();
    });
}
public function down(): void { /* No Drop */ }
};
