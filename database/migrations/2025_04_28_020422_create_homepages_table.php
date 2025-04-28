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
        Schema::create('homepages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('sub_title');
            $table->text('detail');
            $table->text('tab_1');
            $table->string('title_tab_1');
            $table->string('detail_tab_1');
            $table->text('tab_2');
            $table->string('title_tab_2');
            $table->string('detail_tab_2');
            $table->text('tab_3');
            $table->string('title_tab_3');
            $table->string('detail_tab_3');
            $table->string('section_title');
            $table->string('section_sub_title');
            $table->text('section_detail');
            $table->string('section_button');
            $table->string('section_link');
            $table->string('accord_title');
            $table->text('accord_detail');
            $table->string('accord_tab_1');
            $table->text('accord_detail_tab_1');
            $table->string('accord_tab_2');
            $table->text('accord_detail_tab_2');
            $table->string('accord_tab_3');
            $table->text('accord_detail_tab_3');
            $table->string('contact_title');
            $table->text('contact_detail');
            $table->string('email');
            $table->string('hours');
            $table->string('location');
            $table->string('phone');
            $table->longtext('map_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepages');
    }
};
