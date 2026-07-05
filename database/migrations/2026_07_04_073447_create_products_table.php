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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        $table->string('code')->unique();
        $table->string('name');
        $table->integer('stock')->default(0);
        $table->string('storage_location')->nullable();
        $table->enum('condition', ['Bagus', 'Rusak Ringan', 'Rusak Berat'])->default('Bagus');
        $table->text('description')->nullable();
        $table->timestamps();
    });
}
public function down(): void { /* No Drop */ }
};
