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
    Schema::create('borrowing_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('borrowing_id')->constrained('borrowings');
        $table->foreignId('product_id')->constrained('products');
        $table->integer('quantity')->default(1);
        $table->string('item_status'); // input example: 'Baik', 'rusak', 'Hilang'
        $table->timestamps();
    });
}
public function down(): void { /* No Drop */ }
};
