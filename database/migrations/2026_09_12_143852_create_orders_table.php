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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('subtotal_in_halalas');
            $table->unsignedBigInteger('discount_in_halalas')->default(0);
            $table->unsignedBigInteger('total_in_halalas');
            $table->char('currency', 3)->default('SAR');
            $table->string('status')->default('pending')->index();
            $table->timestamp('paid_at')->nullable();
            $table->unsignedBigInteger('refunded_total_in_halalas')->default(0);
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
