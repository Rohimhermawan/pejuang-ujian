<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
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
            $table->unsignedBigInteger('material_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->string('image');
            $table->string('slug')->unique();
            $table->string('tittle');
            $table->text('excerpt');
            $table->text('body');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
}
