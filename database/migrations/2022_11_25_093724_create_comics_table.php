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
        Schema::create('comics', function (Blueprint $table) {
            $table->unsignedBigInteger('id',true);
            $table->string('name');
            $table->string('slug');
            $table->string('author');
            $table->longText('description');
            $table->string('image');
            $table->string('status');
            $table->unsignedBigInteger('likes')->default('0');
            $table->unsignedBigInteger('views')->default('0');
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
        Schema::dropIfExists('comics');
    }
};
