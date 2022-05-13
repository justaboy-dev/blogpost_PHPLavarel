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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('tittle');
            $table->string('slug');
            $table->string('excerpt');
            $table->text('body');
            $table->unSignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unSignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->boolean('public')->default(true);
            $table->unSignedBigInteger('views')->default(0);
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
        Schema::dropIfExists('posts');
    }
};
