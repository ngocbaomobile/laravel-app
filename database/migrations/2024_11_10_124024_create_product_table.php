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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name',length:100);
            $table->text('description') -> nullable();
            $table->decimal('size', total: 8, places: 2)-> default(value: 0); // 8 chu so ca chu so truoc va sau dau thap phan, 2: chi dc 2 chu so sau dau thap phan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
