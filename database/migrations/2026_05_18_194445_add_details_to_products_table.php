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
    Schema::table('products', function (Blueprint $table) {
        $table->text('ingredients')->nullable()->after('description'); // Malzemeler
        $table->text('recipe_steps')->nullable()->after('ingredients'); // Hazırlanış Detayları
    });
}

public function down(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['ingredients', 'recipe_steps']);
    });
}
};
