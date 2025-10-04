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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('type_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->text('thumbnail')->nullable();
            $table->string('trailer')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longtext('description')->nullable();
            $table->string('instructor')->nullable();
            $table->string('normal_price')->nullable();
            $table->string('price')->nullable();
            $table->string('point')->nullable();
            $table->string('is_featured')->nullable();
            $table->string('is_recommend')->nullable();
            $table->string('is_upcoming')->nullable();
            $table->string('is_newest')->nullable();
            $table->string('is_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
