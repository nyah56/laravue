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
        //
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('product_id')->constrained('products')->onDelete('cascade');
            $table->dateTime('date'); // e.g. "2025-04-22 12:00:00"
            $table->enum('type', ['in', 'out']);
            $table->integer('quantity');
            $table->string('reason')->nullable();            // e.g. "purchase", "order", "manual"
            $table->string('manifest_hardcopy')->nullable(); // e.g. "order_id", "invoice_id"
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->softDeletes(); // e.g. {"order_id": "12345", "user_id": "67890"}
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('stock_movements');
    }
};
