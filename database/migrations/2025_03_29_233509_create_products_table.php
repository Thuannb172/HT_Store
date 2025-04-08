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
        if (!Schema::hasTable('products')) { // Kiểm tra xem bảng đã tồn tại chưa
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('price_nomal', 10, 2);
                $table->decimal('price_sale', 10, 2)->nullable();
                $table->text('description')->nullable();
                $table->text('content')->nullable();
                $table->string('image');
                $table->text('images')->nullable();
                $table->timestamps();
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
