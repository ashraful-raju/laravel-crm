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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('customer_id')
                ->constrained()
                ->onDelete('cascade');
            $table->date('date');
            $table->string('inv_number');
            $table->string('currency', 10)->default('$');
            $table->text('notes')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();
        });

        Schema::create('invoice_product', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity')->default(1);
            $table->float('price')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('invoice_product');
    }
};
