<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->unsignedBigInteger('id',true);
            $table->string('title')->comment('Tieu de');
            $table->integer('comic_id')->comment('Thuoc truyen nao');
            $table->longText('description')->comment('Mo ta');
            $table->longText('chapter_content')->comment('Noi dung truyen');
            $table->integer('status')->comment('Trang thai 0-Dang cap nhat, 1-da hoan thanh');
            $table->text('slug_chapter')->comment('Slug chapter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapters');
    }
};
