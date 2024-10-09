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
            $table->string('name');
            $table->foreignId('vendor_id')->constrained('vendors','id')->nullOnDelete();
            $table->foreignId('catetgory_id')->nullable()->constrained('categories','id')->nullOnDelete();
            $table->string('slug')->unique();
            $table->string('SKU')->nullable->unique();
            $table->text('long_description')->nullable();
            $table->text('short_description')->nullable();
            $table->float('regular_price');
            $table->float('discount_price')->nullable();
            $table->smallInteger('quantitiy');
            $table->json('options')->nullable();
            $table->string('image')->nullable();
            $table->enum('status',['active','draft','inactive'])->default('active');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->boolean('featured')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
